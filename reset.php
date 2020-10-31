
<?php 
    include "database.php";
    $key = $_GET['key'];

    $sql = "SELECT * FROM user WHERE email='$key'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0)
    {
        if(isset($_POST["reset"]))
        {
            $email = $_GET['key'];
            $pass = $_POST['newpass'];
            $retry = $_POST["retry"];

            if($pass == $retry)
            {
                $new_pass = md5($pass);
                $select=mysqli_query($conn, "update user set password='$new_pass' where email='$email'");
                header("location: ../login.php");
            }

            else {
                echo "
                        <div class='alert alert-danger' role='alert'>
                            <strong>Password do not match</strong>
                        </div>
                    ";
            }
            
        }
    }

    else {
        header("location: ../index.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Password Reset | ROSearch</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <style>
        .pass_show{position: relative} 

        .pass_show .ptxt { 

            position: absolute; 

            top: 50%; 

            right: 10px; 

            z-index: 1; 

            color: #f36c01; 

            margin-top: -10px; 

            cursor: pointer; 

            transition: .3s ease all; 

        } 

        .pass_show .ptxt:hover{color: #333333;} 
        
    </style>

    <div class="container">
        <h3>New Password | ROSearch </h3>
        <form class="text-left" style="color: #757575; margin-top: 20px;" action="#!" method="post">
            <div class="row">
                <div class="col-sm-4">
                    <label>New Password</label>
                    <div class="form-group pass_show"> 
                        <input type="password" class="form-control" name="newpass" > 
                    </div> 
                    <label>Confirm Password</label>
                    <div class="form-group pass_show"> 
                        <input type="password" class="form-control" name="retry" > 
                    </div> 
                    <button type="submit" class="btn btn-primary" name="reset">Submit</button>
                </div>  
            </div>
        </form>
    </div>

<script>
    $(document).ready(function(){
    $('.pass_show').append('<span class="ptxt">Show</span>');  
    });
    

    $(document).on('click','.pass_show .ptxt', function(){ 

    $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

    });  
</script>
</body>
</html>