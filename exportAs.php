<?php
require 'connectDB.php';

$db = connectDB::connectPWTC();
$sql = "SELECT * FROM `data`";
$stmt = $db->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=data_export.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('Ismi', 'Familyasi', 'Kelgan vaqti', 'Ketgan vaqti', 'Ishlash vaqti (soat)', 'Kunlik maosh (UZS)'));

foreach ($data as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
