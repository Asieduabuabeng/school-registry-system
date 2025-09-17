# School Registry System

A complete PHP web application for managing student registrations with MySQL database integration.

## 🚀 Complete Setup Guide for VS Code + MAMP

This guide will walk you through setting up the entire School Registry system from scratch using VS Code and MAMP.

## Features

- **Homepage with Two Portals**: Register students and view registered students
- **Student Registration**: Complete form with validation and database storage
- **Student Viewing**: Display all registered students with search and filter capabilities
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Database Integration**: Full CRUD operations with MySQL

## 📋 What You Need (Don't Worry - It's Easy!)

**Before you start, you just need:**
- Any computer (Mac, Windows, or Linux)
- Internet connection to download software
- About 30-45 minutes of your time

**No programming experience needed!** This guide will walk you through everything step by step, like following a recipe.

## 🆘 What If Something Goes Wrong?

**Don't worry!** If anything doesn't work:
1. **Read the error message carefully** - it usually tells you what's wrong
2. **Check the troubleshooting section** at the bottom of this guide
3. **Use the test page** - go to `http://localhost:8888/test-connection.php` to see what's not working
4. **Start over** - sometimes it's easier to restart MAMP and try again

**Remember:** Every programmer faces problems - it's normal! The key is to read error messages and try the suggested solutions.

## 🛠️ Step-by-Step Setup Instructions

### Step 1: Download and Install Required Software

