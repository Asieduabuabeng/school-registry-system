# School Registry System

A complete PHP web application for managing student registrations with MySQL database integration.

## Features

- **Homepage with Two Portals**: Register students and view registered students
- **Student Registration**: Complete form with validation and database storage
- **Student Viewing**: Display all registered students with search and filter capabilities
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Database Integration**: Full CRUD operations with MySQL

## Setup Instructions

### 1. XAMPP Setup

1. Install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Start Apache and MySQL services in XAMPP Control Panel

### 2. Database Setup

1. Open phpMyAdmin in your browser: `http://localhost/phpmyadmin`
2. Create a new database named `school_registry`
3. Import the SQL file or run the commands from `database/setup.sql`:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS school_registry;
USE school_registry;

-- Create students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    date_of_birth DATE,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    address TEXT,
    course VARCHAR(100),
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Active', 'Inactive') DEFAULT 'Active'
);
```

### 3. File Setup

1. Copy all project files to your XAMPP `htdocs` directory:
   - Windows: `C:\xampp\htdocs\school-registry\`
   - macOS: `/Applications/XAMPP/htdocs/school-registry/`
   - Linux: `/opt/lampp/htdocs/school-registry/`

2. Make sure your folder structure looks like this:
```
school-registry/
├── config/
│   └── database.php
├── css/
│   └── style.css
├── database/
│   └── setup.sql
├── index.php
├── register.php
├── view.php
└── README.md
```

### 4. Database Configuration

The database configuration is already set up for default XAMPP settings in `config/database.php`:

- **Host**: localhost
- **Username**: root
- **Password**: (empty)
- **Database**: school_registry

If you need to change these settings, edit the `config/database.php` file.

### 5. Access the Application

Open your web browser and navigate to:
- `http://localhost/school-registry/` (or your folder name)

## File Structure

- **index.php**: Homepage with two portals
- **register.php**: Student registration form with PHP processing
- **view.php**: Display registered students with search/filter functionality
- **config/database.php**: Database connection configuration
- **css/style.css**: All styling for the application
- **database/setup.sql**: Database schema and sample data

## Database Schema

The `students` table contains:
- `id`: Auto-incrementing primary key
- `first_name`: Student's first name (required)
- `last_name`: Student's last name (required)
- `email`: Unique email address (required)
- `phone`: Phone number (optional)
- `date_of_birth`: Date of birth (optional)
- `gender`: Gender selection (required)
- `address`: Home address (optional)
- `course`: Course of study (optional)
- `registration_date`: Automatic timestamp
- `status`: Active/Inactive status

## Features Detail

### Registration Portal
- Complete form validation
- Duplicate email detection
- Success/error messaging
- Form data persistence on errors
- Clean, responsive design

### View Portal
- Display all registered students
- Search functionality (name, email, course)
- Filter by gender and course
- Responsive table design
- Student count display

## Security Features

- SQL injection prevention using prepared statements
- XSS protection with htmlspecialchars()
- Form validation and sanitization
- Proper error handling

## Browser Compatibility

- Chrome (recommended)
- Firefox
- Safari
- Edge
- Mobile browsers

## Troubleshooting

1. **Database Connection Error**: 
   - Ensure MySQL is running in XAMPP
   - Check database credentials in `config/database.php`

2. **Page Not Found**: 
   - Ensure Apache is running in XAMPP
   - Check file paths and folder structure

3. **CSS Not Loading**: 
   - Verify the `css/style.css` file exists
   - Check file permissions

## Assignment Requirements Met

✅ Database that interacts with forms  
✅ Homepage with two portals  
✅ Portal 1: Register (form submission)  
✅ Portal 2: View (display data)  
✅ Server-side PHP language  
✅ Information flow from registration to viewing  
✅ MySQL database integration via XAMPP  

## Support

If you encounter any issues, check:
1. XAMPP services are running
2. Database exists and is properly configured
3. File permissions are correct
4. Browser console for any JavaScript errors
