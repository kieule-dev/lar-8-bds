<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleModel extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'posts as p';
        $this->folderUpload        = 'article';
        $this->fieldSearchAccepted = ['name', 'content'];
        $this->crudNotAccepted     = ['_token', 'thumb_current', 'thumb'];
    }

    public function listItems($params = null, $options = null)
    {

        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = $this->leftJoin('categories as c', 'p.category_id', '=', 'c.id')/* ->leftJoin('comment_posts as cp', 'cp.post_id', '=', 'p.id')  */
            ->select('p.id', 'p.name', 'p.status', 'p.short_description', 'p.slug', 'p.view', 'p.image', 
                     'p.description','p.created_at', 'p.created_by', 'p.updated_at',   'p.updated_by', 'p.category_id',
                     'c.name as category_name',
            /* ,DB::raw('count(cp.post_id) as comment_count') */ )/* ->groupBy('cp.post_id') */;


            if ($params['filter']['status'] !== "all") {
                $query->where('p.status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere('p.' . $column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where('p.' . $params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }

            $result =  $query->orderBy('p.id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'thumb')
                ->where('status', '=', 'active')
                ->limit(5);

            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-featured') {

            $query = $this->select('a.id', 'a.name', 'a.content', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->where('a.type', 'featured')
                ->orderBy('a.id', 'desc')
                ->take(3);

            $result = $query->get()->toArray();
        }


        if ($options['task'] == 'news-list-items-latest') {

            $query = $this->select('a.id', 'a.name', 'a.created', 'a.category_id', 'c.name as category_name', 'a.thumb')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.status', '=', 'active')
                ->orderBy('id', 'desc')
                ->take(4);;
            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-in-category') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'created')
                ->where('status', '=', 'active')
                ->where('category_id', '=', $params['category_id'])
                ->take(4);
            $result = $query->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-related-in-category') {
            $query = $this->select('id', 'name', 'content', 'thumb', 'created')
                ->where('status', '=', 'active')
                ->where('a.id', '!=', $params['article_id'])
                ->where('category_id', '=', $params['category_id'])
                ->take(4);
            $result = $query->get()->toArray();
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
            $result = self::select('id', 'name', 'slug', 'short_description', 'description', 'image', 'quote', 'status', 'view', )->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'image')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-item') {
            $result = self::select('a.id', 'a.name', 'content', 'a.category_id', 'c.name as category_name', 'a.thumb', 'a.created', 'c.display')
                ->leftJoin('category as c', 'a.category_id', '=', 'c.id')
                ->where('a.id', '=', $params['article_id'])
                ->where('a.status', '=', 'active')->first();
            if ($result) $result = $result->toArray();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        $this->table = 'posts';
        if ($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status]);
        }

        if ($options['task'] == 'change-type') {
            // dd($params);
          
            self::where('id', $params['id'])->update(['category_id' => $params['category_id']]);
        }


        if ($options['task'] == 'add-item') {
            $params['created_by'] = "kerry";
            $params['created_at'] = date(config('zvn.format.db'));
            $params['user_id']    = 1;
            $params['slug']       = Str::slug($params['name']).'-'.Carbon::now()->timestamp;

            $params['image']      = $this->uploadThumb($params['thumb']);
            // dd($params);
            self::insert($this->prepareParams($params));
        }

        if ($options['task'] == 'edit-item') {
          
            if (!empty($params['thumb'])) {
                // X??a h??nh c??
                $this->deleteThumb($params['thumb_current']);

                // Up h??nh m???i
                $params['image']      = $this->uploadThumb($params['thumb']);
            }

            $params['updated_by'] = "kerry";
            $params['updated_at'] = date(config('zvn.format.db'));

            self::where(['id' => $params['id']])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        $this->table = 'posts';
        if ($options['task'] == 'delete-item') {
            $item   = $this->getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }
}
