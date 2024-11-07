<?php 
    require '../assets/config.php'; 
    $obj = new db();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/loginStyle.css">
</head>

<body>
    <div class="container">
        <!-- code here -->
        <div class="card">
            <div class="card-image">
                <h2 class="card-heading">
                    Student Management Panel
                    <small>Welcome Back</small>
                </h2>
            </div>
            <form class="card-form" method="POST">
                <div class="input">
                    <input type="email" class="input-field" autofocus name="email" required />
                    <label class="input-label">Email</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" name="password" required />
                    <label class="input-label">Password</label>
                </div>
                <div class="action">
                    <input class="action-button" type="submit" value="Get Started" name="btnSubmit">
                </div>
            </form>
            <div class="card-info">
                <p>If you dont have an account<a href="./register.php">Create an Account</a></p>
            </div>
        </div>
    </div>

</body>

</html>

<?php 

    if(isset($_POST['btnSubmit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $obj->loginStudent($email, $password);
        
    }

?>