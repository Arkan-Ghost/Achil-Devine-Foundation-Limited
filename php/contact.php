<?php
// php/contact.php - Version redirection
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../contact.html?error=invalid');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    header('Location: ../contact.html?error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../contact.html?error=invalid_email');
    exit;
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    
    if ($stmt->execute()) {
        header('Location: ../contact.html?success=submitted');
        exit;
    } else {
        header('Location: ../contact.html?error=db_error');
        exit;
    }
    
} catch (Exception $e) {
    header('Location: ../contact.html?error=server_error');
    exit;
}
?>