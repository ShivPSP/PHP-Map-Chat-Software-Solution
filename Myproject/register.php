<?php

function get_verification_code() {
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = str_shuffle($str);
    $str = substr($str, 1, 20);
    return $str;
}

$status = 0;
$template = 1;
$email = '';
$password = '';
$confirm_password = '';
$name = '';
$question = '';
$answer = '';

$errors = array();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $name = $_POST['name'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    //Stage I -  The form is duly filled.   -   Not Null

    if ($email == '') {
        $errors['email'] = 'Email ID is required';
    }
    if ($password == '') {
        $errors['password'] = 'Password is required';
    }
    if ($name == '') {
        $errors['name'] = 'Name is required';
    }
    if ($question == '') {
        $errors['question'] = 'Question is required';
    }
    if ($answer == '') {
        $errors['answer'] = 'Answer is required';
    }

    //Stage II - The values are valid
    if (count($errors) == 0) {
        if (!preg_match('/^\w+@\w+[.]com+$/', $email)) {
            $errors['email'] = 'Email ID is not valid';
        }
        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }
        if (strlen($confirm_password != $password)) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
        if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
            $errors['name'] = 'Name has some invalid characters';
        }
    }


    //Stage III - The id is unique
    if (count($errors) == 0) {
        require_once './db_connect.php';
        $query = "select * from users where email='$email'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 1) {
            $errors['email'] = 'Email ID alrady exists';
        }
    }

    if (count($errors) == 0) {
        $verification_code = get_verification_code();
        $passwd = sha1($password);
        $query = "insert into users values('$email','$passwd','member','$name','$question','$answer',1,'$verification_code')";
        if (mysql_query($query)) {
            $template = 2;
                        require 'includes/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "shivendrapratap812@gmail.com";
            $mail->Password = "RAna01234@";
            $mail->setFrom('shivendrapratap812@gmail.com', 'Map Chat Portal');
            $mail->addAddress($email, '');
            $mail->Subject = 'Registration Confirmed';
            $message = 'Your Registration is Confirmed'.
                    '<br>Please verify your email by clicking the below link'.
                    '<a href="http://www.ii rs.gov.in.com/verify.php?email='.$email.'&verification_code='.$verification_code.'">Verify Email</a>';
            $mail->msgHTML($message);
            if (!$mail->send()) {
                //echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                //echo "Message sent!";
            }
        } else {
            $status = 1;
        }
    }
}
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Unisoft Technologies : Register</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php require_once './header.inc.php'; ?>
            <?php require_once './menu.inc.php'; ?>
    <div id="content">
        <div id="left">
<?php if ($template == 1) { ?>
                <h2>Registration Form</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <table>
                        <tbody>
                            <tr>
                                <td>Email Id : </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $email; ?>" /><span class="error"> *</span>
                                    <?php if (isset($errors['email'])) { ?>
                                        <span class="error"><?php echo $errors['email']; ?></span>
    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Password : </td>
                                <td>
                                    <input type="password" name="password" value="<?php echo $password; ?>" /><span class="error"> *</span>
                                    <?php if (isset($errors['password'])) { ?>
                                        <span class="error"><?php echo $errors['password']; ?></span>
    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm Password : </td>
                                <td>
                                    <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>" /><span class="error">*</span>
                                    <?php if (isset($errors['confirm_password'])) { ?>
                                        <span class="error"><?php echo $errors['confirm_password']; ?></span>
    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Name : </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $name; ?>" /><span class="error"> *</span>
                                    <?php if (isset($errors['name'])) { ?>
                                        <span class="error"><?php echo $errors['name']; ?></span>
    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Question : </td>
                                <td>
                                    <input type="text" name="question" value="<?php echo $question; ?>" /><span class="error"> *</span>
                                    <?php if (isset($errors['question'])) { ?>
                                        <span class="error"><?php echo $errors['question']; ?></span>
    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Answer : </td>
                                <td>
                                    <input type="text" name="answer" value="<?php echo $answer; ?>" /><span class="error"> *</span>
                                    <?php if (isset($errors['answer'])) { ?>
                                        <span class="error"><?php echo $errors['answer']; ?></span>
    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="center">
                                    <input type="submit" name="submit" value="Register" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php if ($status == 1) { ?>
                    <h3 class="error">Some error has occurred, please try again</h3>
                <?php } ?>
<?php } ?>
<?php if ($template == 2) { ?>
                <h3>Your registration is Complete.</h3>
                <h3>An email has been send to you with a verification link. Please verify you email.</h3>
                <p>click <a href="login.php">here</a> to Login</p>
    <?php } ?>
        </div>
    </div>
<?php require_once './footer.inc.php'; ?>
</body>
</html>
