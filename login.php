<?php
$host="localhost";
$user="root";
$password="";
$db="infor";
$db2="slatedbs2";
session_start();
$email=$_POST['email'];
$_SESSION['email']=$_POST['email'];
$pass=$_POST['password'] ;
$con = new mysqli($host,$user,$password,$db);
$con2= new mysqli($host, $user, $password, $db2);
$query= mysqli_query($con,"SELECT TeachID, USN from profile where email='".$email."' and password='".$pass."'");
if(mysqli_num_rows($query)==1){
    while($row = $query->fetch_assoc()){
     
   if(is_null($row["TeachID"]))
   {
       $_SESSION['usn']=$row['USN'];
       $_SESSION['state']=0;
       echo"Student";
        
   }
   else
   {
       $_SESSION['tid']=$row['TeachID'];
       $_SESSION['state']=1;
       echo"teacher";
   }
        header('location: timetable.php');
    }
}
else{
    header('location: index.php');
}