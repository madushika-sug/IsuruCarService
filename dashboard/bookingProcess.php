<?php

require_once("../database/databaseLogin.php");
session_start();
$customer_id = $_SESSION['customer_id'];

try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$rental_date = $_POST['rentaldate'];
$return_date = $_POST['returndate'];
$vehicle_reg_number = $_POST['rnumber'];

try {

    $query = "INSERT INTO `rental`(`Rental_date`,`Return_date`,`Customer_ID`,`vehicle_registration_number`,`Rental_status`) 
    VALUES(:rentaldate,:returndate,:cusID,:vregnumber,'Ongoing');";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(':cusID', $customer_id);
    $stmt->bindParam(':rentaldate', $rental_date);
    $stmt->bindParam(':returndate', $return_date);
    $stmt->bindParam(':vregnumber', $vehicle_reg_number);
    
    $stmt->execute();
    echo('done');

   

} catch (PDOException $e) {
    
    echo "Error: " . $e->getMessage();
}

?>