<?php
// process_newsletter.php - Version simplifiée
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.html?error=invalid');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if (empty($name) || empty($email)) {
    header('Location: ../index.html?error=missing_fields');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../index.html?error=invalid_email');
    exit;
}

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    
    // Vérifier si l'email existe déjà
    $checkSql = "SELECT id FROM newsletter_subscribers WHERE email = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows > 0) {
        header('Location: ../index.html?error=already_subscribed');
        exit;
    }
    
    $sql = "INSERT INTO newsletter_subscribers (name, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);
    
    if ($stmt->execute()) {
        // Redirection vers index.html avec message de succès
        header('Location: ../index.html?success=subscribed');
        exit;
    } else {
        header('Location: ../index.html?error=db_error');
        exit;
    }
    
} catch (Exception $e) {
    header('Location: ../index.html?error=server_error');
    exit;
}
?>