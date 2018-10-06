<?php
    $status = 0;
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        
        require_once './db_connect.php';
        $query = "select * from users where email='$email' and password='$password'";
        
        $result = mysql_query($query);
        if(mysql_num_rows($result)==1){
            $row = mysql_fetch_assoc($result);
            if($row['verified']==0){
                $status = 2;
            }else{
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['name'] = $row['name'];
                if($row['role']=='admin'){
                    header('Location: admin/index.php');
                }else{
                    header('Location: member/index.php');
                }
            }
        }else{
            $status=1;
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Map Chat Portal : login</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php require_once './header.inc.php'; ?>
    <?php require_once './menu.inc.php'; ?>
    <div id="content">
        <div id="left">
            <h2>Login Form</h2>
            <form action="login.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>Email Id : </td>
                            <td><input type="text" name="email" value="" required /></td>
                        </tr>
                        <tr>
                            <td>Password : </td>
                            <td><input type="password" name="password" value="" required /></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="center">
                                <input type="submit" name="submit" value="Login" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php if($status==1) { ?>
            <h3 class="error">Your email id or password is Incorrect</h3>
            <?php } ?>
            <?php if($status==2) { ?>
            <h3 class="error">Your email id is not yet verified</h3>
            <?php } ?>
            <br><br>
            <a href="forgot_password.php">Forgot Password</a>
        </div>
    </div>
    <?php require_once './footer.inc.php'; ?>
</body>
</html>
