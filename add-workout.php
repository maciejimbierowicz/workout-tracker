<?php include("partials/header.php"); 
if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
    $_SESSION['login'] = "<div class='error'>You must be logged in</div>";
}
?>

<div class="main-content">
    <div class="wrapper">
        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        };
        ?>
            <form class="form" action="" method="POST">
                <div class="form-title text-center">Add Workout</div>
                <hr>
                <div class='flex-form'>
                    <div class="col-2">
                        <div class="form-item">
                            <label for="" class="form-label">Name</label>
                            <input class="form-input" type="text" name="title">
                        </div>
                        <div class="form-item">
                            <label for="" class="form-label">Description</label>
                            <textarea class="form-input" name="description" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-item">
                            <label class="form-label" for="category">Select training category</label>
                            <select class="form-input" name="category" id="">
                                <option value="Strength">Strength</option>
                                <option value="Cardio">Cardio</option>
                            </select> 
                        </div>
                        <div class="form-item">
                            <label for="" class="form-label">Training Time (minutes)</label>
                            <input class="form-input" type="number" name="time">
                        <div class="form-item">
                            <label for="" class="form-label">Training Date</label>
                            <input class="form-input" type="date" name="date">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="form-item">
                    <input class="form-btn" type="submit" name="submit" value="Add Training">
                </div>       
            </form>
        </div>
    </div>
</div>

<?php 

if(isset($_POST['submit']))
{   
    $user_id = $_SESSION['id'];
    $name = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    $sql = "INSERT INTO workout_list SET
    name=:name,
    description=:description,
    category=:category,
    time=:time,
    date=:date,
    user_id=:user_id
    ";

    $result = $pdo -> prepare($sql);
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':description', $description, PDO::PARAM_STR);
    $result->bindParam(':category', $category, PDO::PARAM_STR);
    $result->bindParam(':time', $time, PDO::PARAM_INT);
    $result->bindParam(':date', $date, PDO::PARAM_STR);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result -> execute();
    if($result == true)
    {
        $_SESSION['add'] = "<div class='success'>Succesfully added new workout :)</div>";
        header('Location: workout-list.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to add new workout</div>";
        header('Location: add-workout.php');
    }

}
?>
<?php include("partials/footer.php"); ?>