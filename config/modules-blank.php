<?php

    return [
        // vendor modules template
        "vendor" => [
            'dashboard'=>[
                'name'=> 'Dashboard',
                'slug' => 'dashboard',
                'id' => 1,
                'parent' => false,
                'operations' => [ 'dump' ],
                'childs' => []

            ],
            'products'=>[
                'name'=> 'Products',
                'slug' => 'products',
                'id' => 2,
                'parent' => true,
                'operations' => [ 'dump'],
                'childs' => [
                    'add_products'=>[
                        'name'=> 'Add Products',
                        'slug' => 'add_products',
                        'id' => 1,
                        'parent' => false,
                        'operations' => [
                            'dump'
                        ]
                    ],
                    'manage_products'=>[
                        'name'=> 'Manage Products',
                        'slug' => 'manage_products',
                        'id' => 2,
                        'parent' => false,
                        'operations' => [ 'dump'],
                        'childs' => [

                        ]

                    ]
                ]

            ],
            'orders'=>[
                'name'=> 'Orders',
                'slug' => 'orders',
                'id' => 2,
                'parent' => true,
                'operations' => [ 'dump'],
                'childs' => [
                    'manage_orders'=>[
                        'name'=> 'Manage Orders',
                        'slug' => 'manage_orders',
                        'id' => 1,
                        'parent' => false,
                        'operations' => [ 'dump'],
                        'childs' => [

                        ]
                    ],
                ]



            ]


        ],

        // admin modules template
        "admin" => [
            'dashboard'=>[
                'name'=> 'dashboard',
                'slug' => 'dashboard',
                'id' => 1,
                'parent' => false,
                'operations' => ['create', 'read' , 'update' , 'delete'  ],

            ]
        ]





    ];


?>
