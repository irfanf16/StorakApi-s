# Storak Marketplace API

Full-featured **multi-vendor e-commerce REST API** (Laravel 8, JWT auth). Supports buyers, vendors, and admins — 3-level categories, product variants with SKU/attribute system, order splitting per vendor, coupons, buyer user-stores/collections, delivery slots, commission tracking, Pusher notifications, and bilingual AR/EN content.

![PHP](https://img.shields.io/badge/PHP-8.0-777BB4?style=flat&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-8.x-FF2D20?style=flat&logo=laravel)
![JWT Auth](https://img.shields.io/badge/JWT--Auth-tymon_1.0-orange?style=flat)
![Pusher](https://img.shields.io/badge/Pusher-7.0-300D4F?style=flat&logo=pusher)
![Laravel Scout](https://img.shields.io/badge/Laravel_Scout-9.4-FF2D20?style=flat&logo=laravel)
![Google Translate](https://img.shields.io/badge/Google_Translate-stichoza-4285F4?style=flat&logo=googletranslate)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat&logo=mysql)

## Features

**Storefront (Public)** — Homepage: banners, categories, featured/sale/mega-deals/top-selling products. Product detail, brands, search + refinement.

**Buyer (JWT Auth)** — Profile, addresses, reviews (submit/reply), Q&A, product likes, cart (add/remove/transfer to wishlist), wishlist, orders (place/list/detail/cancel), user store + collections.

**Vendor** — Full onboarding with KYC (business info + documents), mobile/email OTP verification. Product CRUD + bulk Excel upload, variants, order management, coupon creation.

**Shipping** — Shipping company webhook integration, delivery status updates.

**Admin Panel** (200+ routes) — Full CRUD for all entities, bulk product upload, AR/EN translation management, commission rules, sub-roles.

## Database Schema (Key Tables)

| Table | Key Columns | Purpose |
|---|---|---|
| `users` | `id`, `name`, `role_id`, `email`, `mobile`, `vendor_profile_status`, `provider_id` | All users |
| `stores` | `user_id`, `seller_id`, `store_name`, `logo_image`, `commission_rate`, `holiday_mode` | Vendor stores |
| `products` | `store_id`, `category_id`, `name`, `slug`, `primary_image`, `avg_rating`, `views`, `sales` | Catalogue |
| `product_variants` | `product_id`, `price`, `special_price`, `quantity`, `seller_sku`, `availability` | Variants |
| `orders` | `user_id`, `total`, `payment_method`, `delivery_slot_id`, `address_id` | Orders |
| `order_packages` | `order_id`, `store_id`, `fulfillment_id`, `order_status_id`, `package_bill` | Per-vendor split |
| `coupons` | `store_id`, `code`, `discount_type`, `discount_value`, `expire_at` | Coupons |
| `translations` | `model_type`, `model_id`, `field`, `locale`, `value` | AR/EN content |
| `business_information` | `user_id`, `company_name`, `person_id_type`, `person_id_no` | Vendor KYC |
| `user_stores` / `collections` | `user_id`, `name`, `slug`, `likes`, `followers` | Buyer stores |
| `delivery_slots` | `name`, `name_ar`, `start_time`, `end_time` | Delivery windows |
| `commissions` | `store_id`, `category_id`, `rate` | Commission rates |

## Architecture

```
routes/api.php (JWT)
  ├── Public: search, browse, product detail
  ├── Buyer (jwt.verify): cart, wishlist, orders, profile, user-store
  └── Vendor (jwt.verify): products, orders, coupons, store management

routes/web.php (Admin Blade UI)
  └── /admin/*: full CRUD + bulk upload + translation management

External: Pusher, Scout (search), Google Translate (AR/EN), Intervention Image
```

## Getting Started

```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan migrate && php artisan db:seed
php artisan jwt:secret
php artisan serve
```

## Environment Variables

| Variable | Purpose |
|---|---|
| `JWT_SECRET` | JWT signing secret (`php artisan jwt:secret`) |
| `PUSHER_APP_*` | Real-time notifications |
| `AWS_*` | S3 product images |
| `DB_*` | MySQL connection |

## License
MIT