#### 1.1 Install VS Code (This is like Microsoft Word, but for code)
**What it is:** A text editor that makes code look pretty and organized
1. Go to [https://code.visualstudio.com/](https://code.visualstudio.com/)
2. Click the big blue "Download" button
3. Once downloaded, double-click the file and follow the installation steps (just click "Next" and "Install")
4. After installation, you'll see a VS Code icon - click it to open

#### 1.2 Install MAMP (This creates a mini web server on your computer)
**What it is:** Software that lets your computer act like a web server (like having your own mini internet)
1. Go to [https://www.mamp.info/en/downloads/](https://www.mamp.info/en/downloads/)
2. Click "Download MAMP" (choose the FREE version, not MAMP PRO)
3. Once downloaded, double-click and follow installation steps
4. **Don't worry about the technical stuff** - just install it normally
5. After installation, you'll see a MAMP icon

### Step 2: Download the Project Files

#### 2.1 Download from GitHub
1. Go to this repository on GitHub
2. Click the green "Code" button
3. Select "Download ZIP"
4. Extract the ZIP file to your desired location
5. Rename the folder to `school-registry` (remove any version numbers)

#### 2.2 Open Project in VS Code
1. Open VS Code
2. Go to File → Open Folder
3. Select the `school-registry` folder you just extracted
4. Your project structure should look like this:
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

### Step 3: Configure MAMP

#### 3.1 Start MAMP
1. Open MAMP application
2. Click "Start Servers" (this starts both Apache and MySQL)
3. Wait for both servers to show green status
4. Note the ports (usually Apache: 8888, MySQL: 8889)

#### 3.2 Set Document Root (Important!)
1. In MAMP, click "Preferences"
2. Go to "Web Server" tab
3. Click "Select" next to "Document Root"
4. Navigate to and select your `school-registry` folder
5. Click "OK" to save

### Step 4: Database Setup

#### 4.1 Access phpMyAdmin
1. With MAMP running, open your web browser
2. Go to: `http://localhost:8888/phpMyAdmin/` (or click "Open WebStart page" in MAMP, then phpMyAdmin)
3. You should see the phpMyAdmin interface

#### 4.2 Create Database
1. In phpMyAdmin, click "Databases" tab
2. In "Create database" field, type: `school_registry`
3. Click "Create"

#### 4.3 Import Database Structure
1. Click on the `school_registry` database you just created
2. Click "Import" tab
3. Click "Choose File"
4. Navigate to your project folder → `database` → `setup.sql`
5. Select the file and click "Go"
6. You should see a success message

### Step 5: Configure Database Connection

#### 5.1 Update Database Configuration for MAMP
1. In VS Code, open `config/database.php`
2. Replace the entire content with this MAMP-compatible version:

```php
<?php
// Database configuration for MAMP
$servername = "localhost";
$username = "root";        // Default MAMP MySQL username
$password = "root";        // Default MAMP MySQL password
$dbname = "school_registry";
$port = 8889;             // Default MAMP MySQL port

// Create connection with port
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>
```

**Important Notes:**
- MAMP uses port 8889 for MySQL (different from XAMPP)
- Default MAMP MySQL password is "root" (not empty like XAMPP)
- If your MAMP uses different ports, check MAMP preferences

### Step 6: Test Everything Works! 🎉

#### 6.1 First, Let's Test the Setup
1. Make sure MAMP servers are running (you should see green lights)
2. Open your web browser (Chrome, Safari, Firefox, etc.)
3. Type this in the address bar: `http://localhost:8888/test-connection.php`
4. Press Enter

**What you should see:**
- A page that says "All Tests Passed!" with green checkmarks
- If you see any red error messages, don't panic! The page will tell you exactly what to fix

#### 6.2 Access the Main Application
1. If the test page showed all green checkmarks, you're ready!
2. In your browser, go to: `http://localhost:8888/` 
3. You should see a beautiful homepage with two blue boxes:
   - "Register Student" (to add new students)
   - "View Students" (to see all registered students)

#### 6.3 Test Adding a Student
1. Click the blue "Register Student" button
2. Fill out the form with some test information:
   - First Name: John
   - Last Name: Doe  
   - Email: john.doe@test.com
   - Gender: Select "Male"
   - Course: Computer Science
   - (You can fill in other fields or leave them empty)
3. Click the green "Register Student" button at the bottom
4. **Success!** You should see a green message saying the student was registered

#### 6.4 Test Viewing Students
1. Click the "← Back to Home" link at the top
2. Click the blue "View Students" button
3. **Amazing!** You should see John Doe in a table
4. Try typing "John" in the search box to see the search feature work

### Step 7: Verify Database

#### 7.1 Check Database in phpMyAdmin
1. Go to `http://localhost:8888/phpMyAdmin/`
2. Click on `school_registry` database
3. Click on `students` table
4. Click "Browse" tab
5. You should see the student record you created

## 🎯 Application Features

### Homepage (index.php)
- Clean interface with two main portals
- Professional design with hover effects
- Responsive layout for all devices

### Registration Portal (register.php)
- Complete student registration form
- Real-time form validation
- Duplicate email detection
- Date of birth validation (1950-current year)
- Success/error messaging
- Form data persistence on errors

### View Portal (view.php)
- Display all registered students in a table
- Search functionality (name, email, course)
- Filter by gender and course
- Responsive table design
- Student count display
- Professional styling

## 🗂️ Database Schema

The `students` table structure:

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

## 🚨 Troubleshooting

### Common Issues and Solutions

#### 1. **"Connection failed" Error**
**Problem:** Database connection fails
**Solutions:**
- Ensure MAMP servers are running (green status)
- Check if MySQL port is 8889 (default MAMP port)
- Verify database credentials in `config/database.php`:
  - Username: `root`
  - Password: `root` (not empty)
  - Port: `8889`
- Try restarting MAMP servers

#### 2. **"Page Not Found" or "This site can't be reached"**
**Problem:** Can't access the application
**Solutions:**
- Ensure Apache server is running in MAMP
- Check the correct URL: `http://localhost:8888/`
- Verify MAMP document root points to your project folder
- Try `http://localhost:8888/index.php` directly

#### 3. **CSS Not Loading (Plain HTML Page)**
**Problem:** Page loads but without styling
**Solutions:**
- Check if `css/style.css` file exists in your project
- Verify file permissions (should be readable)
- Clear browser cache (Ctrl+F5 or Cmd+Shift+R)
- Check browser developer tools for CSS loading errors

#### 4. **Database Table Not Found**
**Problem:** Error about `students` table not existing
**Solutions:**
- Go to phpMyAdmin: `http://localhost:8888/phpMyAdmin/`
- Check if `school_registry` database exists
- Check if `students` table exists in the database
- Re-import `database/setup.sql` if needed

#### 5. **Form Submission Not Working**
**Problem:** Registration form doesn't save data
**Solutions:**
- Check database connection first
- Verify all required form fields are filled
- Check browser developer tools for JavaScript errors
- Ensure email address is unique (no duplicates)

#### 6. **MAMP Ports Different Than Expected**
**Problem:** Default ports don't work
**Solutions:**
- Open MAMP Preferences → Ports
- Note the actual Apache and MySQL ports
- Update URLs accordingly (e.g., `http://localhost:8080/` if Apache port is 8080)
- Update database port in `config/database.php`

### 🔧 How to Check MAMP Status

1. **Server Status:**
   - Open MAMP application
   - Look for green lights next to Apache and MySQL
   - If red, click "Start Servers"

2. **Port Configuration:**
   - MAMP → Preferences → Ports
   - Note Apache port (usually 8888)
   - Note MySQL port (usually 8889)

3. **Document Root:**
   - MAMP → Preferences → Web Server
   - Ensure it points to your project folder

### 📞 Getting Help

If you're still having issues:

1. **Check Error Messages:**
   - Look at the exact error message
   - Check browser developer tools (F12)
   - Check MAMP logs

2. **Verify File Structure:**
   ```
   school-registry/
   ├── config/database.php ✓
   ├── css/style.css ✓
   ├── database/setup.sql ✓
   ├── index.php ✓
   ├── register.php ✓
   └── view.php ✓
   ```

3. **Test Step by Step:**
   - First: Can you access `http://localhost:8888/`?
   - Second: Can you access phpMyAdmin?
   - Third: Does the database exist?
   - Fourth: Can you see the homepage?

## 🎓 Learning Outcomes

By completing this setup, you will have learned:

- ✅ Local web server setup with MAMP
- ✅ PHP development environment configuration  
- ✅ MySQL database management
- ✅ PHP-MySQL integration
- ✅ Web application deployment
- ✅ Debugging web applications
- ✅ Version control with Git/GitHub

## 📚 Additional Resources

### Documentation
- [MAMP Documentation](https://documentation.mamp.info/)
- [PHP Official Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [VS Code PHP Extensions](https://marketplace.visualstudio.com/search?term=php&target=VSCode)

### Recommended VS Code Extensions
1. **PHP Intelephense** - PHP language support
2. **MySQL** - Database management
3. **Live Server** - Alternative local server
4. **Prettier** - Code formatting

### Next Steps
- Learn more PHP frameworks (Laravel, Symfony)
- Explore advanced database concepts
- Add user authentication
- Implement file upload functionality
- Deploy to production hosting

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
