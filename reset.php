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
        <form class="text-left" style="color: #757575; margin-top: 20px;" action="#!">
            <div class="row">
                <div class="col-sm-4">
                    
                    <label>Current Password</label>
                    <div class="form-group pass_show"> 
                        <input type="password" class="form-control" > 
                    </div> 
                    <label>New Password</label>
                    <div class="form-group pass_show"> 
                        <input type="password" class="form-control" > 
                    </div> 
                    <label>Confirm Password</label>
                    <div class="form-group pass_show"> 
                        <input type="password" class="form-control" > 
                    </div> 
                    <button type="submit" class="btn btn-primary">Submit</button>
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