<?php
session_start();
require '../config.php';

// Ограничаваме достъпа само за админи
if (!isset($_SESSION['user'])   || ( isset($_SESSION['user']) && $_SESSION['user']['email'] != "office.sgs.connect@gmail.com" )         ) {
    header('Location: pages/login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: admin_panel.php');
    exit;
}

$id = intval($_GET['id']);

// Ако формата е изпратена — обновяваме
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model_name = $_POST['model_name'];
    $manufacturer = $_POST['manufacturer'];
    $power_output_w = intval($_POST['power_output_w']);
    $efficiency_percent = floatval($_POST['efficiency_percent']);
    $dimensions_mm = $_POST['dimensions_mm'];
    $weight_kg = floatval($_POST['weight_kg']);
    $panel_type = $_POST['panel_type'];
    $voltage_vmp = floatval($_POST['voltage_vmp']);
    $current_imp = floatval($_POST['current_imp']);
    $price_eur = floatval($_POST['price_eur']);
    $warranty_years = intval($_POST['warranty_years']);
    $image_url = $_POST['image_url'];

    $stmt = $conn->prepare("UPDATE panels SET 
        model_name = ?, 
        manufacturer = ?, 
        power_output_w = ?, 
        efficiency_percent = ?, 
        dimensions_mm = ?, 
        weight_kg = ?, 
        panel_type = ?, 
        voltage_vmp = ?, 
        current_imp = ?, 
        price_eur = ?, 
        warranty_years = ?, 
        image_url = ? 
        WHERE id = ?");
    $stmt->bind_param("ssiddsdiddisi", 
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
        $image_url,
        $id);

    if ($stmt->execute()) {
        echo "<script>alert('Panel updated successfully!'); window.location.href='admin_panels.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Взимаме данните на панела за формата
$stmt = $conn->prepare("SELECT * FROM panels WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$panel = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$panel) {
    echo "Panel not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Panel #<?= htmlspecialchars($id) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h1>Edit Panel #<?= htmlspecialchars($id) ?></h1>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Model Name</label>
            <input type="text" name="model_name" class="form-control" required value="<?= htmlspecialchars($panel['model_name']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Manufacturer</label>
            <input type="text" name="manufacturer" class="form-control" required value="<?= htmlspecialchars($panel['manufacturer']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Power Output (W)</label>
            <input type="number" name="power_output_w" class="form-control" required value="<?= htmlspecialchars($panel['power_output_w']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Efficiency (%)</label>
            <input type="number" step="0.01" name="efficiency_percent" class="form-control" required value="<?= htmlspecialchars($panel['efficiency_percent']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Dimensions (mm)</label>
            <input type="text" name="dimensions_mm" class="form-control" required value="<?= htmlspecialchars($panel['dimensions_mm']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Weight (kg)</label>
            <input type="number" step="0.01" name="weight_kg" class="form-control" required value="<?= htmlspecialchars($panel['weight_kg']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Panel Type</label>
            <input type="text" name="panel_type" class="form-control" required value="<?= htmlspecialchars($panel['panel_type']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Voltage (Vmp)</label>
            <input type="number" step="0.01" name="voltage_vmp" class="form-control" required value="<?= htmlspecialchars($panel['voltage_vmp']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Current (Imp)</label>
            <input type="number" step="0.01" name="current_imp" class="form-control" required value="<?= htmlspecialchars($panel['current_imp']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Price (€)</label>
            <input type="number" step="0.01" name="price_eur" class="form-control" required value="<?= htmlspecialchars($panel['price_eur']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Warranty (years)</label>
            <input type="number" name="warranty_years" class="form-control" required value="<?= htmlspecialchars($panel['warranty_years']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" name="image_url" class="form-control" value="<?= htmlspecialchars($panel['image_url']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="admin_panels.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
