<?php
require_once __DIR__ . '/../php/config.php';

function sendEmail($to, $subject, $message, $from = null, $fromName = null) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    $from = $from ?? SMTP_FROM;
    $fromName = $fromName ?? SMTP_FROM_NAME;
    
    $headers .= "From: " . $fromName . " <" . $from . ">" . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    return mail($to, $subject, $message, $headers);
}

function sendEmailTemplate($to, $subject, $templateName, $data) {
    ob_start();
    include __DIR__ . '/../emails/' . $templateName . '.php';
    $message = ob_get_clean();
    
    return sendEmail($to, $subject, $message);
}

function sendVolunteerConfirmation($email, $name) {
    $subject = "Thank You for Volunteering - Achil Devine Foundation";
    $data = ['name' => $name];
    return sendEmailTemplate($email, $subject, 'volunteer_confirmation', $data);
}

function sendPartnerConfirmation($email, $organization) {
    $subject = "Partnership Request Received - Achil Devine Foundation";
    $data = ['organization' => $organization];
    return sendEmailTemplate($email, $subject, 'partner_confirmation', $data);
}

function sendDonationConfirmation($email, $name, $amount) {
    $subject = "Thank You for Your Donation - Achil Devine Foundation";
    $data = ['name' => $name, 'amount' => $amount];
    return sendEmailTemplate($email, $subject, 'donation_confirmation', $data);
}

function sendNewsletterConfirmation($email, $name) {
    $subject = "Welcome to Our Newsletter - Achil Devine Foundation";
    $data = ['name' => $name];
    return sendEmailTemplate($email, $subject, 'newsletter_confirmation', $data);
}

function sendAdminNotification($type, $data) {
    $adminEmail = ADMIN_EMAIL;
    $subject = "New " . ucfirst($type) . " Submission - Achil Devine Foundation";
    
    ob_start();
    include __DIR__ . '/../emails/admin_notification.php';
    $message = ob_get_clean();
    
    return sendEmail($adminEmail, $subject, $message);
}
?>