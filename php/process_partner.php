<?php
// php/process_partner.php - Version redirection
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../partner.html?error=invalid');
    exit;
}

$organization = trim($_POST['organization'] ?? '');
$contactPerson = trim($_POST['contact_person'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$website = trim($_POST['website'] ?? '');
$orgType = trim($_POST['organization_type'] ?? '');
$partnershipType = trim($_POST['partnership_type'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($organization) || empty($contactPerson) || empty($email) || empty($partnershipType)) {
    header('Location: ../partner.html?error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../partner.html?error=invalid_email');
    exit;
}

if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) {
    header('Location: ../partner.html?error=invalid_website');
    exit;
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    $sql = "INSERT INTO partners (organization_name, contact_person, email, phone, website, organization_type, partnership_type, message) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $organization, $contactPerson, $email, $phone, $website, $orgType, $partnershipType, $message);
    
    if ($stmt->execute()) {
        header('Location: ../partner.html?success=submitted');
        exit;
    } else {
        header('Location: ../partner.html?error=db_error');
        exit;
    }
    
} catch (Exception $e) {
    header('Location: ../partner.html?error=server_error');
    exit;
}
?>