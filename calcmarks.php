
<?php include 'links.php'?>
<?php include 'connection.php'?>
<html>
<head>
    <title> Infor Marks Calculation</title>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php 
session_start();
$query1= mysqli_query($con,"SELECT MIN(Sem)as minsem, MAX(Sem) as maxsem FROM marks WHERE USN= '".$_SESSION['usn']."'");
if(mysqli_num_rows($query1)==1){
    while($row01 = $query1->fetch_assoc()){
        $minsem= $row01['minsem']; //max sem for overall
        $maxsem= $row01['maxsem']; 
    }
}
$semcheck =  $minsem;
while($semcheck <= $maxsem){
  //Getting the count of the records for that USN and Sem
$sql0 = "SELECT COUNT(*) as count FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = ".$semcheck;
$res0 = mysqli_query($con,$sql0);
//Storing the count in a variable
if(mysqli_num_rows($res0)==1){
    while($row0 = $res0->fetch_assoc()){
        $count= $row0['count']; //count of the no. of records
    }
}
//assiging the check variable to 1
$check = 1;
//traversing through all the records
while ($check <= $count)
{ 
$count=1;

$sq1 = mysqli_query($con, "SELECT SubID, GREATEST(MSE1,MSE2,MSE3) as m1,LEAST(MSE1,MSE2,MSE3) as low , MSE1 as v1, MSE2 as v2, MSE3 as v3 from marks WHERE USN= '".$_SESSION['usn']."' AND Sem = ".$semcheck);
if(mysqli_num_rows($sq1)>0){
    while($r = $sq1->fetch_assoc()){
        $val1= $r['v1']; //value of MSE1
        $val2= $r['v2']; //value of MSE2
        $val3= $r['v3']; //value of MSE3
        $low=$r["low"]; //value of lowest score
        $m1=$r["m1"]; //value of highest score
        //sort score to descending order
        $SubID=$r["SubID"];
        if($val1 < $val2){
            $temp = $val2;
            $val2 = $val1;
            $val1 = $temp;
        }
        if($val1 < $val3){
            $temp = $val3;
            $val3 = $val1;
            $val1 = $temp;
        }
        if($val2 < $val3){
            $temp = $val3;
            $val3 = $val2;
            $val2 = $temp;
        }  
        $sql3 = "UPDATE marks SET traverse=".$count." WHERE USN = '".$_SESSION['usn']."' and Sem = ".$semcheck." and SubID= '$SubID'";
        $count++;
        $res3 =mysqli_query($con,$sql3);
        $sql1="SELECT *, (($val1 + $val2)/2 + LA1+ LA2)AS cie FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = ".$semcheck." and SubID= '$SubID' ";
        $res1= mysqli_query($con,$sql1);
        //query to calc gradept
        $sql2="SELECT (credit*SEE_Grade)as gp FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = ".$semcheck." and SubID= '$SubID' ";
        $res2 = mysqli_query($con, $sql2);
        //to store the calculated CIE value
        if(mysqli_num_rows($res1)>0){
        while($row1 = $res1->fetch_assoc()){
        $cieval= $row1['cie']; //CIE value
            }
        }
        //to store the calculated GP value
        if(mysqli_num_rows($res2)>0){
        while($row2 = $res2->fetch_assoc()){
        $gpval= $row2['gp']; //GP value
        }
        }
        //inputing the calculated CIE and GP value into the database
        $sql3 = "UPDATE marks SET CIE = ".$cieval.", Gradept = ".$gpval." WHERE USN = '".$_SESSION['usn']."' and Sem = ".$semcheck." and SubID= '$SubID' ";
        $res03 = mysqli_query($con,$sql3);
    }
}
$check++;

}

//increase check to go to next record
$semcheck++;
}
?>
<?php 
$query1= mysqli_query($con,"SELECT MIN(Sem)as minsem, MAX(Sem) as maxsem FROM marks WHERE USN= '".$_SESSION['usn']."'");
if(mysqli_num_rows($query1)==1){
    while($row01 = $query1->fetch_assoc()){
        $minsem= $row01['minsem']; //max sem for overall
        $maxsem= $row01['maxsem']; 
    }
}
$semcheck =  $minsem;
while($semcheck <= $maxsem){
 $tgp = mysqli_query($con,"SELECT SUM(Gradept) as total_gp from marks WHERE USN = '".$_SESSION['usn']."' AND  Sem = ".$semcheck." limit 1");
 $tcre = mysqli_query($con,"SELECT SUM(credit) as total_cre from marks WHERE USN = '".$_SESSION['usn']."' AND  Sem = ".$semcheck." limit 1");
 if(mysqli_num_rows($tcre)>0){
        while($row = $tcre->fetch_assoc()){
        $tcreval= $row['total_cre']; //tgp value
            }
        } 
if(mysqli_num_rows($tgp)>0){
        while($row = $tgp->fetch_assoc()){
        $tgpval= $row['total_gp']; //tgp value
            }
        } 
$q= "SELECT *,($tgpval / $tcreval) AS sgpa FROM marks WHERE USN= '".$_SESSION['usn']."' AND Sem = ".$semcheck;
 $sgpa = mysqli_query($con,$q);
 if(mysqli_num_rows($sgpa)>0){
        while($row1 = $sgpa->fetch_assoc()){
        $sgpaval= $row1['sgpa']; //sgpa value
            }
        }
 $cgpa = mysqli_query($con,"SELECT *, (SUM(SGPA)/$maxsem) as cgpa from gpa WHERE USN = '".$_SESSION['usn']."' and Sem <= ".$semcheck);
if(mysqli_num_rows($cgpa)>0){
        while($row1 = $cgpa->fetch_assoc()){
        $cgpaval= $row1['cgpa']; //cgpa value
            }
        }
$lmt = mysqli_query($con, "SELECT Sem from gpa WHERE USN = '".$_SESSION['usn']."' and Sem = ".$semcheck);
if(mysqli_num_rows($lmt)>0){
     mysqli_query($con,"UPDATE gpa SET SGPA = ".$sgpaval.", Tgradept = ".$tgpval.", CGPA = ".$cgpaval." WHERE USN = '".$_SESSION['usn']."' and Sem = ".$semcheck); 
}
else{
    mysqli_query($con,"INSERT into gpa (USN, Sem) SELECT USN, Sem from marks GROUP BY Sem");
    mysqli_query($con,"UPDATE gpa SET SGPA = ".$sgpaval.", Tgradept = ".$tgpval.", CGPA = ".$cgpaval." WHERE USN = '".$_SESSION['usn']."' and Sem = ".$semcheck); 
}


        
$semcheck++;   
}
 
?>
</body>
</html>

