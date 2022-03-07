<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest;

class UserController extends Controller
{
    private $pathViewController = 'admin.pages.user.';
    private $controllerName     = 'user';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 5;
        view()->share('controllerName', $this->controllerName);
    }

    public function save(MainRequest $request)
    {

        if ($request->method() == 'POST') {
            $params = $request->all();


            $task   = "add-item";
            $notify = "Add success element!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Update success element!";
            }
            $this->model->saveItem($params, ['task' => $task]);

            // dd($params['task']);

            if (isset($params['task'])) {
                return redirect()->route('home')->with("zvn_notify", $notify);
            }
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }
}
