<?php include("partials/header.php");?>
<?php 

if(isset($_SESSION['logged']))
{
    header("Location: index.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <?php 
        if(isset($_SESSION['register']))
        {
            echo $_SESSION['register'];
            unset($_SESSION['register']);
        }
        ?>
        <form class="form" action="" method="POST">
            <div class="form-title">Sign Up</div>
            <div class="form-item">
                <label for="" class="form-label">Username</label>
                <input class="form-input" type="text" name="username" placeholder="Type your username">
            </div>
            
            <div class="form-item">
                <label for="" class="form-label">E-Mail</label>
                <input class="form-input" type="text" name="email" placeholder="Type your email">
            </div>
        
            <div class="form-item">
                <label for="" class="form-label">Password</label>
                <input class="form-input" type="password" name="password" placeholder="Type your password">
            </div>
            
            <div class="form-item">
                <label for="" class="form-label">Confirm Password</label>
                <input class="form-input" type="password" name="confirm" placeholder="Confirm your password">
            </div>
            <br>
            <div class="form-item">
                <input class="form-btn" type="submit" name="submit" value="Register" >
            </div>
            <br>
            <div>
            <p>Already registered? <a href="index.php">Sign In</a></p>
        </div>
        </form>
        <br>
    </div>
</div>


<?php 

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm']);
    $email = $_POST['email'];

    $sql = "SELECT * FROM users";
    $check_users = $pdo -> query($sql);
    $check_users = $check_users -> fetchAll();
    
    foreach($check_users as $user)
    {
        $username2 = $user['user_name'];
        $email2 = $user['user_email'];
        echo $username;
        echo $username2;
        if($username == $username2)
        {
            $_SESSION['register'] = "<div class='error'>This username already exists in database</div>";
            $users_check = false;
            header("Location: register.php");
        }
        else if ($email == $email2)
        {
            $_SESSION['register'] = "<div class='error'>This email already exists in database</div>";
            $users_check = false;
            header("Location: register.php");
        }
        else
        {
            $users_check = true;
        }
    }

    if($users_check == true)
    {
        if($password == $confirm_password) 
        {
            $sql2 = "INSERT INTO users SET user_name=:username, user_email=:email, user_password=:password";

            $result = $pdo -> prepare($sql2);
            $result->bindParam(':username', $username, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            $result->execute();

            if($result == true)
            {
                $_SESSION['login'] = "<div class='success'>Succesfully registered new account. You can now login.</div>";
                header("Location: index.php");
            }
        }
        else
        {
            $_SESSION['register'] = "<div class='error'>Passwords are not the same</div>";
            header("Location: register.php");
        }
    }


}
?>
<?php include("partials/footer.php");?>