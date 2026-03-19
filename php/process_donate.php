<?php
// php/process_donate.php - Version redirection
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../donate.html?error=invalid');
    exit;
}

$donorName = trim($_POST['donor_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$amount = floatval($_POST['amount'] ?? 0);
$donationType = trim($_POST['donation_type'] ?? 'one-time');
$paymentMethod = trim($_POST['payment_method'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($donorName) || empty($email) || $amount <= 0 || empty($paymentMethod)) {
    header('Location: ../donate.html?error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../donate.html?error=invalid_email');
    exit;
}

// Générer un ID de transaction unique
$transactionId = 'DON_' . strtoupper(uniqid());

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $sql = "INSERT INTO donations (donor_name, email, phone, amount, donation_type, payment_method, message, transaction_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdssss", $donorName, $email, $phone, $amount, $donationType, $paymentMethod, $message, $transactionId);
    
    if ($stmt->execute()) {
        header("Location: ../donate.html?success=submitted&transaction=$transactionId");
        exit;
    } else {
        header('Location: ../donate.html?error=db_error');
        exit;
    }
    
} catch (Exception $e) {
    header('Location: ../donate.html?error=server_error');
    exit;
}
?>