<?php
session_start();
require '../config.php';

if (!isset($_SESSION['user'])   || ( isset($_SESSION['user']) && $_SESSION['user']['email'] != "office.sgs.connect@gmail.com" )         ) {
    header('Location: pages/login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM panels WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: admin_panels.php');
exit;
