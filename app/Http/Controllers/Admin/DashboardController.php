<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    private $pathViewController = 'admin.pages.dashboard.';  // slider
    private $controllerName     = 'dashboard';

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
       
        return view($this->pathViewController .  'index', []);
    }
}
