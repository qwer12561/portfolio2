<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer Autoloader
require __DIR__ . '/vendor/autoload.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = nl2br(htmlspecialchars($_POST["message"]));

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // Your Gmail
        $mail->Username = 'kerttenebromendina@gmail.com';

        // Your Google App Password (NOT your normal Gmail password)
        $mail->Password = 'iroq alwh oavi zsix';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender & Recipient
        $mail->setFrom($email, $name); // Sender from form
        $mail->addAddress('kerttenebromendina@gmail.com'); // Your receiving email

        // Email Format
        $mail->isHTML(true);
        $mail->Subject = "New Message From Portfolio Website";
        $mail->Body = "
            <h2>New Message Received</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();

        // Redirect to thankyou.html
        header("Location: thankyou.html");
        exit;

    } catch (Exception $e) {
        // Redirect to error page
        header("Location: error.html");
        exit;
    }
}
?>
