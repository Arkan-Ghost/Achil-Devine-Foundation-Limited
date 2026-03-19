<?php
// php/process_get_involved.php - Version redirection
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../get-involved.html?error=invalid');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$interestArea = trim($_POST['interest_area'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($interestArea)) {
    header('Location: ../get-involved.html?error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../get-involved.html?error=invalid_email');
    exit;
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $sql = "INSERT INTO get_involved (name, email, phone, interest_area, message) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $phone, $interestArea, $message);
    
    if ($stmt->execute()) {
        header('Location: ../get-involved.html?success=submitted');
        exit;
    } else {
        header('Location: ../get-involved.html?error=db_error');
        exit;
    }
    
} catch (Exception $e) {
    header('Location: ../get-involved.html?error=server_error');
    exit;
}
?>