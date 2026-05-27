# 💄 Cosmetics E-commerce Website - Laravel 11

This is a full-featured cosmetics e-commerce web application built with **Laravel 11**. It provides a comprehensive platform for browsing cosmetics, shopping online, and managing store operations through a dedicated admin panel.

## 🚀 Key Features

### 🛍️ User / Customer Features
- **Product Browsing & Advanced Search:** Explore products with high-performance search powered by **Elasticsearch** & **Laravel Scout**.
- **Shopping Cart & Checkout:** Seamlessly add items to the cart and process orders.
- **Order Management:** Track order status and view history.
- **Location-based Shipping:** Calculate shipping with accurate geographical data (Province, District, Ward).
- **Product Reviews & Comments:** Users can leave comments and feedback on products.
- **Discounts & Promotions:** Apply discount codes during checkout.
- **Newsletter Subscription:** Subscribe to receive updates and promotions.

### 🛡️ Admin / Management Features
- **Role-based Access Control:** Manage admins, roles, and fine-grained permissions.
- **Catalog Management:** Organize the store with Brands, Categories, and Products.
- **Media Management:** Efficiently handle product images using `spatie/laravel-medialibrary`.
- **Order Fulfillment:** Manage incoming orders, order items, and transportation status.
- **User & Customer Management:** Oversee registered users and newsletter subscribers.

## 🛠 Technologies & Stack

### Backend
- **PHP 8.2+**
- **Laravel 11.x**
- **Database:** MySQL / MariaDB
- **Authentication:** Laravel Sanctum (API tokens) & Web Auth
- **Search Engine:** Elasticsearch (via `matchish/laravel-scout-elasticsearch`)
- **Media Management:** Spatie Media Library (`spatie/laravel-medialibrary`)

### Frontend
- **Vite** (Asset Bundler)
- **Axios** (HTTP Client)
- Blade Templates & modern CSS/JS workflow

## 📦 Installation & Setup

1. **Clone the repository** (or extract the project files).
2. **Install PHP dependencies:**
   ```bash
   composer install
   ```
3. **Install Node dependencies:**
   ```bash
   npm install
   ```
4. **Environment Setup:**
   Copy `.env.example` to `.env` and configure your database and Elasticsearch settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate --seed
   ```
6. **Compile Frontend Assets:**
   ```bash
   npm run build # or npm run dev for local development
   ```
7. **Start the Development Server:**
   ```bash
   php artisan serve
   ```

## 📄 License

This project is open-sourced software licensed under the MIT license.
