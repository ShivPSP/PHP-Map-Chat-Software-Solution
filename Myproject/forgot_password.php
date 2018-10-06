<?php
    function generate_password() {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $str = substr($str, 1, 8);
        return $str;
    }
    $status = 0;
    $template = 1;
    $email = "";
    $question = "";
    $answer = "";
    $passwd = "";
    if(isset($_POST['submit'])){
        require_once './db_connect.php';
        $form = $_POST['form'];
        if($form==1){
            $email = $_POST['email'];
            $query = "select question from users where email='$email'";
            $result = mysql_query($query);
            if(mysql_num_rows($result)==1){
                $row = mysql_fetch_assoc($result);
                $question = $row['question'];
                $template = 2;
            }else{
                $status = 1;
            }
        }
        else if($form==2){
            $email = $_POST['email'];
            $question = $_POST['question'];
            $answer = $_POST['answer'];
            $query = "select * from users where email='$email' and answer='$answer'";
            $result = mysql_query($query);
            if(mysql_num_rows($result)==1){
                $passwd = generate_password();
                $password = sha1($passwd);
                $query = "update users set password='$password' where email='$email'";
                mysql_query($query);
                $template = 3;
            }else{
                $template = 2;
                $status = 2;
            }
        }
    }
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Unisoft Technologies</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php require_once './header.inc.php'; ?>
    <?php require_once './menu.inc.php'; ?>
    <div id="content">
        <div id="left">
            <h2>Forgot Password</h2>
            <?php if($template==1) { ?>
            <form action="forgot_password.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>Email Id : </td>
                            <td><input type="text" name="email" required /></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="center">
                                <input type="submit" name="submit" value="Submit" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="form" value="1" />
            </form> 
            <?php } ?>
            <?php if($status==1) { ?>
            <h3 class="error">This email id does not exist.</h3>
            <?php } ?>
            <?php if($template==2) { ?>
            <form action="forgot_password.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>Email Id : </td>
                            <td><input readonly type="text" name="email" value="<?php echo $email;?>" /></td>
                        </tr>
                        <tr>
                            <td>Question : </td>
                            <td><input readonly type="text" name="question" value="<?php echo $question;?>" /></td>
                        </tr>
                        <tr>
                            <td>Answer : </td>
                            <td><input type="text" name="answer"  /></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="center">
                                <input type="submit" name="submit" value="Submit" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="form" value="2" />
            </form> 
            <?php } ?>
            <?php if($status==2) { ?>
            <h3 class="error">This given answer is Incorrect.</h3>
            <?php } ?>
            <?php if($template==3) { ?>
            <h3>Your password has been reset : <?php echo $passwd;?></h3>
            <h3>An email has been sent to your email ID <?php echo $email;?></h3>
             <p>click <a href="login.php">here</a> to Login</p>   
            <?php } ?>
        </div>
    </div>
    <?php require_once './footer.inc.php'; ?>
</body>
</html>
