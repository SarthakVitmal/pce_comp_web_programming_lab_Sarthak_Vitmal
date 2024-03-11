<?php
// $showAlert = false;
$showError = true;
// to enable successfull connection to the database

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include"db.php";
        if(isset($_POST['register'])){
            $uname = $_POST['uname'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            
            // check whether this username exists or not
            $existSql = "SELECT * FROM `form` WHERE uname = '$uname'";
            $result = mysqli_query($con, $existSql);
            $numExistRows = mysqli_num_rows($result);
            if($numExistRows > 0){
                echo "<script type='text/javascript'> alert('Username Exists!'); window.location.href = 'signup.php';</script>";
                $showError = "Username Already Exists";
                exit();
            }
            $hash = password_hash($pass,PASSWORD_DEFAULT);
            if(!empty($email) && !empty($pass) && !is_numeric($email)){
                $query = "insert into form (uname, email, pass) values ('$uname', '$email', '$hash')";
                mysqli_query($con, $query);
                echo "<script type='text/javascript'> alert('Successfully Registered')</script>";
                header("location: signin.php");
            }
            else{
                echo "<script type='text/javascript'> alert('Please enter some valid information!')</script>";
            }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style_1.css">
    <title>SignUp</title>
</head>


<body>
    <!-- Wrapper to contain the forms -->
    <div class="wrapper">
        <!-- Container for the sign-up form -->
        <div class="form-container sign-up">
            <!-- Form for sign-up -->
            <form action="#" method="POST">
                <!-- Heading </h2> -->
                <canvas id="myCanvas"
                 weight="50px" height="50px" 
                style="border:0px solid grey;">
                </canvas>
                <!-- Form group for username input -->
                    <div class="form-group">
                        <input type="text" name="uname" required>
                        <!-- Icon for username input -->
                        <i class="fas fa-user"></i>
                        <!-- Label for username input -->
                        <label for="">username</label>
                    </div>
                    <!-- Form group for email input -->
                    <div class="form-group">
                        <input type="email" name="email" required>
                        <!-- Icon for email input -->
                        <i class="fas fa-at"></i>
                        <!-- Label for email input -->
                        <label for="">email</label>
                    </div>
                    <!-- Form group for password input -->
                    <div class="form-group">
                        <input type="password" name="pass" required>
                        <!-- Icon for password input -->
                        <i class="fas fa-lock"></i>
                        <!-- Label for password input -->
                        <label for="">password</label>
                    </div>
                    <!-- Button to submit sign-up form -->
                    <button type="submit" name="register" class="btn">sign up</button>
                    <!-- Link to sign-in form -->
                    <div class="link">
                        <p>You already have an account?<a href="signin.php" class="signin-link"> sign in</a></p>
                    </div>
                    <script>
                        const canvas = document.getElementById("myCanvas");
                        const ctx = canvas.getContext("2d");
                        
                        ctx.font = "bold 30px  Poppins";
                        ctx.textAlign = "center";
                        ctx.fillText("Sign Up",canvas.width/2, canvas.height/0.75/2);
                    </script>
            </form>
        </div>
    <!-- Font Awesome kit for icons -->
    <script src="https://kit.fontawesome.com/9e5ba2e3f5.js" crossorigin="anonymous"></script>
</body>
</html>