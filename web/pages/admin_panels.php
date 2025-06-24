<?php
session_start();
require '../config.php';

// Ограничаваме достъпа само за админи
if (!isset($_SESSION['user'])   || ( isset($_SESSION['user']) && $_SESSION['user']['email'] != "office.sgs.connect@gmail.com" )         ) {
    header('Location: pages/login.php');
    exit;
}

// Вземаме всички панели от базата
$result = $conn->query("SELECT * FROM panels ORDER BY id DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel - Panels List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h1>Admin Panel - Solar Panels</h1>
    <a href="admin_add_panel.php" class="btn btn-success mb-3">Add New Panel</a>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Model Name</th>
                <th>Manufacturer</th>
                <th>Power (W)</th>
                <th>Price (€)</th>
                <th>Warranty (years)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($panel = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($panel['id']) ?></td>
                <td><?= htmlspecialchars($panel['model_name']) ?></td>
                <td><?= htmlspecialchars($panel['manufacturer']) ?></td>
                <td><?= htmlspecialchars($panel['power_output_w']) ?></td>
                <td><?= number_format($panel['price_eur'], 2) ?></td>
                <td><?= htmlspecialchars($panel['warranty_years']) ?></td>
                <td>
                    <a href="admin_edit_panel.php?id=<?= $panel['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="admin_delete_panel.php?id=<?= $panel['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this panel?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
            <?php if ($result->num_rows === 0): ?>
                <tr><td colspan="7" class="text-center">No panels found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
