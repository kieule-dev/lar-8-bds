<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MessageModel as MainModel;
use App\Http\Requests\MessageRequest as MainRequest;

class MessageController extends Controller
{
    private $pathViewController = 'admin.pages.message.';  // slider
    private $controllerName     = 'message';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 7;
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
      
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', ''); 
        $this->params['search']['value']  = $request->input('search_value', '');

        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        // dd($items);
        // $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']); 

        return view($this->pathViewController .  'index', [
            'params'           => $this->params,
            'items'            => $items,
            // 'itemsStatusCount' => $itemsStatusCount
        ]);
    }

    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Delete item successfully!');
    }
}
