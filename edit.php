<?php 
    session_start();
    define("PATH", dirname(__FILE__) . './includes/');
    require_once (PATH . 'db_connection.php');
    // $_SESSION['id'] = isset($_GET['id'])? $_GET['id'] : '2';
    $db     = db_connect();
    $user   = find_user($_SESSION['id']);
    $flag    = 0; 
    $missing  = [];
    $errors   = []; 
    if (isset($_POST['submit'])){
        $required = ['username','phone'];  
        require (PATH .'validation.php');
        if(!$flag){
            $user               = []; 
            $user['id']         = $_SESSION['id'];
            $user['username']   = $username; 
            $user['phone']      = $phone; 
            $user['email']      = $email; 
            $update  = update_user($user); 
        }        
    }
?>
<!doctype html>
<html>
<head>
    <title>EDIT PROFILE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    
     <!--////////////////////////////////////////// Form \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
     <div class="content">
        <div class="container">
            <div class="row">
            
                <form class="col-md-12" method="post" action="<?= $_SERVER['PHP_SELF'] ?>"> 
                
                    <label>Your Name:
                        <?php if($_POST && $flag && in_array('username', $missing)){
                                echo '<p class="error">Required field</p>';
                            }elseif($_POST && $flag && in_array('username', $errors)){
                                echo '<p class="error">Invalid name</p>';
                            }
                        ?> 
                    </label>
                    <input type="text" placeholder="example: ِAhmed Yasser " name="username"
                        <?php if($_POST && $flag){ 
                            echo 'value="' . htmlentities($username) . '"';
                           }else{
                            echo 'value="' . $user['username'] . '"';
                           } 
                        ?>>


                    <label>Your Phone Number:
                        <?php if($_POST && $flag && in_array('phone', $missing)){
                                echo '<p class="error">Required field</p>';
                            }elseif($_POST && $flag && in_array('phone', $errors)){
                                echo '<p class="error">Invalid phone number</p>';
                            }
                        ?>     
                    </label>
                    <input type="text" placeholder="010**********" name="phone"
                        <?php if($_POST && $flag){ 
                            echo 'value="' . htmlentities($phone) . '"';
                           }else{
                            echo 'value="' . $user['phone'] . '"';
                           } 
                        ?>   
                    >


                    <label>Your Email:
                        <?php if($_POST && $flag && in_array('email', $errors)){
                            echo '<p class="error">Invalid Email</p>';
                        }?>     
                    </label>
                    <input type="email" placeholder="ahmed@gmail.com" name="email"
                        <?php if($_POST && $flag){ 
                                echo 'value="' . htmlentities($email) . '"';
                            }else{
                                echo 'value="' . $user['email'] . '"';   
                            } 
                        ?>    
                    > 


                    <input class="btn1" type="submit" name="submit" value="Save Changes">
                </form>
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
