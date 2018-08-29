<?php
    session_start(); 
    global $db; 
    define("PATH", dirname(__FILE__) . './includes/');
    require_once (PATH . 'db_connection.php');
    // $id     = isset($_GET['id'])? $_GET['id'] : '';
    $db     = db_connect();
    $user   = find_user($_SESSION['id']);
?>

<!doctype html>
<html>
<head>
    <title>PROFILE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .btn1{
            border: none; 
            width: 38%;
            padding: 11px;
            margin: 35px 0 0 46px;
            border-radius: 5px;
            float: left;
        }
    </style>
</head>
<body>
    
     <!--////////////////////////////////////////// Profile \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <dl>
                    <dt>Name: </dt>
                    <dd><?=$user['username']?></dd>
                </dl>
                <dl>
                    <dt>Mobile No.: </dt>
                    <dd><?= $user['phone']?></dd>
                </dl>
                <dl>
                    <dt>email: </dt>
                    <dd><?=$user['email']?></dd>
                </dl>
                </div>
                <div class="col-md-12 btns">
                    <a href="<?='edit.php?id='. $_GET['id']?>"><button class="btn1">Edit</button></a>
                    <a href="intern.php"><button class="btn1">Logout</button></a>
                </div>
            </div>
        </div>
    </div>


    <div class="row footer" style="margin-right: 0;">
        <p>Copyrights &copy; Hadeel Ashraf</p>
    </div>

    
<!--////////////////////////////////////////// end of footer \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/main.js"></script>

</body>
</html>
<?php
    global $db; 
    db_disconnect($db); 
?>