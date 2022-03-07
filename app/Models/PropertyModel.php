<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PropertyModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'properties';
        $this->folderUpload        = 'property';
        $this->fieldSearchAccepted = ['name', 'city', 'address'];
        $this->crudNotAccepted     = ['_token', 'thumb_current', 'thumb_design', 'thumb_album', 'category', 'idUser'];
    }

    //======== LIST ITEMS =========
    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'slug', 'description', 'bath', 'bed', 'area', 'city', 'city_slug', 'address', 'price', 'image', 'type', 'type_slug', 'purpose', 'floor_plan', 'video', 'view', 'user_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status');

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items-search') {
            // dd($params);



            $query = $this->select('id', 'name', 'slug', 'description', 'bath', 'bed', 'area', 'city', 'city_slug', 'address', 'price', 'image', 'type', 'type_slug', 'purpose', 'floor_plan', 'video', 'view', 'user_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status');

            if ($params['city']['value'] !== "") {
                $query->where($params['city']['field'], 'LIKE',  "%{$params['city']['value']}%");
            }
           
            if ($params['type']['value'] !== "") {
                $query->where($params['type']['field'], 'LIKE',  "%{$params['type']['value']}%");
            }
            if ($params['purpose']['value'] !== "all") {
                $query->where($params['purpose']['field'], 'LIKE',  "%{$params['purpose']['value']}%");
            }
            if ($params['keyword']['value'] !== "") {
                // if ($params['keyword']['field'] == "keyword") {
                $query->where(function ($query) use ($params) {
                    foreach ($this->fieldSearchAccepted as $column) {
                        $query->orWhere($column, 'LIKE',  "%{$params['keyword']['value']}%");
                    }
                });
                // } else if (in_array($params['keyword']['field'], $this->fieldSearchAccepted)) {
                //     $query->where($params['keyword']['field'], 'LIKE',  "%{$params['keyword']['value']}%");
                // }
            }
           



            $result = $query->get()/* ->toArray() */;
        }



        return $result;
    }

    public function countItems($params = null, $options  = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'));

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'slug', 'description', 'bath', 'bed', 'area', 'city', 'city_slug', 'address', 'price', 'image', 'type', 'type_slug', 'purpose', 'floor_plan', 'video', 'view', 'user_id', 'status', 'design', 'album', 'created_at', 'created_by', 'updated_at', 'updated_by')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'image', 'design', 'album')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'add-item') {
            // dd($params);
            $params['created_by'] = "kerry";
            $params['created_at'] = date(config('zvn.format.db'));
            $params['image']      = $this->uploadThumb($params['image']);
            $params['design']     = $this->uploadThumb($params['design']);
            $params['album']      = json_encode(array_values($this->uploadThumbs($params['album'])));
            $params['slug']       = Str::slug($params['name']) . '-' . Carbon::now()->timestamp;
            $params['type_slug']  = Str::slug($params['category']);
            $params['city_slug']  = Str::slug($params['city']);
            $params['user_id']    = $params['idUser'];

            // dd($this->prepareParams($params));
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {

            if (!empty($params['image'])) {
                $this->deleteThumb($params['thumb_current']);
                $params['image'] = $this->uploadThumb($params['image']);
            }
            if (!empty($params['design'])) {
                $this->deleteThumb($params['thumb_design']);
                $params['design'] = $this->uploadThumb($params['design']);
            }


            if (!empty($params['album'])) {
                if ($params['thumb_album'] != '') {

                    $album =  json_decode($params['thumb_album'], true);
                    foreach ($album as $key => $value) {
                        $this->deleteThumb($value);
                    }
                    $params['album'] = $this->uploadThumbs($params['album']);
                }
            }
            $params['slug']       = Str::slug($params['name']) . '-' . Carbon::now()->timestamp;
            $params['city_slug']  = Str::slug($params['city']);
            $params['updated_by']   = "kerry";
            $params['updated_at']   = date(config('zvn.format.db'));
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {

            $item   = self::getItem($params, ['task' => 'get-thumb']); // 

            $this->deleteThumb($item['image']);
            $this->deleteThumb($item['design']);

            if ($item['album'] != '') {

                $album = json_decode($item['album']);
                foreach ($album as $val) {
                    $this->deleteThumb($val);
                }
            }



            self::where('id', $params['id'])->delete();
        }
    }
}
