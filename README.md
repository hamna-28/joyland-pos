<div align="center">
    <h1>Joyland POS System</h1>
    <p>A Modern & Dynamic Point of Sale Management System</p>
</div>

---
## 🛠️ Tech Stack & Tools
This project leverages modern web technologies to ensure speed, security, and scalability:
- **Languages:** PHP (Laravel 10), JavaScript (jQuery & Chart.js), HTML5, CSS3 (Bootstrap 4).
- **Backend:** Laravel Framework (MVC Architecture).
- **Frontend:** CoreUI Dashboard Template, Blade Templating Engine.
- **Database:** MySQL.
- **Tools:** Git/GitHub (Version Control), Composer (Dependency Manager), NPM (Asset Bundling), Docker.
> **Important Note:** This Project is ready for Production. Use code from the **main** branch for the most stable version.

# 🚀 Local Installation

Follow these steps to get the project running on your local machine:

- run `git clone https://github.com/hamna-28/joyland-pos.git`
- run `composer install` 
- run `npm install`
- run `npm run dev`
- copy `.env.example` to `.env`
- run `php artisan key:generate`
- Set up your database credentials in the `.env` file
- run `php artisan migrate --seed`
- run `php artisan storage:link`
- run `php artisan serve`
- Visit `http://127.0.0.1:8000` in your browser.

> **PDF Configuration:** This system uses Laravel Snappy for PDFs. If you are on Windows, ensure you have the `wkhtmltopdf` binary installed and configured as per the [Laravel Snappy Documentation](https://github.com/barryvdh/laravel-snappy).

# 🐳 Docker Installation

- run `docker build -t joyland-pos .` 
- run `docker compose up`
- Visit `http://127.0.0.1:8000`.

# 🔐 Admin Credentials
> **Email:** `super.admin@test.com`  
> **Password:** `12345678`

## ✨ Joyland POS Features

- **Advanced Dashboard**: Real-time analytics with Chart.js (Sales, Purchases, Cash Flow).
- **Products Management**: Category tracking and Barcode printing.
- **Project & Department Tracking**: Specialized modules for Joyland organizational structure.
- **Sales & Purchase Management**: Including full Return management.
- **Quotation System**: Create and send quotes via email.
- **Finance**: Expense management and multi-currency support.
- **Security**: Granular User Roles & Permissions management.
- **Reporting**: Detailed profit/loss and inventory reports.


# 📝 License
This project is licensed under the **[Creative Commons Attribution 4.0 (CC-BY-4.0)](https://creativecommons.org/licenses/by/4.0/)**.

---
**Developed by [Hamna Shahzad](https://github.com/hamna-28)**