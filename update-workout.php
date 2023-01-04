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
        <div class="form-title">Add Workout</div>
        <hr>
        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM workout_list WHERE id=:id";

            $result1 = $pdo -> prepare($sql);
            $result1->bindParam(':id', $id, PDO::PARAM_INT);
            $result1->execute();
            $result1 = $result1 -> fetch();
            
            $title = $result1['name'];
            $description = $result1['description'];
            $time = $result1['time'];
            $date = $result1['date'];
            $category =$result1['category'];
            ?>
            
            <div class="form-item">
                <label class="form-label" for="category">Select training category</label>
                <select class="form-input" name="category" id="">
                    <option <?php if($category === "Strength"){echo "selected";}?> value="Strength">Strength</option>
                    <option <?php if($category === "Cardio"){echo "selected";}?> value="Cardio">Cardio</option>
                </select> 
            </div>
            <div>
                <label class="form-label" for="">Name</label>
                <input class="form-input" type="text" name="title" value="<?php echo $title ?>">
            </div>
            <div class="form-item">
                <label for="" class="form-label">Description</label> 
                <textarea class="form-input" name="description" id="" cols="30" rows="10"><?php echo $description ?></textarea>
            </div>
            <div class="form-item">
                <label for="" class="form-label">Training Time (minutes)</label>
                <input class="form-input" type="number" name="time" value=<?php echo $time ?>>min
            <div class="form-item">
                <label for="" class="form-label">Training Date</label>
                <input class="form-input" type="date" name="date" value=<?php echo $date ?>>
            </div>
            <div class="form-item">
                <input class="form-btn" type="submit" name="submit" value="Update Training">
            </div>       
        </form>
    </div>
</div>
<?php 
if(isset($_POST['submit']))
{   
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    $sql = "UPDATE workout_list SET
    name=:name,
    description=:description,
    category=:category,
    time=:time,
    date=:date,
    WHERE id=:id
    ";

    $result = $pdo -> prepare($sql);
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':description', $description, PDO::PARAM_STR);
    $result->bindParam(':category', $category, PDO::PARAM_STR);
    $result->bindParam(':time', $time, PDO::PARAM_INT);
    $result->bindParam(':date', $date, PDO::PARAM_STR);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result -> execute();
    if($result == true)
    {
        $_SESSION['add'] = "<div class='success'>Succesfully updated new workout :)</div>";
        header('Location: workout-list.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to update new workout</div>";
        header('Location: add-workout.php');
    }

}
?>
<?php include("partials/footer.php"); ?>