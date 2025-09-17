<?php
// Simple test file to check if MAMP and database are working
// This file helps non-programmers verify their setup

echo "<!DOCTYPE html>
<html>
<head>
    <title>School Registry - Connection Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: 0 auto; }
        .success { color: #27ae60; background: #d4edda; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { color: #e74c3c; background: #f8d7da; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { color: #3498db; background: #d1ecf1; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .step { background: #f8f9fa; padding: 15px; margin: 15px 0; border-left: 4px solid #3498db; }
        h1 { color: #2c3e50; text-align: center; }
        h2 { color: #34495e; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px; }
        .btn { display: inline-block; background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 10px 5px; }
        .btn:hover { background: #2980b9; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🏥 School Registry System - Setup Test</h1>
        <p><strong>This page will help you verify that everything is working correctly.</strong></p>";

$allGood = true;

// Test 1: PHP is working
echo "<div class='step'>
        <h2>✅ Step 1: PHP Test</h2>
        <div class='success'>✅ PHP is working! (You can see this page)</div>
        <div class='info'>📍 PHP Version: " . phpversion() . "</div>
      </div>";

// Test 2: Database connection file exists
if (file_exists('config/database.php')) {
    echo "<div class='step'>
            <h2>✅ Step 2: Configuration File</h2>
            <div class='success'>✅ Database configuration file found</div>
          </div>";
} else {
    echo "<div class='step'>
            <h2>❌ Step 2: Configuration File</h2>
            <div class='error'>❌ config/database.php file not found!</div>
            <div class='info'>📍 Make sure you uploaded all files correctly</div>
          </div>";
    $allGood = false;
}

// Test 3: Database connection
echo "<div class='step'>
        <h2>🔌 Step 3: Database Connection Test</h2>";

try {
    require_once 'config/database.php';
    echo "<div class='success'>✅ Connected to MySQL successfully!</div>";
    
    // Test 4: Database exists
    $db_check = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'school_registry'");
    if ($db_check && $db_check->num_rows > 0) {
        echo "<div class='success'>✅ Database 'school_registry' found!</div>";
        
        // Test 5: Table exists
        $table_check = $conn->query("SHOW TABLES LIKE 'students'");
        if ($table_check && $table_check->num_rows > 0) {
            echo "<div class='success'>✅ Students table found!</div>";
            
            // Count students
            $count_result = $conn->query("SELECT COUNT(*) as total FROM students");
            if ($count_result) {
                $count = $count_result->fetch_assoc()['total'];
                echo "<div class='info'>📊 Current students in database: <strong>$count</strong></div>";
            }
        } else {
            echo "<div class='error'>❌ Students table not found!</div>";
            echo "<div class='info'>📍 You need to import the database/setup.sql file in phpMyAdmin</div>";
            $allGood = false;
        }
    } else {
        echo "<div class='error'>❌ Database 'school_registry' not found!</div>";
        echo "<div class='info'>📍 You need to create the database in phpMyAdmin first</div>";
        $allGood = false;
    }
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Database connection failed: " . $e->getMessage() . "</div>";
    echo "<div class='info'>📍 Common solutions:
            <br>• Make sure MAMP servers are running (green lights)
            <br>• Check if MySQL port is 8889 in MAMP preferences
            <br>• Verify username is 'root' and password is 'root'</div>";
    $allGood = false;
}

echo "</div>";

// Final status
if ($allGood) {
    echo "<div class='step'>
            <h2>🎉 All Tests Passed!</h2>
            <div class='success'>
                <strong>Congratulations! Your School Registry system is ready to use.</strong>
                <br><br>
                ✅ MAMP is working<br>
                ✅ PHP is working<br>
                ✅ Database connection is working<br>
                ✅ Database and table exist<br>
            </div>
            <p><strong>Next steps:</strong></p>
            <a href='index.php' class='btn'>🏠 Go to Homepage</a>
            <a href='register.php' class='btn'>📝 Test Registration</a>
            <a href='view.php' class='btn'>👥 View Students</a>
          </div>";
} else {
    echo "<div class='step'>
            <h2>⚠️ Setup Issues Found</h2>
            <div class='error'>
                <strong>Some issues need to be fixed before the system will work properly.</strong>
                <br><br>
                Please review the error messages above and follow the suggested solutions.
            </div>
            <p><strong>Common fixes:</strong></p>
            <div class='info'>
                1. Make sure MAMP servers are running (both Apache and MySQL should show green)<br>
                2. Check MAMP preferences for correct ports (Apache: 8888, MySQL: 8889)<br>
                3. Create 'school_registry' database in phpMyAdmin<br>
                4. Import database/setup.sql file in phpMyAdmin<br>
                5. Verify all project files are in the correct folder
            </div>
          </div>";
}

echo "<div class='step'>
        <h2>🔧 Useful Links</h2>
        <a href='http://localhost:8888/phpMyAdmin/' class='btn' target='_blank'>🗄️ phpMyAdmin</a>
        <a href='http://localhost:8888/' class='btn' target='_blank'>🌐 MAMP Start Page</a>
      </div>";

echo "</div></body></html>";
?>
