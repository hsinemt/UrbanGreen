# UrbanGreen

A web application that encourages the greening of urban environments to improve quality of life in cities. UrbanGreen emphasizes the importance of nature in public spaces and promotes cooperation between citizens and associations to make cities greener and more sustainable.

## 📋 Table of Contents

- [About](#about)
- [Features](#features)
- [Technologies](#technologies)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)

## 🌱 About

UrbanGreen is a platform designed to:
- Connect citizens, associations, and organizations working on urban greening projects
- Manage green spaces and their maintenance
- Organize events related to environmental sustainability
- Track resources and donations
- Facilitate volunteer participation in green initiatives
- Enable partnerships between different stakeholders

## ✨ Features

### Current Features
- **User Management**: Authentication and role-based access control
- **Resource Management**: Full CRUD operations with modal-based interface
    - Create, view, edit, and delete resources
    - Track resource types and quantities
    - Real-time updates without page reload
- **Responsive Dashboard**: Modern admin interface with sidebar navigation
- **Data Validation**: Server-side validation for all forms
- **Notifications**: Success and error message alerts

### Planned Features
- Association management and profiles
- Green space tracking and monitoring
- Project creation and management
- Event organization and calendar
- Volunteer registration and management
- Partner and supplier coordination
- Feedback system
- Donation management


## 🛠️ Technologies

### Backend
- **Laravel 12.x** - PHP Framework
- **PHP 8.2** - Programming Language
- **MySQL 5.7+** - Database

### Frontend
- **Blade Templates** - Laravel's Templating Engine
- **Bootstrap 5** - CSS Framework
- **JavaScript (Vanilla)** - For interactive modals
- **Iconify Icons** - Icon library

### Development Tools
- **Composer** - PHP Dependency Manager
- **WAMP/XAMPP** - Local Development Server
- **Git** - Version Control

## 📦 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- WAMP/XAMPP or similar local server

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/hsinemt/UrbanGreen.git
cd urbangreen
```

2. **Install dependencies**
```bash
composer install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**

Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=urbangreen_db
DB_USERNAME=root
DB_PASSWORD=
```

5. **Create database**

Create a database named `urbangreen_db` in phpMyAdmin or MySQL:
```sql
CREATE DATABASE urbangreen_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Fix default string length** (if needed)

Add to `app/Providers/AppServiceProvider.php`:
```php
use Illuminate\Support\Facades\Schema;

public function boot(): void
{
    Schema::defaultStringLength(191);
}
```

8. **Start the development server**
```bash
php artisan serve
```

## 🚀 Usage

### Access the Application
- Navigate to `http://localhost:8000`, '`http://localhost:8000/admin`'
- Login with your credentials
- Access Resources from the sidebar menu

### Resource Management
1. **Create Resource**
    - Click "Add New Resource" button
    - Fill in the modal form (Name, Type, Quantity)
    - Submit to create

2. **View Resource**
    - Click the eye icon on any resource
    - View details in modal popup

3. **Edit Resource**
    - Click the edit icon on any resource
    - Update information in modal
    - Submit to save changes

4. **Delete Resource**
    - Click the delete icon
    - Confirm deletion




## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request


## 👥 Team

Made by **Hunters Team**

## 📞 Contact

For questions or support, please open an issue on GitHub.

---

**UrbanGreen** - Making cities greener, one project at a time 🌳
