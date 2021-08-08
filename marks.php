<?php include 'links.php'?>
<?php include 'connection.php'?>
<?php include 'calcmarks.php'?>
<html>
<head>
    <title> Infor Marks</title>
<style>
            th {
            background-color: #222c5d;
            color: white;
        } 

table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body style="background-color:#EEEEEE">  
 <div align="center">
<?php
$semval = $_POST['sem'];
if(is_null($semval)){
    $semval = -1;
}
$query= mysqli_query($con,"SELECT MAX(Sem) as maxsem, MIN(Sem) as minsem FROM marks WHERE USN= '".$_SESSION['usn']."'");
if(mysqli_num_rows($query)==1){
    while($row0 = $query->fetch_assoc()){
        $_SESSION['maxsem']= $row0['maxsem']; //max sem for overall
        $minsem = $row0['minsem'];
    }
}

$cgpa = mysqli_query($con,"SELECT CGPA FROM gpa WHERE USN = '".$_SESSION['usn']."' AND Sem = ".$maxsem." limit 1");
        if( mysqli_num_rows($cgpa) > 0){
            while($rows = $cgpa->fetch_assoc()){
            echo "<br><h4>CGPA = ".$rows['CGPA']."</h4>";
        }
        }
if($semval== -1){
    $semval = $minsem;
    while($semval <= $_SESSION['maxsem']){
        $sgpa = mysqli_query($con,"SELECT SGPA FROM gpa WHERE Sem = ".$semval." AND USN = '".$_SESSION['usn']."' limit 1");
        if( mysqli_num_rows($sgpa) > 0){
            while($rows = $sgpa->fetch_assoc()){
            echo "<h5><br>SGPA = ".$rows['SGPA']."</h5>";
        }
        }
        $marksval1 = "SELECT * FROM marks WHERE Sem = ".$semval." AND USN = '".$_SESSION['usn']."'";
        $result1= mysqli_query($con,$marksval1);
        if( mysqli_num_rows($result1) > 0){
            echo " <table class= 'table table-striped table-bordered' style= 'max-width: 75%'>"
          
            . "<tr>"
                    . "<th> Semester </th>"
                    . "<th> Subject Name </th>"
                    . "<th> MSE1</th>"
                    . "<th> MSE2</th>"
                    . "<th> MSE3</th>"
                    . "<th> LA1</th>"
                    . "<th> LA2</th>"
                    . "<th> CIE</th>"
                    . "<th> GRADE</th>"
                    . "<th> GRADE POINT</th>"
            . "</tr>"
            . "</thead>"        ;
            while($row = $result1->fetch_assoc()){
            echo "<tr><td>".$row['Sem']."</td><td>".$row['Subname']."</td><td>".$row['MSE1']."</td><td>".$row['MSE2']."</td><td>".$row['MSE3']."</td><td>".$row['LA1']."</td><td>".$row['LA2']."</td><td>".$row['CIE']."</td><td>".$row['SEE_Grade']."</td><td>".$row['Gradept']."</td></tr>";
        }
            echo "</table>"
        . "<br>";
           
    }
    $semval++;
    }  

}
else {
    $sgpa = mysqli_query($con,"SELECT SGPA FROM gpa WHERE Sem = ".$semval." AND USN = '".$_SESSION['usn']."' limit 1");
        if( mysqli_num_rows($sgpa) > 0){
            while($rows = $sgpa->fetch_assoc()){
            echo "<h5><br>SGPA = ".$rows['SGPA']."</h5>";
        }
        }
 $marksval = "SELECT * FROM marks WHERE Sem = ".$semval." AND USN = '".$_SESSION['usn']."'";
$result= mysqli_query($con,$marksval);
if($result){
     echo " <table class= 'table table-striped table-bordered' style= 'max-width: 75%'>"
          
            . "<tr>"
                    . "<th> Semester </th>"
                    . "<th> Subject Name </th>"
                    . "<th> MSE1</th>"
                    . "<th> MSE2</th>"
                    . "<th> MSE3</th>"
                    . "<th> LA1</th>"
                    . "<th> LA2</th>"
                    . "<th> CIE</th>"
                    . "<th> GRADE</th>"
                    . "<th> GRADE POINT</th>"
            . "</tr>"
            . "</thead>"  ;
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row['Sem']."</td><td>".$row['Subname']."</td><td>".$row['MSE1']."</td><td>".$row['MSE2']."</td><td>".$row['MSE3']."</td><td>".$row['LA1']."</td><td>".$row['LA2']."</td><td>".$row['CIE']."</td><td>".$row['SEE_Grade']."</td><td>".$row['Gradept']."</td></tr>";
    }
    echo "</table>";
}
else{
    echo " Hang in there, buddy. You'll get it. ";
}   
}
?>
    </div>
</body>
</html>