<?php
//
//declare(strict_types=1);
//require 'connectDB.php';
//
//if (empty($_POST)){
//    return false;
//}
//
//$db = connectDB::connectPWTC();
//$sql = "INSERT INTO `data` (name, lastName, arrAt, leavAt, workingDur, dailySalary) VALUES (:name, :lastName, :arrAt, :leavAt, :workingDur, :dailySalary)";
//
//$arrivedAt = new DateTime( $_POST['arrAt']);
//$leavedAt = new DateTime($_POST['leavAt']);
//$salaryPerH = $_POST['salaryPerH'];
//
//$workingDur = $arrivedAt->diff($leavedAt);
//
//$salary = $salaryPerH * $workingDur->h;
//
//$workingDurToInt = (int)$workingDur->h;
//
//$stmt = $db->prepare($sql);
//$stmt->bindParam(':name', $_POST['name']);
//$stmt->bindParam(':lastName', $_POST['lastName']);
//$stmt->bindParam(':arrAt', $_POST['arrAt']);
//$stmt->bindParam(':leavAt', $_POST['leavAt']);
//$stmt->bindParam(':workingDur', $workingDurToInt);
//$stmt->bindParam(':dailySalary', $salary);
//$stmt->execute();
