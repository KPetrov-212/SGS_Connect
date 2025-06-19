<?php
// Reusable component: panel.php
if (!isset($panel)) return;
?>
<div class="border border-3 rounded p-3 my-3 shadow-sm">
  <h5><?= htmlspecialchars($panel['model_name']) ?></h5>
  <ul class="mb-1">
    <li><strong>Manufacturer:</strong> <?= htmlspecialchars($panel['manufacturer']) ?></li>
    <li><strong>Power Output:</strong> <?= $panel['power_output_w'] ?> W</li>
    <li><strong>Efficiency:</strong> <?= $panel['efficiency_percent'] ?>%</li>
    <li><strong>Dimensions:</strong> <?= htmlspecialchars($panel['dimensions_mm']) ?> mm</li>
    <li><strong>Weight:</strong> <?= $panel['weight_kg'] ?> kg</li>
    <li><strong>Type:</strong> <?= htmlspecialchars($panel['panel_type']) ?></li>
    <li><strong>Voltage (Vmp):</strong> <?= $panel['voltage_vmp'] ?> V</li>
    <li><strong>Current (Imp):</strong> <?= $panel['current_imp'] ?> A</li>
    <li><strong>Warranty:</strong> <?= $panel['warranty_years'] ?> years</li>
    <li><strong>Price:</strong> €<?= number_format($panel['price_eur'], 2) ?></li>
  </ul>
</div>