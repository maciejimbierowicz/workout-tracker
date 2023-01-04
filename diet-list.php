<?php include("partials/header.php"); 
if(!isset($_SESSION['logged'])) 
{
    header('Location: index.php');
    $_SESSION['login'] = "<div class='error'>You must be logged in</div>";
}
?>

<div class="main-content">
    <?php
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        };
        ?>
    <div class="wrapper">
        <table class="tbl-50">
            <tr>
                <th>Day</th>
                <th>Calories</th>
                <th>Protein</th>
                <th>Carbs</th>
                <th>Fat</th>
                <th>Config</th>
                
            </tr>
            <?php 
            $user_id = $_SESSION['id'];
            $result = $pdo -> prepare("SELECT * FROM nutrition_list WHERE user_id=:user_id");
            $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result->execute();
            $nutrition_list = $result -> fetchAll();

            foreach($nutrition_list as $row)
            {
                $id = $row['id'];
                $date = $row['date'];
                $carbs = $row['carb'];
                $proteins = $row['protein'];
                $fats = $row['fat'];
                $calories = $row['calories'];
                ?>
                <tr>
                    <td><a href="diet-details.php?id=<?php echo $id ?>"><?php echo $date; ?></a></td>
                    <td><?php echo $calories; ?>kcal</td>
                    <td><?php echo $carbs; ?>g</td>
                    <td><?php echo $proteins; ?>g</td>
                    <td><?php echo $fats; ?>g</td>
                    <td>
                        <a href="update-diet.php?id=<?php echo $id ?>">Update</a>
                        <a href="delete-diet.php?id=<?php echo $id ?>">Delete</a>
                    </td>
                </tr>
                
                <?php
            }
            ?>
        </table>
    </div>
</div>


<?php include("partials/footer.php"); ?>