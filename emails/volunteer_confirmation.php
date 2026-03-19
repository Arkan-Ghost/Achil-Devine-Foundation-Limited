<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Volunteering</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0a2f44; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
        .button { 
            display: inline-block; 
            padding: 10px 20px; 
            background: #f39237; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Achil Devine Foundation</h1>
        </div>
        <div class="content">
            <h2>Thank You for Your Interest in Volunteering!</h2>
            <p>Dear <?php echo htmlspecialchars($data['name']); ?>,</p>
            <p>Thank you for your willingness to volunteer with Achil Devine Foundation. We truly appreciate your interest in supporting our mission to empower refugees and vulnerable communities.</p>
            <p>We have received your volunteer application and our team will review it shortly. Someone from our volunteer coordination team will contact you within the next 3-5 business days to discuss next steps and how you can get involved.</p>
            <p>In the meantime, here's what you can do:</p>
            <ul>
                <li>Follow us on social media to stay updated on our work</li>
                <li>Share our mission with your network</li>
                <li>Explore our website to learn more about our programs</li>
            </ul>
            <p>If you have any questions, please don't hesitate to contact us at <a href="mailto:volunteer@achiledevinefoundation.org">volunteer@achiledevinefoundation.org</a>.</p>
            <p>Thank you again for your support!</p>
            <p>Best regards,<br>The Achil Devine Foundation Team</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Achil Devine Foundation. All rights reserved.</p>
            <p>Plot 123, NGO Street, Kampala, Uganda</p>
        </div>
    </div>
</body>
</html>