<?php include("partials/header.php"); 
?>

<div class="main-content">
    <div class="wrapper">
                <form class="form" action="" method="POST">
                <?php 
        if(isset($_SESSION['logged']))
        {
            $username = $_SESSION['username'];
            $userid = $_SESSION['id']
            ?>
            <div>Welcome <?php echo $username?></div>
            <?php
        }
        else
        {
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
                    <div class="form-title">Login to your account</div>
                    <div class="form-item">
                        <label for="" class="form-label">Username: </label>
                        <input class="form-input" type="text" name="username" placeholder="Your username">
                    </div>
                    <div class="form-item">
                        <label for="" class="form-label">Password: </label>
                        <input class="form-input" type="password" name="password" placeholder="Your password">
                    </div>
                    <br>
                    <div class="form-item">
                        <input class="form-btn" type="submit" name="submit" value="Login">
                    </div>  
                    <br>
                    <div><p>You don't have an account? <a href="register.php">Sign Up</a></p></div>
                </form>
            <?php
        }?>
    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM users WHERE user_name=:username AND user_password=:password";
        $result = $pdo -> prepare($sql);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetchAll();
        if(count($user) > 0)
        {
            foreach($user as $row) {
                $user_id = $row['id'];
            }
            
            $_SESSION['logged'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $user_id;
            header("Location: index.php");
        }
        else 
        {
            $_SESSION['login'] = "<div class='error'>Wrong username or password</div>";
            header("Location: index.php");
        }
    }
?>
<?php include("partials/footer.php"); ?>