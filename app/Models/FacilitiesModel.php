<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;

class FacilitiesModel extends AdminModel
{
    public function __construct() {
        $this->table               = 'facilities';
        $this->folderUpload        = 'facilities' ; 
        $this->fieldSearchAccepted = ['id', 'name']; 
        $this->crudNotAccepted     = ['_token','thumb_current', 'thumb'];
    }

    public function listItems($params = null, $options = null) {
     
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = $this->select('id', 'name', 'image', 'status', 'created_at', 'created_by', 'modified_at', 'modified_by');
               
            if ($params['filter']['status'] !== "all")  {
                $query->where('status', '=', $params['filter']['status'] );
            }

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }

            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }

        if($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name', 'description', 'link', 'thumb')
                        ->where('status', '=', 'active' )
                        ->limit(5);

            $result = $query->get()->toArray();
        }



        return $result;
    }

    public function countItems($params = null, $options  = null) {
     
        $result = null;

        if($options['task'] == 'admin-count-items-group-by-status') {
         
            $query = $this::groupBy('status')
                        ->select( DB::raw('status , COUNT(id) as count') );

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }

            $result = $query->get()->toArray();
           

        }

        return $result;
    }

    public function getItem($params = null, $options = null) { 
        $result = null;
        
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'status', 'image')->where('id', $params['id'])->first();
        }

        if($options['task'] == 'get-thumb') {
            $result = self::select('id', 'image')->where('id', $params['id'])->first();
        }

        return $result;
    }

    public function saveItem($params = null, $options = null) { 
        if($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            $dayTime = date(config('zvn.format.db')) ;
            self::where('id', $params['id'])->update(['status' => $status, 'modified_at' => $dayTime]);
        }

        if($options['task'] == 'add-item') {
            $params['created_by'] = "kerry";
            $params['created_at'] = date(config('zvn.format.db'));
           
            $params['image']      = $this->uploadThumb($params['thumb']);
            self::insert($this->prepareParams($params));        
        }

        if($options['task'] == 'edit-item') {
            if(!empty($params['thumb'])){
                $this->deleteThumb($params['thumb_current']);
                $params['image'] = $this->uploadThumb($params['thumb']);
            }
            $params['modified_by']   = "kerry";
            $params['modified_at']   =  date(config('zvn.format.db'));
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null) 
    { 
        if($options['task'] == 'delete-item') {
            $item   = self::getItem($params, ['task'=>'get-thumb']); // 
            $this->deleteThumb($item['image']);
            self::where('id', $params['id'])->delete();
        }
    }

}

