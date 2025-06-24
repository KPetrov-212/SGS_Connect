<?php
session_start();
require '../config.php';

// Ограничаваме достъпа само за админи
if (!isset($_SESSION['user']) || $_SESSION['user']['email'] != "office.sgs.connect@gmail.com") {
    header('Location: pages/login.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Вземаме и валидираме входа
    $model_name = trim($_POST['model_name']);
    $manufacturer = trim($_POST['manufacturer']);
    $power_output_w = intval($_POST['power_output_w']);
    $efficiency_percent = floatval($_POST['efficiency_percent']);
    $dimensions_mm = trim($_POST['dimensions_mm']);
    $weight_kg = floatval($_POST['weight_kg']);
    $panel_type = trim($_POST['panel_type']);
    $voltage_vmp = floatval($_POST['voltage_vmp']);
    $current_imp = floatval($_POST['current_imp']);
    $price_eur = floatval($_POST['price_eur']);
    $warranty_years = intval($_POST['warranty_years']);
    $image_url = trim($_POST['image_url']);

    // Проста валидация (може да се разшири)
    if ($model_name == '' || $manufacturer == '' || $power_output_w <= 0 || $price_eur <= 0) {
        $error = "Моля, попълнете всички задължителни полета правилно.";
    } else {
        // Добавяме в базата
        $stmt = $conn->prepare("INSERT INTO panels 
            (model_name, manufacturer, power_output_w, efficiency_percent, dimensions_mm, weight_kg, panel_type, voltage_vmp, current_imp, price_eur, warranty_years, image_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiddsdiddis", 
            $model_name, 
            $manufacturer, 
            $power_output_w, 
            $efficiency_percent, 
            $dimensions_mm, 
            $weight_kg, 
            $panel_type, 
            $voltage_vmp, 
            $current_imp, 
            $price_eur, 
            $warranty_years, 
            $image_url);

        if ($stmt->execute()) {
            header('Location: admin_panels.php');
            exit;
        } else {
            $error = "Грешка при запис в базата: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8" />
    <title>Add New Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h1>Добавяне на нов соларен панел</h1>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Model Name *</label>
            <input type="text" name="model_name" class="form-control" required value="<?= htmlspecialchars($_POST['model_name'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Manufacturer *</label>
            <input type="text" name="manufacturer" class="form-control" required value="<?= htmlspecialchars($_POST['manufacturer'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Power Output (W) *</label>
            <input type="number" name="power_output_w" class="form-control" required min="1" value="<?= htmlspecialchars($_POST['power_output_w'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Efficiency (%)</label>
            <input type="number" step="0.01" name="efficiency_percent" class="form-control" value="<?= htmlspecialchars($_POST['efficiency_percent'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Dimensions (mm)</label>
            <input type="text" name="dimensions_mm" class="form-control" value="<?= htmlspecialchars($_POST['dimensions_mm'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" step="0.01" name="weight_kg" class="form-control" value="<?= htmlspecialchars($_POST['weight_kg'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Panel Type</label>
            <input type="text" name="panel_type" class="form-control" value="<?= htmlspecialchars($_POST['panel_type'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Voltage (Vmp)</label>
            <input type="number" step="0.01" name="voltage_vmp" class="form-control" value="<?= htmlspecialchars($_POST['voltage_vmp'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Current (Imp)</label>
            <input type="number" step="0.01" name="current_imp" class="form-control" value="<?= htmlspecialchars($_POST['current_imp'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Price (€) *</label>
            <input type="number" step="0.01" name="price_eur" class="form-control" required min="0" value="<?= htmlspecialchars($_POST['price_eur'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Warranty (years)</label>
            <input type="number" name="warranty_years" class="form-control" value="<?= htmlspecialchars($_POST['warranty_years'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" name="image_url" class="form-control" value="<?= htmlspecialchars($_POST['image_url'] ?? '') ?>">
        </div>
        <button type="submit" class="btn btn-success">Добави панел</button>
        <a href="admin_panels.php" class="btn btn-secondary">Отказ</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
