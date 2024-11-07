<?php

class db
{
    private $con;

    function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=student_master';
        $uname = 'root';
        $pwd = '';

        $this->con = new PDO($dsn, $uname, $pwd);
    }

    function insertData($name, $email, $password, $number)
    {
        if (strlen($name) < 6 || strlen($name) > 8) {
            return "Username must be between 6 to 8 characters long.";
        }
        
        if (!ctype_alnum($name)) {
            return "Username must be alphanumeric.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO student_data(firstname, email, mobile, password) VALUES(:name, :email, :mobile, :password)";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $number);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "Registration successfull";
        } else {
            echo "Error: ";
        }
        header('Location: ../pages/Login.php');
    }

    function loginStudent($email, $password){
        $query = "SELECT * FROM student_data WHERE email = :email";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $verify = $stmt->fetch();
        if($verify && password_verify($password, $verify['password'])){
            echo 'Login successful';
            $_SESSION['user_id'] = $verify['id'];
            $_SESSION['email'] = $email;
            
            header('Location: ../index.php');
            exit;
        }
        else{
            echo 'Invalid Username or Password';
        }
    }

    function viewStudentData($id){
        $_REQUEST['id'] = $id;
        $query = "SELECT * FROM student_data WHERE id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $studentData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $studentData;
    }

    function updateProfile($id, $firstname, $lastname, $email, $mobile, $profile){
        $_REQUEST['id'] = $id;
        $query = "UPDATE student_data SET firstname = :firstname, lastname = :lastname, email = :email, mobile = :mobile, profile = :profile WHERE id = :id";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':profile', $profile);
        $stmt->execute();
    }
}
