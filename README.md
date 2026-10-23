# Simple POS - Laravel

Point of Sale system with product management, cart, and transaction tracking.

Repository: https://github.com/0xyz-exe/simple-pos-laravel

## Screenshots

### Cashier POS Checkout Interface
![POS checkout](docs/screenshots/01_pos_checkout.png)

### Product Catalog & Stock Management
![Product catalog](docs/screenshots/02_products.png)

### Transaction History & Daily Sales
![Transactions](docs/screenshots/03_transactions.png)

### Authentication
![Authentication](docs/screenshots/04_login.png)

## Features

- User authentication
- Product management (CRUD, SKU, categories)
- Real-time cart
- Checkout with stock validation
- Transaction history with daily sales summary
- Database transactions for inventory safety
- Stock deduction on checkout

## Tech Stack

- Laravel 13.38.0
- PHP 8.5.0
- Breeze authentication
- SQLite
- Tailwind CSS

## Installation

```bash
git clone https://github.com/0xyz-exe/simple-pos-laravel.git
cd simple-pos-laravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

## Demo Account

- Email: demo@example.com
- Password: password

## Database Schema

- **categories**: id, name, description
- **products**: id, category_id, name, sku, price, stock
- **transactions**: id, transaction_code, user_id, subtotal, tax, discount, total
- **transaction_items**: id, transaction_id, product_id, quantity, price, subtotal

## Features Detail

### POS Interface
Add products to cart, adjust quantities, checkout with automatic stock deduction.

### Product Management
Full CRUD, SKU validation, category assignment, stock tracking.

### Transaction History
View all transactions with date, total, and detailed items. Daily sales summary.

### Inventory Safety
Database transactions prevent overselling. Locks ensure stock accuracy during checkout.

## Security

- CSRF protection
- SQL injection prevention
- Transaction rollback on errors
- Stock validation before checkout

## Repository

https://github.com/0xyz-exe/simple-pos-laravel
