<?php require_once './member.secure.php';?>
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
            <h2> Welcome Client !!<?php echo  $_SESSION['name']; ?> </h2>
            <hr>
            <ul>
                <li><a href="mapchat2.html">Open the map </a></li>
                <li><a href="geocode.html">Get your Location Details </a></li>
                <li><a href="../chatclient.html">Click to Chat</a></li>
            </ul>
            
        </div>
    </div>
    <?php require_once './footer.inc.php'; ?>
</body>
</html>
