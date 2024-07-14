<?php
require 'connectDB.php';

$db = connectDB::connectPWTC();
$sql = "SELECT * FROM `data`";
$stmt = $db->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ma'lumotlarni Ko'rish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Ma'lumotlarni Ko'rish</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Ismi</th>
            <th>Familyasi</th>
            <th>Kelgan vaqti</th>
            <th>Ketgan vaqti</th>
            <th>Ishlash vaqti (soat)</th>
            <th>Kunlik maosh (UZS)</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['lastName']) ?></td>
                <td><?= htmlspecialchars($row['arrAt']) ?></td>
                <td><?= htmlspecialchars($row['leavAt']) ?></td>
                <td><?= htmlspecialchars($row['workingDur']) ?></td>
                <td><?= htmlspecialchars($row['dailySalary']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form action="exportAs.php" method="post">
        <button type="submit" class="btn btn-success">Ma'lumotlarni saqlash</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
