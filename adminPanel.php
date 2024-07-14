<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'connectDB.php';

    $db = connectDB::connectPWTC();
    $sql = "INSERT INTO `data` (name, lastName, arrAt, leavAt, workingDur, dailySalary) VALUES (:name, :lastName, :arrAt, :leavAt, :workingDur, :dailySalary)";

    $arrivedAt = new DateTime($_POST['arrAt']);
    $leavedAt = new DateTime($_POST['leavAt']);
    $salaryPerH = $_POST['salaryPerH'];

    $workingDur = $arrivedAt->diff($leavedAt);
    $salary = $salaryPerH * $workingDur->h;
    $workingDurToInt = (int)$workingDur->h;

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':lastName', $_POST['lastName']);
    $stmt->bindParam(':arrAt', $_POST['arrAt']);
    $stmt->bindParam(':leavAt', $_POST['leavAt']);
    $stmt->bindParam(':workingDur', $workingDurToInt);
    $stmt->bindParam(':dailySalary', $salary);

    if ($stmt->execute()) {
        $message = "Ma'lumotlar muvaffaqiyatli saqlandi!";
    } else {
        $message = "Ma'lumotlarni saqlashda xatolik yuz berdi!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
        .view-data-button {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            margin-top: 10px;
        }
        .export-button {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="logout-button">
    <a href="logout.php" class="btn btn-primary">Log out</a>
</div>

<div class="container-fluid text-center d-flex align-items-start justify-content-center vh-100">
    <div>
        <h1>Welcome to the Admin Panel</h1>
        <p>You are successfully logged in!</p>
        <?php if ($message): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <div class="form-container mt-4">
            <form action="adminPanel.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Ismi</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Familyasi</label>
                    <input type="text" class="form-control" id="surname" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="arrival-time" class="form-label">Kelgan vaqti</label>
                    <input type="datetime-local" class="form-control" id="arrival-time" name="arrAt" required>
                </div>
                <div class="mb-3">
                    <label for="departure-time" class="form-label">Ketgan vaqti</label>
                    <input type="datetime-local" class="form-control" id="departure-time" name="leavAt" required>
                </div>
                <div class="mb-3">
                    <label for="hourly-rate" class="form-label">Soatiga qancha maosh tolanishi (UZS)</label>
                    <input type="number" class="form-control" id="hourly-rate" name="salaryPerH" required>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="showData.php" class="btn btn-primary view-data-button">Ma'lumotlarni ko'rish</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
