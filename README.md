# 🗓️ Laravel Booking Management System

A simple yet powerful Laravel-based booking management system with user authentication, role-based access, real-time notifications, and a clean dashboard UI. Deployed via [Railway](https://railway.app).

## 🚀 Live Preview

🔗 [Live Site](https://laravelfinal-production.up.railway.app)  
👤 Test User (Non-admin): `user@example.com` / `password`  
🛠️ Admin Setup Instructions below ↓

---

## 📸 Screenshots

### Login / Register
![Login](public/screenshots/login.png)
![Register](public/screenshots/reg.png)
### Dashboard
![Dashboard](public/screenshots/dashboard.png)

### Bookings Overview
![Bookings](public/screenshots/bookings.png)

---

## 🔧 Features

- ✅ User registration and login
- ✅ Role-based access (Admin / User)
- ✅ Admin Panel: Manage users and bookings
- ✅ Manual and calendar-based booking
- ✅ Email notifications (local or production)
- ✅ Booking dashboard with stats
- ✅ Responsive, modern UI
- ✅ Live deployment with Railway

---

## 🛠 Tech Stack

| Layer        | Tech                         |
|--------------|------------------------------|
| Backend      | Laravel 12 (PHP 8.2)         |
| Frontend     | Blade, TailwindCSS, AlpineJS |
| Authentication | Laravel Breeze             |
| Database     | MySQL (via Railway plugin)   |
| Notifications| Laravel Notification System  |
| Hosting      | Railway                      |
| Version Control | Git + GitHub              |

---

## ⚙️ Setup Instructions (Local)

1. Clone the repo  
   ```bash
   git clone https://github.com/YOUR_USERNAME/laravelfinal.git
   cd laravelfinal

2. Install dependencies

bash
composer install
npm install && npm run build

3. Configure environment

bash
cp .env.example .env
php artisan key:generate

3. Run migrations

bash
php artisan migrate

5. Start the server
bash
Copy
Edit
php artisan serve

🧪 Admin Setup
1. Register a user through the app.
2. Make the user admin using Tinker:

bash
php artisan tinker
Then run:
php
Copy
Edit
$user = App\Models\User::where('email', 'youremail@example.com')->first();
$user->role = 'admin';
$user->save();

Refresh and enjoy the admin dashboard.

🛰️ Railway Deployment
This project is deploy-ready for Railway.

Post-deploy command:
bash
cp .env.example .env && composer install --no-dev --optimize-autoloader && php artisan key:generate && php artisan migrate --force
Make sure to:

Add the correct database environment variables from the MySQL plugin

Set APP_ENV=production and APP_DEBUG=false

📫 Email Setup (Optional)
To test notifications: putingbuhok1

Local: Set MAIL_MAILER=log in .env

Production: Use Mailtrap, SMTP, or Gmail configuration

🤝 Author
Developed by Jansen Ofiaza
📧 jansenofiaza12@gmail.com
📚 ITP17 - Advanced Programming
🏫 Universidad de Dagupan
