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
//Getting the count of the records for that USN and Sem
$sql0 = "SELECT COUNT(*) as count FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4";
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
//getting the highest MSE score but since this would give us multiple values, we use limit 1 which doesn't help
$sql = "SELECT GREATEST(MSE1,MSE2,MSE3) as m1 FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4 limit 1";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res)==1){
    while($row = $res->fetch_assoc()){
        $mse1= $row['m1']; //value of highest MSE
    }
}
//getting the lowest MSE score but since this would give us multiple values, we use limit 1 which doesn't help
$sqll = "SELECT LEAST(MSE1,MSE2,MSE3) as low FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4 limit 1";
$ress = mysqli_query($con,$sqll);
if(mysqli_num_rows($ress)==1){
    while($row1 = $ress->fetch_assoc()){
        $low= $row1['low']; //value of lowest MSE
    }
}
//getting MSE1 score to find second best MSE score
$sq1 = mysqli_query($con, "SELECT MSE1 as v1 from marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4 limit 1");
if(mysqli_num_rows($sq1)==1){
    while($r = $sq1->fetch_assoc()){
        $val1= $r['v1']; //value of MSE1
    }
}
//getting MSE2 score to find second best MSE score
$sq2 = mysqli_query($con, "SELECT MSE2 as v2 from marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4 limit 1");
if(mysqli_num_rows($sq2)==1){
    while($r = $sq2->fetch_assoc()){
        $val2= $r['v2']; //value of MSE2
    }
}
//getting MSE3 score to find second best MSE score
$sq3 = mysqli_query($con, "SELECT MSE3 as v3 from marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4 limit 1");
if(mysqli_num_rows($sq3)==1){
    while($r = $sq3->fetch_assoc()){
        $val3= $r['v3']; //value of MSE3
    }
}
//checking if MSE1 is the second best score
if(($val1 < $mse1) && ($val1 > $low)){
 $m2 ='MSE1'; //setting the second best score column as MSE1
}
//checking if MSE2 is the second best score
if(($val2 < $mse1) && ($val2 > $low)){
$m2 ='MSE2'; //setting the second best score column as MSE2
}
//checking if MSE3 is the second best score
if(($val3 < $mse1) && ($val3 > $low)){
 $m2 ='MSE3'; //setting the second best score column as MSE3
}
//to find which MSE score is the highest
if($val1 == $mse1){
     $m1='MSE1'; //setting MSE1 as the highest score column
 }
if($val2 == $mse1){
     $m1='MSE2'; //setting MSE1 as the highest score column
 }
if($val3 == $mse1){
     $m1='MSE3'; //setting MSE1 as the highest score column
 }
//yes, all of that to find the best of 2 MSEs. 

//query to calc CIE
$sql1="SELECT *, (($m1 + $m2)/2 + LA1+ LA2)AS cie FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4";
echo $sql1;
$res1= mysqli_query($con,$sql1);
//query to calc gradept
$sql2="SELECT (credit*SEE_Grade)as gp FROM marks WHERE USN= '".$_SESSION['usn']."' and Sem = 4";
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
$sql3 = "UPDATE marks SET CIE = ".$cieval.", Gradept = ".$gpval." WHERE USN = '".$_SESSION['usn']."' and Sem = 4";
$res3 =mysqli_query($con,$sql3);
//print to check the values calculated
$sql4 = "SELECT CIE as cie, Gradept as gp from marks WHERE USN= '".$_SESSION['usn']."' and Sem= 4";
$print = mysqli_query($con,$sql4);

if($print){
    echo "<table><tr><th> CIE </th><th>GP</th></tr>";
    while($row = $print->fetch_assoc()){
        echo "<tr><td>".$row['cie']."</td><td>".$row['gp']."</td></tr>";
    }
    echo "</table>";
}
else{
    echo "0 results";
}
//increase check to go to next record
$check++;
}
?>
</body>
</html>

