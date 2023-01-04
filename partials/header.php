<?php include("config/functions.php"); 

session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$pdo = get_connection();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        
            <div class="logo">
                    <img src="images/logo.png" alt="Workout Tracker Logo">
                    <p class="logo-text text-center">YOUR WORKOUT TRACKER</p>
                </div>
            <div class="container">
                
                <div class="sidebar">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="workout-list.php">Training Log</a></li>
                        <li><a href="diet-list.php">Diet Log</a></li>
                        <li><a href="add-workout.php">Add Workout</a></li>
                        <li><a href="add-diet.php">Add Diet</a></li>
                        <?php 
                        if(isset($_SESSION['logged']))
                        {
                            echo "<li><a href='logout.php'>Logout</a></li>"; 
                        }
                        else
                        {
                            echo "<li><a href='register.php'>Sign Up</a></li>"; 
                        }?>
                    </ul>
                </div>
            </div>
        