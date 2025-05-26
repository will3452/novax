# NovaX - Enterprise Resource Planning System

## Project Overview

NovaX is a comprehensive business management system built with Laravel and Laravel Nova. It provides a complete solution for multi-branch businesses to manage inventory, sales, customers, suppliers, and reporting in a centralized platform. The system is designed to be modular, scalable, and customizable to meet the needs of various business types.

## Key Features

-   **Multi-branch Management**: Operate and manage multiple store locations from a single system
-   **Inventory Management**: Track stock levels across branches with automated inventory updates
-   **Point of Sale (POS)**: Process sales transactions with support for multiple payment methods
-   **Customer Management**: Maintain customer records and purchase history
-   **Supplier Management**: Track suppliers, purchase orders, and payments
-   **Invoicing System**: Generate and manage professional invoices
-   **Financial Reporting**: Comprehensive reporting for sales, inventory, and financial performance
-   **User Access Control**: Role-based permissions for different staff levels
-   **Dashboard Analytics**: Visual representations of key business metrics
-   **Data Import/Export**: Tools for bulk data operations

## Modules Description

### 1. Branch Management

-   Branch creation and configuration
-   Branch-specific inventory and sales tracking
-   Branch performance dashboards
-   Staff assignment to branches

### 2. Inventory Management

-   Product catalog management
-   Stock level tracking
-   Reorder point notifications
-   Inventory transfers between branches
-   Brand and category organization
-   Inventory valuation reports

### 3. Sales Management

-   Point of Sale interface
-   Order processing
-   Multiple payment methods
-   Discounts and promotions
-   Sales returns and refunds
-   Daily sales reports

### 4. Customer Management

-   Customer records and profiles
-   Purchase history tracking
-   Customer credit management
-   Special pricing arrangements
-   Customer loyalty features

### 5. Supplier Management

-   Supplier directory
-   Purchase order creation and tracking
-   Supplier billing and payment tracking
-   Supplier performance metrics

### 6. Reporting & Analytics

-   Daily sales reports
-   Inventory status reports
-   Financial performance metrics
-   Branch comparison analytics
-   Custom report generation
-   Data visualization dashboards

### 7. User Management

-   Role-based access control
-   User activity logging
-   Permissions management
-   Staff performance tracking

## Technical Architecture

NovaX is built on modern web technologies with a focus on security, performance, and scalability:

-   **Backend**: Laravel 8.x PHP framework
-   **Admin Interface**: Laravel Nova
-   **Database**: MySQL
-   **Authentication**: Laravel Sanctum
-   **Authorization**: Spatie Laravel Permissions
-   **Search**: Algolia Scout
-   **Reporting**: Custom reporting engine with data export capabilities
-   **Backup**: Spatie Laravel Backup

The application follows a modular architecture with:

-   Models for data structure
-   Repositories for data access
-   Services for business logic
-   Controllers for request handling
-   Nova resources for admin interface
-   Custom Nova actions for business processes

## Installation

### System Requirements

-   PHP 8.0 or higher
-   MySQL 5.7 or higher
-   Composer 2.0 or higher
-   Node.js 14.x or higher
-   NPM 6.x or higher
-   Apache or Nginx web server
-   SSL certificate (recommended for production)

### Prerequisites

-   XAMPP (for local development)
-   Composer
-   Git

### Step 1: Install XAMPP

Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).

### Step 2: Install Composer

Install Composer by following the instructions for your operating system at [https://getcomposer.org/](https://getcomposer.org/).

### Step 3: Clone the Project

Clone the project repository from GitHub:

```bash
git clone https://github.com/username/novax.git
cd novax
```

### Step 4: Install Dependencies

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
npm run dev
```

### Step 5: Environment Configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Edit the `.env` file to set your database credentials and other configuration options:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=novax
DB_USERNAME=root
DB_PASSWORD=
```

### Step 6: Generate Application Key

```bash
php artisan key:generate
```

### Step 7: Run Migrations and Seeders

Set up the database tables and seed with initial data:

```bash
php artisan migrate --seed
```

### Step 8: Configure Virtual Hosts (Optional)

For local development with a custom domain, modify the httpd-vhosts.conf file in the XAMPP\apache\conf\extra directory:

```
<VirtualHost *:80>
    DocumentRoot "/path/to/novax/public"
    ServerName novax.local
    <Directory "/path/to/novax">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Update your hosts file to map the virtual host:

```
127.0.0.1 novax.local
```

### Step 9: Start Services

Start Apache and MySQL in XAMPP using the XAMPP control panel.

### Step 10: Access the Application

Open your web browser and navigate to:

-   http://localhost/novax/public or
-   http://novax.local (if you configured virtual hosts)

## Laravel Nova Setup

NovaX uses Laravel Nova for its admin interface. Follow these steps to set up Nova:

### Step 1: Configure Nova in .env

Make sure your `.env` file includes:

```
NOVA_LICENSE_KEY=your-license-key
```

### Step 2: Install Nova Dependencies

```bash
php artisan nova:install
```

### Step 3: Publish Nova Assets

```bash
php artisan nova:publish
```

### Step 4: Create a Nova Admin User

```bash
php artisan nova:user
```

### Step 5: Access Nova Admin Panel

Navigate to `/admin` in your browser to access the Nova admin panel.

## Multi-Branch Configuration

To set up a multi-branch environment:

### Step 1: Create Branches

Use the Nova admin panel to create branches with the following information:

-   Branch name
-   Address
-   Contact information
-   Manager assignment

### Step 2: Set Default Branch

Configure the default branch in the Settings section of Nova.

### Step 3: Configure Inventory

Initialize inventory for each branch:

```bash
php artisan inventory:initialize --branch=branch_id
```

### Step 4: Configure Users and Permissions

Assign staff to specific branches and configure their permissions:

1. Create user accounts for staff
2. Assign appropriate roles (Cashier, Manager, Admin)
3. Configure branch assignments

### Step 5: Configure Reports

Set up branch-specific reporting:

```bash
php artisan reports:configure
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.
