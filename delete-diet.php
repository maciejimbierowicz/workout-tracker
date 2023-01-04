<?php 
if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
}
include("config/functions.php");
session_start();
ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );

$pdo = get_connection();

$id = $_GET['id'];

$sql = "DELETE FROM nutrition_list WHERE id=:id";

$result = $pdo -> prepare($sql);
$result->bindParam(':id', $id, PDO::PARAM_INT);
$result->execute();

if($result == true)
{
    $_SESSION['delete'] = "<div class='success'>Succesfully deleted diet</div>";
    header("Location: diet-list.php");
}
else 
{
    $_SESSION['delete'] = "<div class='error'>Failed to delete diet</div>";
    header("Location: diet-list.php");
}
