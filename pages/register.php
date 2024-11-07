<?php 
    require '../assets/config.php'; 
    $obj = new db();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/loginStyle.css">
</head>

<body>
    <div class="container">
        <!-- code here -->
        <div class="card">
            <div class="card-image">
                <h2 class="card-heading">
                    Student Management Panel
                    <small>Let us create your account</small>
                </h2>
            </div>
            <form class="card-form" method="post">
                <div class="input">
                    <input type="text" class="input-field" autofocus name="name" required />
                    <label class="input-label">Name</label>
                </div>
                <div class="input">
                    <input type="text" class="input-field" name="number" required />
                    <label class="input-label">Number</label>
                </div>
                <div class="input">
                    <input type="email" class="input-field" name="email" required />
                    <label class="input-label">Email</label>
                </div>
                <div class="input">
                    <input type="password" class="input-field" name="password" required />
                    <label class="input-label">Password</label>
                </div>
                <div class="action">
                    <input type="submit" value="Get Started" name="btnSubmit" class="action-button">
                </div>
            </form>
            <div class="card-info">
                <p>If you have an account<a href="./login.php">Log In</a></p>
            </div>
        </div>
    </div>

</body>

</html>

<?php 

    if(isset($_POST['btnSubmit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $number = $_POST['number'];
    
        $obj->insertData($name, $email, $password, $number);
    }

?>