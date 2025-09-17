<?php
require_once 'config/database.php';

// Handle search and filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter_gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$filter_course = isset($_GET['course']) ? $_GET['course'] : '';

// Build query
$sql = "SELECT * FROM students WHERE 1=1";
$params = array();
$types = "";

if (!empty($search)) {
    $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR course LIKE ?)";
    $search_param = "%$search%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= "ssss";
}

if (!empty($filter_gender)) {
    $sql .= " AND gender = ?";
    $params[] = $filter_gender;
    $types .= "s";
}

if (!empty($filter_course)) {
    $sql .= " AND course LIKE ?";
    $course_param = "%$filter_course%";
    $params[] = $course_param;
    $types .= "s";
}

$sql .= " ORDER BY registration_date DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Get unique courses for filter dropdown
$courses_sql = "SELECT DISTINCT course FROM students WHERE course IS NOT NULL AND course != '' ORDER BY course";
$courses_result = $conn->query($courses_sql);
$courses = array();
while ($row = $courses_result->fetch_assoc()) {
    $courses[] = $row['course'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students - School Registry</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Registered Students</h1>
            <a href="index.php" class="back-btn">← Back to Home</a>
        </header>

        <main>
            <!-- Search and Filter Section -->
            <div class="search-filter">
                <form method="GET" action="" class="filter-form">
                    <div class="filter-row">
                        <div class="filter-group">
                            <input type="text" name="search" placeholder="Search students..." value="<?php echo htmlspecialchars($search); ?>">
                        </div>
                        <div class="filter-group">
                            <select name="gender">
                                <option value="">All Genders</option>
                                <option value="Male" <?php echo $filter_gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo $filter_gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo $filter_gender == 'Other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <select name="course">
                                <option value="">All Courses</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo htmlspecialchars($course); ?>" <?php echo $filter_course == $course ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($course); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="filter-group">
                            <button type="submit" class="filter-btn">Filter</button>
                            <a href="view.php" class="clear-btn">Clear</a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Students Table -->
            <div class="table-container">
                <?php if ($result->num_rows > 0): ?>
                    <table class="students-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone'] ?? 'N/A'); ?></td>
                                    <td><?php echo $row['date_of_birth'] ? date('M d, Y', strtotime($row['date_of_birth'])) : 'N/A'; ?></td>
                                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($row['course'] ?? 'N/A'); ?></td>
                                    <td><?php echo date('M d, Y', strtotime($row['registration_date'])); ?></td>
                                    <td>
                                        <span class="status <?php echo strtolower($row['status']); ?>">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    
                    <div class="table-info">
                        <p>Total students found: <strong><?php echo $result->num_rows; ?></strong></p>
                    </div>
                <?php else: ?>
                    <div class="no-data">
                        <p>No students found matching your criteria.</p>
                        <a href="register.php" class="register-link">Register the first student</a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
