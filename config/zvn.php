<?php

return [
    'url'              => [
        'prefix_admin' => 'admin123',
        'prefix_news'  => 'home',
    ],
    'format'           => [
        'long_time'  => 'H:i:s d-m-Y',
        'short_time' => 'd-m-Y',
        'db'         => 'Y-m-d H:i:s',
    ],
    'template'         => [

        'form_input' => [
            'class' => 'form-control col-md-6 col-xs-12'
        ],
        'form_input_imgs' => [
            'class' => 'form-control col-md-6 col-xs-12',
            'multiple' => '',
        ],
        'form_label' => [
            'class' => 'control-label col-md-3 col-sm-3 col-xs-12'
        ],
        'form_label_edit' => [
            'class' => 'control-label col-md-4 col-sm-3 col-xs-12'
        ],
      
        'form_ckeditor' => [
            'class' => 'form-control col-md-6 col-xs-12 ckeditor'
        ],
        'status'       => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active'   => ['name' => 'Active', 'class'      => 'btn-success'],
            'inactive' => ['name' => 'Inactive', 'class' => 'btn-info'],
            'block'    => ['name' => 'Bị khóa', 'class' => 'btn-danger'],
            'default'  => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ],
        'type'       => [
            'apartment' => ['name' => 'Apartment', 'class' => 'btn-success'],
            'house'     => ['name' => 'House', 'class'      => 'btn-info'],
            'default'   => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ],
        'purpose'       => [
            'sell' => ['name' => 'Sell', 'class' => 'btn-success'],
            'lease'     => ['name' => 'Lease', 'class'      => 'btn-info'],
            'default'   => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ],
       
       
        // 'type' => [
        //     'featured'   => ['name'=> 'Nổi bật'],
        //     'normal'     => ['name'=> 'Bình thường'],
        // ],
        // 'rss_source' => [
        //     'vnexpress'   => ['name'=> 'VNExpress'],
        //     'tuoitre'     => ['name'=> 'Tuổi Trẻ'],
        // ],
        'level'       => [
            'admin'  => ['name'=> 'Admin'],
            'member' => ['name'=> 'Member'],
        ],
        'search'       => [
            'all'           => ['name'=> 'Search by All'],
            'id'            => ['name'=> 'Search by ID'],
            'name'          => ['name'=> 'Search by Name'],
            'username'      => ['name'=> 'Search by Username'],
            'fullname'      => ['name'=> 'Search by Fullname'],
            'email'         => ['name'=> 'Search by Email'],
            'description'   => ['name'=> 'Search by Description'],
            'link'          => ['name'=> 'Search by Link'],
            'content'       => ['name'=> 'Search by Content'],
            
        ],
        'button' => [
            'edit'      => ['class'=> 'btn-success' , 'title'=> 'Edit'      , 'icon' => 'fa-pencil' , 'route-name' => '/form'],
            'delete'    => ['class'=> 'btn-danger btn-delete'  , 'title'=> 'Delete'    , 'icon' => 'fa-trash'  , 'route-name' => '/delete'],
            'info'      => ['class'=> 'btn-info'    , 'title'=> 'View'      , 'icon' => 'fa-pencil' , 'route-name' => '/delete'],
        ]
            
    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id', 'fullname'],
            'companies' => ['all', 'id'],
            'facilities'=> ['all', 'id'],
            'slider'    => ['all', 'id', 'name', 'description', 'link'],
            'category'  => ['all', 'name'],
            'article'   => ['all', 'name', 'content'],
            'rss'       => ['all', 'name', 'link'],
            'user'      => ['all', 'username', 'email', 'fullname'],
        ],
        'button' => [
            'default'   => ['edit', 'delete'],
            'slider'    => ['edit', 'delete'],
            'companies' => ['edit', 'delete'],
            'facilities' => ['edit', 'delete'],
            'property'  => ['edit', 'delete'],
            'category'  => ['edit', 'delete'],
            'article'   => ['edit', 'delete'],
            'rss'       => ['edit', 'delete'],
            'user'      => ['edit'],
        ]
    ]
    
];