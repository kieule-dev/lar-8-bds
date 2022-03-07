<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefixAdmin = config('zvn.url.prefix_admin');
$prefixNews  = config('zvn.url.prefix_news');


//!=================================================== ADMIN =======================================================
Route::group(['prefix' => $prefixAdmin, 'namespace' => 'Admin', 'middleware' => ['permission.admin']], function () {

    // ============================== DASHBOARD ==============================
    $prefix         = '';
    $controllerName = 'dashboard';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    });


    // ============================== DASHBOARD ==============================
    $prefix         = 'dashboard';
    $controllerName = 'dashboard';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
    });


    //============================== SLIDER ==============================
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });


    //============================== SLIDER ==============================
    $prefix         = 'setting';
    $controllerName = 'setting';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    //============================== Message ==============================
    $prefix         = 'message';
    $controllerName = 'message';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
    });


    //============================== Companies ==============================
    $prefix         = 'companies';
    $controllerName = 'companies';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });


    //============================== Facilities ==============================
    $prefix         = 'facilities';
    $controllerName = 'facilities';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });



    $prefix         = 'property';
    $controllerName = 'property';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,       'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });

    // ============================== CATEGORY ==============================
    $prefix         = 'category';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
        Route::get('change-is-home-{is_home}/{id}',     ['as' => $controllerName . '/isHome',     'uses' => $controller . 'isHome'])->where('id', '[0-9]+');
        Route::get('change-display-{display}/{id}',     ['as' => $controllerName . '/display',     'uses' => $controller . 'display']);
    });

    // ============================== ARTICLE ==============================
    $prefix         = 'article';
    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::get('change-type-{type}/{id}',           ['as' => $controllerName . '/type',        'uses' => $controller . 'type']);
    });



    // ============================== USER ==============================
    $prefix         = 'user';
    $controllerName = 'user';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                                 ['as' => $controllerName,                      'uses' => $controller . 'index']);
        Route::get('form/{id?}',                        ['as' => $controllerName . '/form',            'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                             ['as' => $controllerName . '/save',            'uses' => $controller . 'save']);
        Route::post('change-password',                  ['as' => $controllerName . '/change-password', 'uses' => $controller . 'changePassword']);
        Route::post('change-level',                     ['as' => $controllerName . '/change-level',    'uses' => $controller . 'changeLevel']);
        Route::get('delete/{id}',                       ['as' => $controllerName . '/delete',          'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',       ['as' => $controllerName . '/status',      'uses' => $controller . 'status']);
        Route::get('change-level-{level}/{id}',         ['as' => $controllerName . '/level',      'uses' => $controller . 'level']);
    });




    // ============================== RSS ==============================
    $prefix         = 'rss';
    $controllerName = 'rss';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                             ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('form/{id?}',                    ['as' => $controllerName . '/form',        'uses' => $controller . 'form'])->where('id', '[0-9]+');
        Route::post('save',                         ['as' => $controllerName . '/save',        'uses' => $controller . 'save']);
        Route::get('delete/{id}',                   ['as' => $controllerName . '/delete',      'uses' => $controller . 'delete'])->where('id', '[0-9]+');
        Route::get('change-status-{status}/{id}',   ['as' => $controllerName . '/status',      'uses' => $controller . 'status'])->where('id', '[0-9]+');
    });
});








