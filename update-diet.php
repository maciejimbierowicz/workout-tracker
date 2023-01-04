<?php include("partials/header.php"); 

if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
    $_SESSION['login'] = "<div class='error'>You must be logged in</div>";
}
?>

<div class="main-content">
    <div class="wrapper">
    
        <form class="form" action="" method="POST">
            <div class="form-title">Update Diet</div>
            <hr>
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM nutrition_list WHERE id=:id";

            $result1 = $pdo -> prepare($sql);
            $result1->bindParam(':id', $id, PDO::PARAM_INT);
            $result1->execute();
            $result1 = $result1 -> fetch();

            $date = $result1['date'];
            $calories = $result1['calories'];
            $carbs = $result1['carb'];
            $proteins = $result1['protein'];
            $fats = $result1['fat'];
            $description = $result1['description'];

        
            ?>
            <div class='form-item'>
                <label class='form-label' for="">Name</label>
                <input class='form-input' type="date" name="date" value=<?php echo $date ?>>
            </div>
            <div class='form-item'>
                <label class='form-label' for="">Calories(kcal)</label>
                <input class='form-input' type="number" name="calories" value=<?php echo $calories ?>>
            </div>
            <div class='form-item'>
                <label class='form-label' for="">Proteins(grams)</label>
                <input class='form-input form-input-small' type="number" name="proteins" value=<?php echo $proteins ?>>
            </div>
            <div class='form-item'>
                <label class='form-label' for="">Carbs(grams)</label>
                <input class='form-input form-input-small' type="number" name="carbs" value=<?php echo $carbs ?>>
            </div>
            <div class='form-item'>
                <label class='form-label' for="">Fats(grams)</label>
                <input class='form-input form-input-small' type="number" name="fats" value=<?php echo $fats ?>>
            </div>
            <div class='form-item'>
                <label class='form-label' for="">Description</label>
                <textarea class='form-input' cols="30" rows="10" name="description"><?php echo $description ?></textarea>
            </div>
            <div class='form-item'>
                <input class='form-btn' type="submit" name="submit" value="Update Diet">
            </div>
        </form>
    </div>
</div>
<?php 

if(isset($_POST['submit']))
{   
    $carbs = $_POST['carbs'];
    $description = $_POST['description'];
    $proteins = $_POST['proteins'];
    $fats = $_POST['fats'];
    $calories = $_POST['calories'];
    $date = $_POST['date'];

    $sql = "UPDATE nutrition_list SET
    description=:description,
    date=:date,
    carb=:carbs,
    protein=:proteins,
    fat=:fats,
    calories=:calories
    WHERE id=:id
    ";

    $result = $pdo -> prepare($sql);
    $result->bindParam('id', $id, PDO::PARAM_INT);
    $result->bindParam(':description', $description, PDO::PARAM_STR);
    $result->bindParam(':date', $date, PDO::PARAM_STR);
    $result->bindParam(':carbs', $carbs, PDO::PARAM_INT);
    $result->bindParam(':proteins', $proteins, PDO::PARAM_INT);
    $result->bindParam(':fats', $fats, PDO::PARAM_INT);
    $result->bindParam(':calories', $calories, PDO::PARAM_INT);
    $result->execute();
    if($result == true)
    {
        $_SESSION['add'] = "<div class='success'>Succesfully updated new nutrition :)</div>";
        header('Location: diet-list.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to update new nutrition</div>";
        header('Location: add-diet.php');
    }

}
?>

<?php include("partials/footer.php"); ?>
