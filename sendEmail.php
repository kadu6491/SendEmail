<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
   
    require_once "vendor/autoload.php";

    include "database.php";

    $msg = "";

    function sendEmail($email, $name, $firstname)
    {

        $url = "<a href='http://localhost:3000/reset.php'> Password Reset Link </a>";
        
        //PHPMailer Object
        $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

        //Enable SMTP debugging.
        // $mail->SMTPDebug = 3;  
        
        //Set PHPMailer to use SMTP.
        $mail->isSMTP(); 

        //Set SMTP host name                          
        $mail->Host = "smtp.gmail.com";

        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;   
        
        //Provide username and password     
        $mail->Username = "billionsdream0@gmail.com";                 
        $mail->Password = "$900BillionDream"; 

        $mail->SMTPSecure = "tls";
        
        //Set TCP port to connect to
        $mail->Port = 587;

        //From email address and name
        $mail->From = "billionsdream0@gmail.com";
        $mail->FromName = "OnlySweets";

        //To address and name
        $mail->addAddress($email, $name);

        //Send HTML or Plain Text email
        $mail->isHTML(true);

        $mail->Subject = "Password Reset Link";
        $mail->Body = "<h5>Hi $firstname, </h5> <br>". 
                    "We have sent you this email in response to your 
                    request to reset your password on ROSearch.<br>" . $url . "<br> We recommend that you 
                    keep your password secure and not share it with anyone. 
                    <br> <br> ROSearch Customer Service";
        
        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    };

    if(isset($_POST['reset']))
    {
        $resetEmail = $_POST['email'];

        $sql = "SELECT * FROM users WHERE user_email='$resetEmail'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                // echo $row['First_Name'] . "<br>";
                // echo $row['Last_Name'];

                $fullname = $row['First_Name'] . " " . $row['Last_Name'];
                $mail = "We have sent you this email in response to your 
                         request to reset your password on ROSearch.<br> 
                         To reset your password for ROSearch, please follow the link 
                         below:<br>" . $url . "<br> We recommend that you 
                         keep your password secure and not share it with anyone. 
                         <br> <br> ROSearch Customer Service";

                sendEmail($resetEmail, $fullname, $row['First_Name']);
                $msg = "
                        <div class='alert alert-success' role='alert'>
                            <strong>Password reset sent</strong>
                        </div>
                    ";
            }
        }

        else {
            $msg = "
                <div class='alert alert-danger' role='alert'>
                    <strong>Email does not Exit</strong>
                </div>
            ";
        }
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

<div class="container">
  <center>
    <h2 style="padding-top: 20px;">ROSearch</h2>
  </center>
  <!-- Material form subscription -->
<div class="card">

<h5 class="card-header info-color white-text text-center py-4">
    <strong>Password Reset</strong>
</h5>

<!--Card content-->
<div class="card-body px-lg-5">

    <!-- Form -->
    <form class="was-validated text-center" style="color: #757575;" method="post" action="">

        <p>Enter the email address for your ROSearch account. 
        We'll send you a link to reset your password </p>

        <!-- E-mai -->
        <div class="form-group">
            <label for="uname">Email:</label>
            <input type="email" class="form-control" id="uname" placeholder="Enter Email" name="email" required>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <?php echo $msg; ?>


        <!-- Sign in button -->
        <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit" name="reset">Sign in</button>

        <p>
            <a href="index.php"><< Back</a>
        </p>
    </form>
    <!-- Form -->

</div>

</div>
<!-- Material form subscription -->
  
</div>

</body>
</html>