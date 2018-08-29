<?php
    session_start(); 
    define("PATH", dirname(__FILE__) . './includes/');
    require_once (PATH . 'db_connection.php');
    $flag    = 0; 
    $missing  = [];
    $errors   = []; 
    $_SESSION['logged'] = 1;
    if (isset($_POST['submit'])){
        $required = ['username','phone'];  
        require (PATH .'validation.php');
        if(!$flag){
            $db     = db_connect();
            $send  = create_user($username, $phone, $email); 
            if ($send){
                $new_id = mysqli_insert_id($db); 
                header("Location: profile.php?id=$new_id");
                $_SESSION['id'] = $new_id;  
                // echo "<script>confirm('Registeration Successful');</script>";
            }else{
                echo mysqli_error($db);
                db_disconnect($db); 
                exit; 
            }
        }        
    }
?>
<!doctype html>
<html>
<head>
    <title>Register</title>
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
                        <?php if($flag && in_array('username', $missing)){
                                echo '<p class="error">Required field</p>';
                            }elseif($flag && in_array('username', $errors)){
                                echo '<p class="error">Invalid name</p>';
                            }
                        ?>
                    </label>
                    <input type="text" placeholder="example: ِAhmed Yasser " name="username"
                        <?php if($flag): 
                            echo 'value="' . htmlentities($username) . '"';
                            endif;  
                        ?>
                    >
                    
                    <label>Your Phone Number:
                        <?php if($flag && in_array('phone', $missing)){
                                echo '<p class="error">Required field</p>';
                            }elseif($flag && in_array('phone', $errors)){
                                echo '<p class="error">Invalid Phone number</p>';
                            }
                        ?>
                    </label>
                    <input type="text" placeholder="010**********" name="phone"
                        <?php if($flag): 
                            echo 'value="' . htmlentities($phone) . '"';
                            endif; 
                        ?>
                    >

                    <label>Your Email:
                        <?php if($flag && in_array('email', $errors)){
                            echo '<p class="error">Invalid Email</p>';
                        }?>
                    </label>
                    <input type="email" placeholder="ahmed@gmail.com" name="email"
                        <?php if($flag): 
                            echo 'value="' . htmlentities($email) . '"';
                            endif; 
                        ?>
                    > 


                    <input class="btn1" type="submit" name="submit" value="Register" data-toggle="modal" data-target="#myModal">
                </form>
            </div>
        </div>
    </div>
    
    
    
                    <!--///////////////////// MODAL \\\\\\\\\\\\\\\\\\\\-->
    
<!--
   <div class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            
          <div class="modal-header">
                <h4 class="modal-title">THANK YOU</h4>
          </div>
          
          <div class="modal-body">
            
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            <button type="button" class="btn btn-primary">Save as PDF</button>
          </div>
        </div>
      </div>
    </div>
-->

    
   
    <!--//////////////////////////////////////// end of Form \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
    
      <!--/////////////////////////////////////////// footer \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->

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