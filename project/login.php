<!DOCTYPE html>
<?php  session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
        include 'connect.php';
        if(isset($_POST['submit'])){
        $username =  $_POST['username'];
        $password =  $conn->real_escape_string($_POST['password']);
        
        $sql = "SELECT * FROM `member` WHERE `username` = '".$username."' AND `password` = '".$password."'"; 
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            header('location:index.html');
        }else{
            echo 'Username & Password invalid';
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto mt-5">
                <div class="card">
                <form action="" method="post">
                    <div class="card-header text-center">
                        เข้าสู่ระบบ
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-4 col-form-lable">Username</label>
                            <div class="col-sm-11">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-4 col-form-lable">Password</label>
                            <div class="col-sm-11">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" name="submit" class="btn btn-success" value="Login">
                    </div>
                </form>    
                </div>
            </div>
        </div>
    </div>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>
</html>