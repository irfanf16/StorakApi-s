<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $timestamp =  Carbon::now()->format('Y-m-d H:i:s');


      $data=[
            [
                'name' => 'Dashboard',
                'slug' => 'vendor-dashboard-read',
                'display_name' => 'Read',
                'permission_type' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Products',
                'slug' => 'vendor-products-read',
                'display_name' => 'Read',
                'permission_type' => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Products',
                'slug' => 'vendor-products-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Products',
                'slug' => 'vendor-products-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Orders',
                'slug' => 'vendor-orders-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Orders',
                'slug' => 'vendor-orders-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Orders',
                'slug' => 'vendor-orders-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'name' => 'Commission',
                'slug' => 'vendor-commission-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Commission',
                'slug' => 'vendor-commission-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Commission',
                'slug' => 'vendor-commission-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'name' => 'Reviews',
                'slug' => 'vendor-reviews-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Reviews',
                'slug' => 'vendor-reviews-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Reviews',
                'slug' => 'vendor-reviews-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'name' => 'Questions',
                'slug' => 'vendor-questions-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Questions',
                'slug' => 'vendor-questions-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Questions',
                'slug' => 'vendor-questions-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'name' => 'Users',
                'slug' => 'vendor-users-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Users',
                'slug' => 'vendor-users-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Users',
                'slug' => 'vendor-users-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

            [
                'name' => 'Roles',
                'slug' => 'vendor-roles-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Roles',
                'slug' => 'vendor-roles-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Roles',
                'slug' => 'vendor-roles-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Activity Log',
                'slug' => 'vendor-log-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Setting',
                'slug' => 'vendor-setting-read',
                'display_name' => 'Read',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Setting',
                'slug' => 'vendor-setting-write',
                'display_name' => 'Write',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Setting',
                'slug' => 'vendor-setting-edit',
                'display_name' => 'Edit',
                'permission_type' => 2,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],




/////////////// admin //////////////////////////////////////////////////////////
            [
                'name' => 'Dashboard',
                'slug' => 'admin-dashboard-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Categories',
                'slug' => 'admin-categories-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Categories',
                'slug' => 'admin-categories-write',
                'display_name' => 'Write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Categories',
                'slug' => 'admin-categories-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Sub Categories',
                'slug' => 'admin-subcategories-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Sub Categories',
                'slug' => 'admin-subcategories-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Sub Categories',
                'slug' => 'admin-subcategories-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Child Categories',
                'slug' => 'admin-childcategories-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Child Categories',
                'slug' => 'admin-childcategories-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Child Categories',
                'slug' => 'admin-childcategories-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Brands',
                'slug' => 'admin-brands-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Brands',
                'slug' => 'admin-brands-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Brands',
                'slug' => 'admin-brands-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Attributes',
                'slug' => 'admin-attributes-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Attributes',
                'slug' => 'admin-attributes-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Attributes',
                'slug' => 'admin-attributes-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Keys',
                'slug' => 'admin-keys-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Keys',
                'slug' => 'admin-keys-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Keys',
                'slug' => 'admin-keys-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Vendor Stores',
                'slug' => 'admin-vendorstores-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Vendor Stores',
                'slug' => 'admin-vendorstores-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Vendor Stores',
                'slug' => 'admin-vendorstores-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Customer Stores',
                'slug' => 'admin-customerstores-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Customer Stores',
                'slug' => 'admin-customerstores-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Customer Stores',
                'slug' => 'admin-customerstores-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Vendors',
                'slug' => 'admin-vendors-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Vendors',
                'slug' => 'admin-vendors-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Vendors',
                'slug' => 'admin-vendors-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Customers',
                'slug' => 'admin-customers-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Customers',
                'slug' => 'admin-customers-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Customers',
                'slug' => 'admin-customers-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Subscribers',
                'slug' => 'admin-subscribers-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Subscribers',
                'slug' => 'admin-subscribers-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Subscribers',
                'slug' => 'admin-subscribers-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Contacts',
                'slug' => 'admin-contacts-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Contacts',
                'slug' => 'admin-contacts-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Contacts',
                'slug' => 'admin-contacts-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Products',
                'slug' => 'admin-products-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Products',
                'slug' => 'admin-products-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Products',
                'slug' => 'admin-products-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Stock Management',
                'slug' => 'admin-stockmanagement-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Stock Management',
                'slug' => 'admin-stockmanagement-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Stock Management',
                'slug' => 'admin-stockmanagement-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Orders',
                'slug' => 'admin-orders-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Orders',
                'slug' => 'admin-orders-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Orders',
                'slug' => 'admin-orders-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Reviews',
                'slug' => 'admin-reviews-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Reviews',
                'slug' => 'admin-reviews-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Reviews',
                'slug' => 'admin-reviews-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Questions',
                'slug' => 'admin-questions-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Questions',
                'slug' => 'admin-questions-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Questions',
                'slug' => 'admin-questions-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Locations',
                'slug' => 'admin-locations-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Locations',
                'slug' => 'admin-locations-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Locations',
                'slug' => 'admin-locations-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Covers',
                'slug' => 'admin-covers-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Covers',
                'slug' => 'admin-covers-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Covers',
                'slug' => 'admin-covers-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Partners',
                'slug' => 'admin-partners-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Partners',
                'slug' => 'admin-partners-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Partners',
                'slug' => 'admin-partners-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'User Management',
                'slug' => 'admin-usermanagement-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'User Management',
                'slug' => 'admin-usermanagement-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'User Management',
                'slug' => 'admin-usermanagement-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Manage Roles',
                'slug' => 'admin-manageroles-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Manage Roles',
                'slug' => 'admin-manageroles-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Manage Roles',
                'slug' => 'admin-manageroles-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Site Setting',
                'slug' => 'admin-sitesetting-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Site Setting',
                'slug' => 'admin-sitesetting-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Site Setting',
                'slug' => 'admin-sitesetting-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'App Setting',
                'slug' => 'admin-appsetting-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'App Setting',
                'slug' => 'admin-appsetting-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'App Setting',
                'slug' => 'admin-appsetting-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Security Setting',
                'slug' => 'admin-securitysetting-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Security Setting',
                'slug' => 'admin-securitysetting-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Security Setting',
                'slug' => 'admin-securitysetting-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Social Links',
                'slug' => 'admin-sociallinks-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Social Links',
                'slug' => 'admin-sociallinks-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Social Links',
                'slug' => 'admin-sociallinks-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Commission',
                'slug' => 'admin-commission-read',
                'display_name' => 'Read',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Commission',
                'slug' => 'admin-commission-write',
                'display_name' => 'write',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
            [
                'name' => 'Commission',
                'slug' => 'admin-commission-edit',
                'display_name' => 'Edit',
                'permission_type' => 1,

                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],

        ];

      foreach ($data as $d){

          Permission::create([
              'name' => $d['name'],
              'slug' =>  $d['slug'],
              'display_name' => $d['display_name'],
              'permission_type' => $d['permission_type'],
              'created_at' => $timestamp,
              'updated_at' => $timestamp
          ]);
      }
    }
}
