<?php
session_start();
require 'config.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Проверка за логнат потребител
if (!isset($_SESSION['user'])) {
    header("Location: pages/login.php");
    exit;
}

$user_email = $_SESSION['user']['email'] ?? null;

// Взимане на данните от заявката
$panel_id = isset($_GET['panel_id']) ? intval($_GET['panel_id']) : 0;
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

// Взимане на информация за панела от базата
$stmt = $conn->prepare("SELECT * FROM panels WHERE id = ?");
$stmt->bind_param("i", $panel_id);
$stmt->execute();
$panel = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$panel) {
    echo "Invalid panel selected.";
    exit;
}

$mail = new PHPMailer(true);

try {
    // Настройки за SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'krisi.petroff@gmail.com';
    $mail->Password   = 'hjdm yqrf exbm ikay';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('office.sgs.connect@gmail.com', 'SGS Connect');

    // Изпращаме на клиента
    $mail->addAddress($user_email);

    // Изпращаме копие и на SGS Connect
    $mail->addAddress('office.sgs.connect@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Your Solar Panel Order from SGS Connect';

    // Общо съдържание на имейла
    $mailContent = "
        <h2>Order Confirmation</h2>
        <p>Thank you for your order! Here are your order details:</p>
        <ul>
            <li><strong>Panel:</strong> " . htmlspecialchars($panel['model_name']) . "</li>
            <li><strong>Manufacturer:</strong> " . htmlspecialchars($panel['manufacturer']) . "</li>
            <li><strong>Quantity:</strong> " . $quantity . "</li>
            <li><strong>Price per unit:</strong> €" . number_format($panel['price_eur'], 2) . "</li>
            <li><strong>Total:</strong> €" . number_format($panel['price_eur'] * $quantity, 2) . "</li>
        </ul>
        <p>We will contact you soon for further details.</p>
    ";

    // Добавяме и информация за SGS Connect кой е клиентът
    $mailContent .= "
        <hr>
        <p><strong>Customer email:</strong> $user_email</p>
    ";

    $mail->Body = $mailContent;

    $mail->send();
    echo "<script>alert('Your order has been sent to your email!'); window.location.href='pages/ecalculator.php';</script>";
} catch (Exception $e) {
    echo "<script>alert('Error sending email: {$mail->ErrorInfo}'); window.location.href='pages/ecalculator.php';</script>";
}
?>
