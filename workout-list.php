<?php include("partials/header.php"); 
if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
    $_SESSION['login'] = "<div class='error'>You must be logged in</div>";
}
?>

<div class="main-content">
    <div class="wrapper">
        <h2>Workout List</h2>
    <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        };
        
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        };
        ?>
        <table class="tbl-50">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Date</th>
                <th>Config</th>
            </tr>
            
            <?php
            $user_id = $_SESSION['id'];
            $result = $pdo -> prepare("SELECT * FROM workout_list WHERE user_id=:user_id");
            $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result->execute();
            $workout_list = $result -> fetchAll();

            foreach($workout_list as $workout)
            {
                $id = $workout['id'];
                $name = $workout['name'];
                $category = $workout['category'];
                $date = $workout['date'];
            ?>
        <tr>
                <td><a href="workout-details.php?id=<?php echo $id ?>"><?php echo $name; ?></a></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $date; ?></td>
                <td>
                    <a href="update-workout.php?id=<?php echo $id ?>">Update</a>
                    <a href="delete-workout.php?id=<?php echo $id ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
</div>

<?php include("partials/footer.php"); ?>