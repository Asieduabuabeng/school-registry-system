<?php
require_once 'config/database.php';

$message = '';
$messageType = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    $course = trim($_POST['course']);
    
    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($gender)) {
        $message = 'Please fill in all required fields.';
        $messageType = 'error';
    } 
    // Validate date of birth if provided
    else if (!empty($date_of_birth)) {
        $birth_date = new DateTime($date_of_birth);
        $today = new DateTime();
        $min_date = new DateTime('1950-01-01');
        
        if ($birth_date > $today) {
            $message = 'Date of birth cannot be in the future.';
            $messageType = 'error';
        } else if ($birth_date < $min_date) {
            $message = 'Please enter a valid date of birth (1950 or later).';
            $messageType = 'error';
        }
    }
    
    if (empty($message)) {
        // Check if email already exists
        $check_email = "SELECT id FROM students WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $message = 'Email already exists. Please use a different email address.';
            $messageType = 'error';
        } else {
            // Insert new student
            $sql = "INSERT INTO students (first_name, last_name, email, phone, date_of_birth, gender, address, course) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $date_of_birth, $gender, $address, $course);
            
            if ($stmt->execute()) {
                $message = 'Student registered successfully!';
                $messageType = 'success';
                // Clear form data
                $_POST = array();
            } else {
                $message = 'Error: ' . $stmt->error;
                $messageType = 'error';
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student - School Registry</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Student Registration</h1>
            <a href="index.php" class="back-btn">← Back to Home</a>
        </header>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <main>
            <form method="POST" action="" class="registration-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" 
                               min="1950-01-01" 
                               max="<?php echo date('Y-m-d'); ?>" 
                               value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Gender *</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                            <option value="Other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" id="course" name="course" value="<?php echo isset($_POST['course']) ? htmlspecialchars($_POST['course']) : ''; ?>" placeholder="e.g., Computer Science">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" rows="3"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-btn">Register Student</button>
                    <button type="reset" class="reset-btn">Clear Form</button>
                </div>
            </form>
        </main>
    </div>
    
    <script>
    // Set a default max date for date of birth (today's date)
    document.addEventListener('DOMContentLoaded', function() {
        const dobInput = document.getElementById('date_of_birth');
        const today = new Date().toISOString().split('T')[0];
        dobInput.setAttribute('max', today);
        
        // Add some helpful validation
        dobInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            const minDate = new Date('1950-01-01');
            
            if (selectedDate > today) {
                alert('Date of birth cannot be in the future.');
                this.value = '';
            } else if (selectedDate < minDate) {
                alert('Please enter a valid date of birth (1950 or later).');
                this.value = '';
            }
        });
    });
    </script>
</body>
</html>
