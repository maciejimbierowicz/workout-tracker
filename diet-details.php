<?php include("partials/header.php"); 

if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
    $_SESSION['login'] = "<div class='error'>You must be logged in</div>";
}
?>


<div class="main-content">
    <div class="wrapper">
        <h2 class="text-center">Diet Details</h2>
        <div>
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM nutrition_list WHERE id=:id";

            $result = $pdo -> prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            $result = $result -> fetch();
            if($result == true)
            {
                
                $description = $result['description'];
                $date = $result['date'];
                $carbs = $result['carb'];
                $proteins = $result['protein'];
                $fats = $result['fat'];
                $calories = $result['calories'];


                ?>
                <h3>Calories: <?php echo $calories ?>kcal</h3>
                <p>Description: <?php echo $description?></p>
                <p>Date: <?php echo $date ?></p>
                <p>Carbs: <?php echo $carbs ?>g</p>
                <p>Proteins: <?php echo $proteins ?>g</p>
                <p>Fats: <?php echo $fats ?>g</p>
                
                <?php
            }
            ?>
            
        </div>
    </div>
</div>

<?php include("partials/footer.php") ?>