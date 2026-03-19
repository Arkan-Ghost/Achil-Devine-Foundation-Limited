<?php
// php/process_volunteer.php - Version redirection
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../volunteer.html?error=invalid');
    exit;
}

$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$country = trim($_POST['country'] ?? '');
$skills = trim($_POST['skills'] ?? '');
$availability = trim($_POST['availability'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($fullName) || empty($email) || empty($phone)) {
    header('Location: ../volunteer.html?error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../volunteer.html?error=invalid_email');
    exit;
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $sql = "INSERT INTO volunteers (full_name, email, phone, country, skills, availability, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $fullName, $email, $phone, $country, $skills, $availability, $message);
    
    if ($stmt->execute()) {
        header('Location: ../volunteer.html?success=submitted');
        exit;
    } else {
        header('Location: ../volunteer.html?error=db_error');
        exit;
    }
    
} catch (Exception $e) {
    header('Location: ../volunteer.html?error=server_error');
    exit;
}
?>