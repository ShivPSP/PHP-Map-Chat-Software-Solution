<?php require_once './member.secure.php';?>
<?php 
    $status = 0;
    if(isset($_POST['submit'])){
        $status = 1;
    }
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Unisoft Technologies</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="../css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php require_once './header.inc.php'; ?>
    <?php require_once './menu.inc.php'; ?>
    <div id="content">
        <div id="left">
            <form action="search_student.php" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>Roll Number : </td>
                        <td><input type="text" name="roll_number" required /></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="center">
                            <input type="submit" name="submit" value="Get Details" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
            <?php if($status==1) {
                $roll_number = $_POST['roll_number'];    
                require_once '../db_connect.php';
                $query = "select * from students where roll_number = $roll_number";
                $result = mysql_query($query);
                if(mysql_num_rows($result)>0) { 
                    $row = mysql_fetch_assoc($result);
            ?>
        <table>
                <tbody>
                    <tr>
                        <td>Roll Number : </td>
                        <td><?php echo $row['roll_number'];  ?></td>
                    </tr>
                    <tr>
                        <td>Name : </td>
                        <td><?php echo $row['name'];  ?></td>
                    </tr>
                    <tr>
                        <td>Gender : </td>
                        <td><?php echo $row['gender'];  ?></td>
                    </tr>
                    <tr>
                        <td>Email ID : </td>
                        <td><?php echo $row['email'];  ?></td>
                    </tr>
                    <tr>
                        <td>Mobile Number : </td>
                        <td><?php echo $row['mobile_number'];  ?></td>
                    </tr>
                    <tr>
                        <td>Course : </td>
                        <td><?php echo $row['course'];  ?></td>
                    </tr>
                </tbody>
            </table>

        <?php } else { ?>
        <h3 class="error">Error !! The record does not exist.</h3>
            <?php } } ?>
        </div>
    </div>
    <?php require_once './footer.inc.php'; ?>
</body>
</html>
