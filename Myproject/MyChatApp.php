<?php
$name =$_REQUEST['name'];
$email=$_REQUEST['email'];
$role=$_REQUEST['role'];
$chatmsg=$_REQUEST['chatmsg'];

 mysql_connect('localhost','root','');
 mysql_select_db('unisoft');
 $query="select * from users where email=$email";
 $result= mysql_query($query);
 if(mysql_num_rows($result)==0){
     header('location: ./register.php');
 }else{
     require_once './db_connect.php';
     $queryC= "insert into chat values('name','email','role','chatmsg')";
       
 }
?>

