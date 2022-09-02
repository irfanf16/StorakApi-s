<?php

    return [
        // vendor modules template
        "vendor" => [
            [
                'name'=> 'Dashboard',
                'slug' => 'dashboard',
                'id' => 1,
                'parent' => false,
                'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                'childs' => [

                ]
            ],
            [
                'name'=> 'Products',
                'slug' => 'products',
                'id' => 2,
                'parent' => true,
                'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                'childs' => [
                    [
                        'name'=> 'Add Products',
                        'slug' => 'add_products',
                        'id' => 1,
                        'parent' => false,
                        'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                        'childs' => [

                        ]
                    ],
                    [
                        'name'=> 'Manage Products',
                        'slug' => 'manage_products',
                        'id' => 2,
                        'parent' => false,
                        'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                        'childs' => [

                        ]
                    ],
                ]
            ],
            [
                'name'=> 'Orders',
                'slug' => 'orders',
                'id' => 2,
                'parent' => true,
                'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                'childs' => [

                    [
                        'name'=> 'Manage Orders',
                        'slug' => 'manage_orders',
                        'id' => 1,
                        'parent' => false,
                        'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                        'childs' => [

                        ]
                    ],
                ]
            ]


        ],

        // admin modules template
        "admin" => [
            [
                'name'=> 'dashboard',
                'slug' => 'dashboard',
                'id' => 1,
                'parent' => false,
                'oprations' => ['create', 'read' , 'update' , 'delete'  ],
                'childs' => [

                ]
            ]
        ]





    ];


?>