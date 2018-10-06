<?php require_once './admin.secure.php';?>
<?php   
    $ip = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Map Chat Portal</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="../css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php require_once './header.inc.php'; ?>
    <?php require_once './menu.inc.php'; ?>
    <div id="content">
        <div id="left">
            <h2>Change Password Form</h2>
            <form action="change_password.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>Current Password : </td>
                            <td><input type="password" name="current_password"  required /></td>
                        </tr>
                        <tr>
                            <td>New Password : </td>
                            <td><input type="password" name="new_password"  required /></td>
                        </tr>
                        <tr>
                            <td>Confirm Password : </td>
                            <td><input type="password" name="confirm_password"  required /></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="center">
                                <input type="submit" name="submit" value="Update Password" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>            
        </div>
    </div>
    <?php require_once './footer.inc.php'; ?>
</body>
</html>
