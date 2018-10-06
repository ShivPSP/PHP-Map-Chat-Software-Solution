<?php
    function get_current_time(){
        $d = time();
        $str = date('d_m_Y_h_i_s_a',$d);
        return $str;
        
    }
    
    function get_file_name(){
        $str ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str  = str_shuffle($str);
        $str = substr($str, 1, 20);
        return $str;
    }
    
    function get_ext_name($file_name){
        $i = strpos($file_name, '.');
        $str = substr($file_name, $i);
        return $str;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_type = $_FILES['photo']['type'];
    $tmp_location = $_FILES['photo']['tmp_name'];   //temp location of file on the server
    //$str = get_current_time();
    //move_uploaded_file($tmp_location, 'uploads/'.$str)
    
    /*To format date for mysql */
    
    $dob = strtotime($date_of_birth);
    $mysqldob = date('Y-m-d',$dob);
    
    $new_name = get_file_name();
    $ext_name = get_ext_name($file_name);
    $photo = $new_name.$ext_name;
    move_uploaded_file($tmp_location, 'uploads/'.$photo)
?>
<?php
mysql_connect('localhost','root','');
mysql_select_db('unisoft');
$query="insert into uploads values('$name','$email','$mysqldob','$photo')";
$mysql_close;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h2>Name : <?php echo $name;?></h2>
        <h2>Email : <?php echo $email;?></h2>
        <h2>Date Of Birth : <?php echo $mysqldob;?></h2>
        <h2>File Name : <?php echo $file_name;?></h2>
        <h2>Size : <?php echo round($file_size/1024,2);?> KB</h2>
        <h2>Type : <?php echo $file_type;?></h2>
        <h2>Temp Location : <?php echo $tmp_location;?></h2>
    </body>
</html>