//!=================================================== HOME =======================================================
Route::group(['prefix' => $prefixNews, 'namespace' => 'News'], function () {

    //============================== HOME ==============================
    $prefix         = '';
    $controllerName = 'home';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',         ['as' => $controllerName,                  'uses' => $controller . 'index']);
        Route::get('/search',   ['as' => $controllerName. '.search',       'uses' => $controller . 'search']);
    });

    //============================== PROPERTY ==============================
    $prefix         = 'property';
    $controllerName = 'property';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('/',                ['as' => $controllerName . '.index',       'uses' => $controller . 'index']);
        Route::get('/{slug}',          ['as' => $controllerName . '.detail',       'uses' => $controller . 'detail']);
        Route::get('/city/{city}',     ['as' => $controllerName . '.city',         'uses' => $controller . 'city']);
        Route::get('/citys/all',       ['as' => $controllerName . '.citys',        'uses' => $controller . 'citys']);
        Route::get('/category/{name}', ['as' => $controllerName . '.category',     'uses' => $controller . 'category']);
        Route::post('/message',        ['as' => $controllerName . '.message',      'uses' => $controller . 'message']);
    });


    //============================== NEWS ==============================
    $prefix         = 'news';
    $controllerName = 'news';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/',                    ['as' => $controllerName,              'uses' => $controller . 'news']);
        Route::get('/{slug}',              ['as' => $controllerName . '.detail',   'uses' => $controller . 'detail']);
        Route::post('/comment',            ['as' => $controllerName . '.comment',  'uses' => $controller . 'comment']);
        Route::get('/search/news',         ['as' => $controllerName . '.search',   'uses' => $controller . 'search']);
        Route::get('/categories/{slug}',   ['as' => $controllerName . '.category',   'uses' => $controller . 'category']);
    });

    //============================== CONTACT ==============================
    $prefix         = 'contact';
    $controllerName = 'news';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('/',            ['as' => 'contact',              'uses' => $controller . 'contact']);
    });
    //============================== USER ==============================
    $prefix         = 'user';
    $controllerName = 'home';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('/property',            ['as' => 'user.property',                'uses' => $controller . 'property']);
        Route::post('/property',           ['as' => 'user.store',                   'uses' => $controller . 'store']);
        Route::post('save',                ['as' => $controllerName . '/save',      'uses' => $controller . 'save']);
        Route::get('profile',               ['as' => $controllerName . '.profile',  'uses' => $controller . 'profile']);
        Route::put('profile/update',        ['as' => $controllerName . '.update',   'uses' => $controller . 'update']);
    });

    //============================== REGISTER ==============================
    $prefix         = 'register';
    $controllerName = 'auth';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';

        Route::get('/',            ['as' => 'register',              'uses' => $controller . 'register']);
    });


















    // ============================== CATEGORY ==============================
    $prefix         = 'chuyen-muc';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/{category_name}-{category_id}.html',  ['as' => $controllerName . '/index', 'uses' => $controller . 'index'])
            ->where('category_name', '[0-9a-zA-Z_-]+')
            ->where('category_id', '[0-9]+');
    });

    // ====================== ARTICLE ========================
    $prefix         = 'bai-viet';
    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/{article_name}-{article_id}.html',  ['as' => $controllerName . '/index', 'uses' => $controller . 'index'])
            ->where('article_name', '[0-9a-zA-Z_-]+')
            ->where('article_id', '[0-9]+');
    });

    // ============================== NOTIFY ==============================
    $prefix         = '';
    $controllerName = 'notify';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/no-permission',                             ['as' => $controllerName . '/noPermission',                  'uses' => $controller . 'noPermission']);
    });

    // ====================== LOGIN ========================
    $prefix         = '';
    $controllerName = 'auth';

    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/login',        ['as' => $controllerName . '/login',      'uses' => $controller . 'login'])->middleware('check.login');
        Route::post('/postLogin',   ['as' => $controllerName . '/postLogin',  'uses' => $controller . 'postLogin']);

        // ====================== LOGOUT ========================
        Route::get('/logout',       ['as' => $controllerName . '/logout',     'uses' => $controller . 'logout']);
    });

    // ====================== RSS ========================
    $prefix         = '';
    $controllerName = 'rss';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/tin-tuc-tong-hop',                             ['as' => "$controllerName/index",                  'uses' => $controller . 'index']);
        Route::get('/get-gold',                             ['as' => "$controllerName/get-gold",                  'uses' => $controller . 'getGold']);
        Route::get('/get-coin',                             ['as' => "$controllerName/get-coin",                  'uses' => $controller . 'getCoin']);
    });
});

Route::get('page-not-found', function () {
    return view('errors.404');
})->name('errors');
