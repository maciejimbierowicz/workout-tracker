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
        <div class="form-title text-center">ADD DIET</div>
        <hr>
        <div class="flex-form">
            <div class="col-2">
                <div class="form-item">
                    <label for="" class="form-label">Date</label>
                    <input class="form-input  form-input-small" type="date" name="date">
                </div>
                <div class="form-item">
                    <label class="form-label" for="">Description</label>
                    <textarea class="form-input" cols="30" rows="10" name="description"></textarea>
                </div>
            </div>
            <div class="col-2">
                <div class="form-item">
                    <label for="" class="form-label">Calories (kcal)</label>
                    <input class="form-input form-input-small" type="number" name="calories">
                </div>
                <div class="form-item">
                    <label for="" class="form-label">Proteins (grams)</label>
                    <input class="form-input form-input-small" type="number" name="proteins">
                </div>
                <div class="form-item">
                    <label for="" class="form-label">Carbs (grams)</label>
                    <input class="form-input form-input-small" type="number" name="carbs">
                </div>
                <div class="form-item">
                    <label for="" class="form-label">Fats (grams)</label>
                    <input class="form-input form-input-small" type="number" name="fats">
                </div>
            </div>
            </div>
            <div class="form-item">
                <input class="form-btn" type="submit" name="submit" value="Add Diet">
            </div>
        </form>
    </div>
</div>

<?php 

if(isset($_POST['submit']))
{   
    $user_id = $_SESSION['id'];
    $carbs = $_POST['carbs'];
    $description = $_POST['description'];
    $proteins = $_POST['proteins'];
    $fats = $_POST['fats'];
    $calories = $_POST['calories'];
    $date = $_POST['date'];

    $sql = "INSERT INTO nutrition_list SET
    description=:description,
    date=:date,
    carb=:carbs,
    protein=:proteins,
    fat=:fats,
    calories=:calories,
    user_id=:user_id
    ";

    $result = $pdo -> prepare($sql);
    $result->bindParam(':description', $description, PDO::PARAM_STR);
    $result->bindParam(':date', $date, PDO::PARAM_STR);
    $result->bindParam(':carbs', $carbs, PDO::PARAM_INT);
    $result->bindParam(':proteins', $proteins, PDO::PARAM_INT);
    $result->bindParam(':fats', $fats, PDO::PARAM_INT);
    $result->bindParam(':calories', $calories, PDO::PARAM_INT);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result->execute();
    if($result == true)
    {
        $_SESSION['add'] = "<div class='success'>Succesfully added new nutrition :)</div>";
        header('Location: diet-list.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to add new nutrition</div>";
        header('Location: add-diet.php');
    }

}
?>

<?php include("partials/footer.php"); ?>