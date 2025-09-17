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

-- Insert sample data (optional)
INSERT INTO students (first_name, last_name, email, phone, date_of_birth, gender, address, course) VALUES
('John', 'Doe', 'john.doe@example.com', '123-456-7890', '2000-05-15', 'Male', '123 Main St, City', 'Computer Science'),
('Jane', 'Smith', 'jane.smith@example.com', '098-765-4321', '1999-08-22', 'Female', '456 Oak Ave, Town', 'Mathematics'),
('Mike', 'Johnson', 'mike.johnson@example.com', '555-123-4567', '2001-03-10', 'Male', '789 Pine Rd, Village', 'Physics');
