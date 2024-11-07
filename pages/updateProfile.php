<?php 

require '../assets/config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./pages/login.php');
    exit;
}
$obj = new db();
$id = $_SESSION['user_id'];
$studentData = $obj->viewStudentData($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="../assets/update.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <?php 
                    foreach($studentData as $data){
                ?>
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="<?php echo $data['profile'] ?>">
                </div>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="file" class="ml-5">
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $data['firstname']; ?>" >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Surname</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $data['lastname']; ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" value="<?php echo $data['mobile']; ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                            </div>
                        </div>
                        <?php 
                            }
                        ?>
                        <div class="mt-5 text-center">
                            <input type="submit" name="btnSubmit" value="Save Profile" class="btn btn-primary profile-button">
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    </div>
</body>

</html>

<?php 

    if(isset($_POST['btnSubmit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        //handling file upload
        $targeted_dir = "../uploads/";
        $targeted_file = $targeted_dir . basename($_FILES["file"]["name"]);
        if(move_uploaded_file(($_FILES["file"]["tmp_name"]), $targeted_file)){
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        }
        else{
            echo "There was an error uploading the file.";
        }
        $obj->updateProfile($id, $firstname, $lastname, $email, $mobile, $targeted_file);
        header('Location:../index.php');
    }


?>