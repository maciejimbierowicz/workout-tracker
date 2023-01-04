<?php include("partials/header.php"); 
if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
    $_SESSION['login'] = "<div class='error'>You must be logged in</div>";
}
?>


<div class="main-content">
    <div class="wrapper">
        
        <div>
        <h2 class="text-center">Workout Details</h2>
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM workout_list WHERE id=:id";

            $result = $pdo -> prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            $result = $result -> fetch();
            if($result == true)
            {
                
                $title = $result['name'];
                $description = $result['description'];
                $category = $result['category'];
                $time = $result['time'];
                $date = $result['date'];


                ?>
                <h3><?php echo $title ?></h3>
                <p>Training description: <?php echo $description ?></p>
                <p>Category: <?php echo $category ?></p>
                <p>Time: <?php echo $time ?> minutes</p>
                <p>Date: <?php echo $date ?></p>
                
                <?php
            }
            ?>
            
        </div>
    </div>
</div>

<?php include("partials/footer.php") ?>