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
            'class' => 'form-control col-md-6 col-xs-12',

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
        'city' => [
            'default' => 'Select city',
            'An Giang'         => 'An Giang',
            'Bà Rịa-Vũng Tàu'  => 'Bà Rịa-Vũng Tàu',
            'Bạc Liêu'         => 'Bạc Liêu',
            'Bắc Kạn'          => 'Bắc Kạn',
            'Bắc Giang'        => 'Bắc Giang',
            'Bắc Ninh'         => 'Bắc Ninh',
            'Bến Tre'          => 'Bến Tre',
            'Bình Dương'       => 'Bình Dương',
            'Bình Định'        => 'Bình Định',
            'Bình Phước'       => 'Bình Phước',
            'Bình Thuận'       => 'Bình Thuận',
            'Cà Mau'           => 'Cà Mau',
            'Cao Bằng'         => 'Cao Bằng',
            'Cần Thơ (TP)'     => 'Cần Thơ (TP)',
            'Đà Nẵng (TP)'     => 'Đà Nẵng (TP)',
            'Đắk Lắk'          => 'Đắk Lắk',
            'Đắk Nông'         => 'Đắk Nông',
            'Điện Biên'        => 'Điện Biên',
            'Đồng Nai'         => 'Đồng Nai',
            'Đồng Tháp'        => 'Đồng Tháp',
            'Gia Lai'          => 'Gia Lai',
            'Hà Giang'         => 'Hà Giang',
            'Hà Nam'           => 'Hà Nam',
            'Hà Nội (TP)'      => 'Hà Nội (TP)',
            'Hà Tây'           => 'Hà Tây',
            'Hà Tĩnh'          => 'Hà Tĩnh',
            'Hải Dương'        => 'Hải Dương',
            'Hải Phòng (TP)'   => 'Hải Phòng (TP)',
            'Hòa Bình'         => 'Hòa Bình',
            'Hồ Chí Minh (TP)' => 'Hồ Chí Minh (TP)',
            'Hậu Giang'        => 'Hậu Giang',
            'Hưng Yên'         => 'Hưng Yên',
            'Khánh Hòa'        => 'Khánh Hòa',
            'Kiên Giang'       => 'Kiên Giang',
            'Kon Tum'          => 'Kon Tum',
            'Lai Châu'         => 'Lai Châu',
            'Lào Cai'          => 'Lào Cai',
            'Lạng Sơn'         => 'Lạng Sơn',
            'Lâm Đồng'         => 'Lâm Đồng',
            'Long An'          => 'Long An',
            'Nam Định'         => 'Nam Định',
            'Nghệ An'          => 'Nghệ An',
            'Ninh Bình'        => 'Ninh Bình',
            'Ninh Thuận'       => 'Ninh Thuận',
            'Phú Thọ'          => 'Phú Thọ',
            'Phú Yên'          => 'Phú Yên',
            'Quảng Bình'       => 'Quảng Bình',
            'Quảng Nam'        => 'Quảng Nam',
            'Quảng Ngãi'       => 'Quảng Ngãi',
            'Quảng Ninh'       => 'Quảng Ninh',
            'Quảng Trị'        => 'Quảng Trị',
            'Sóc Trăng'        => 'Sóc Trăng',
            'Sơn La'           => 'Sơn La',
            'Tây Ninh'         => 'Tây Ninh',
            'Thái Bình'        => 'Thái Bình',
            'Thái Nguyên'      => 'Thái Nguyên',
            'Thanh Hóa'        => 'Thanh Hóa',
            'Thừa Thiên - Huế' => 'Thừa Thiên - Huế',
            'Tiền Giang'       => 'Tiền Giang',
            'Trà Vinh'         => 'Trà Vinh',
            'Tuyên Quang'      => 'Tuyên Quang',
            'Vĩnh Long'        => 'Vĩnh Long',
            'Vĩnh Phúc'        => 'Vĩnh Phúc',
            'Yên Bái'          => 'Yên Bái'
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
            'admin'  => ['name' => 'Admin'],
            'member' => ['name' => 'Member'],
        ],
        'search'       => [
            'all'           => ['name' => 'Search by All'],
            'id'            => ['name' => 'Search by ID'],
            'name'          => ['name' => 'Search by Name'],
            'username'      => ['name' => 'Search by Username'],
            'fullname'      => ['name' => 'Search by Fullname'],
            'email'         => ['name' => 'Search by Email'],
            'description'   => ['name' => 'Search by Description'],
            'link'          => ['name' => 'Search by Link'],
            'content'       => ['name' => 'Search by Content'],

        ],
        'button' => [
            'edit'      => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
            'delete'    => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
            'info'      => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-pencil', 'route-name' => '/delete'],
        ]

    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id', 'fullname'],
            'companies' => ['all', 'id'],
            'facilities' => ['all', 'id'],
            'slider'    => ['all', 'id', 'name', 'description', 'link'],
            'category'  => ['all', 'name'],
            'article'   => ['all', 'name', 'content'],
            'rss'       => ['all', 'name', 'link'],
            'user'      => ['all', 'username', 'email', 'fullname'],
        ],
        'button' => [
            'default'    => ['edit', 'delete'],
            'slider'     => ['edit', 'delete'],
            'setting'     => ['edit'],
            'message'    => ['delete'],
            'companies'  => ['edit', 'delete'],
            'facilities' => ['edit', 'delete'],
            'property'   => ['edit', 'delete'],
            'category'   => ['edit', 'delete'],
            'article'    => ['edit', 'delete'],
            'rss'        => ['edit', 'delete'],
            'user'       => ['edit'],
        ]
    ]

];
