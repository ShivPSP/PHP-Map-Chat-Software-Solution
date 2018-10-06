<?php require_once './admin.secure.php';?>
<?php
    require_once '../db_connect.php';
    $query = "select * from users order by email";
    $result = mysql_query($query);    
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Map Chat Portal</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="../css/default.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php require_once './header.inc.php'; ?>
    <?php require_once './menu.inc.php'; ?>
    <div id="content">
        <div id="left">
        <?php if(mysql_num_rows($result)==0) { ?>
            <h3 class="error">Error !! No Record Found.</h3>
        <?php } else { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Email ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>password</th>
                    <th>question</th>
                    <th>answer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysql_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['email'];  ?></td>
                    <td><?php echo $row['name'];  ?></td>
                    <td><?php echo $row['role'];  ?></td>
                    <td><?php echo $row['password'];  ?></td>
                    <td><?php echo $row['question'];  ?></td>
                    <td><?php echo $row['answer'];  ?></td>
                    <td>
                        <a href="edit_student.php?roll_number=<?php echo $row['roll_number'];  ?>" title="Edit Record"><img src="../images/edit.png" alt=""/></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a onclick="return confirm('Delete this record')" href="delete_student.php?roll_number=<?php echo $row['roll_number'];  ?>" title="Delete Record"><img src="../images/delete.png" alt=""/></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>            
        </div>
    </div>
    <?php require_once './footer.inc.php'; ?>
</body>
</html>
