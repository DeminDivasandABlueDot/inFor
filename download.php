<?php
include 'connection.php';

 // Title of the CSV
session_start();
        $Content = "USN,Sem,SubID,Credit,Subname,MSE1,MSE2,MSE3,LA1,LA2,SEE_Grade\n";
        
            // Get member row
            $fn= $_POST['class'];
            $class_sub = $_POST['class'];
            $class = substr($class_sub, 0, strpos($class_sub, '-'));
            $subid= substr($class_sub, strpos($class_sub, '-')+1, strlen($class_sub)-1);
            $_SESSION['class']= $class;
            $_SESSION['subid']= $subid;
            //$sq = "SELECT * FROM marks WHERE SubID = '".$subid."' and USN= (SELECT USN from profile where CONCAT(Dept,Sem,Sec)= '".$class."')";
            $sq="SELECT USN,Name from profile where CONCAT(Dept,Sem,Sec)= '".$class."'";
            $result = mysqli_query($con, $sq); 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 
                        $USN=$row['USN'];
                        $sql = mysqli_query($con,"SELECT * FROM marks WHERE SubID = '".$subid."' and USN= '".$row['USN']."'"); 
                        if($sql->num_rows >0){
                            while($row1 = $sql->fetch_assoc()){
                                $usn = $row1['USN'];
                                $name = $row['Name'];
                                $sem = $row1['Sem'];
                                $subid = $row1['SubID'];
                                $cre = $row1['credit'];
                                $sname = $row1['Subname'];
                                $m1 = $row1['MSE1'];
                                $m2 = $row1['MSE2'];
                                $m3 = $row1['MSE3'];
                                $la1 = $row1['LA1'];
                                $la2 = $row1['LA2'];
                                $see = $row1['SEE_Grade'];
                                
                                $Content .= $USN.",".$sem.",".$subid.",".$cre.",".$sname.",".$m1.",".$m2.",".$m3.",".$la1.",".$la2.",".$see."\n";
                   }
                        }
                     }
            }                 
//$query= mysqli_query($con,"Select *, CONCAT(Department,Sem,Section) as class from  where SubID = '".$_SESSION['subid']."' and ");//add dept sem sec where clauses
//echo $query;
//if(mysqli_num_rows($query)>0){  
//while($row0 = $query->fetch_assoc()){
//        $USN=$row0["USN"];
//        $name=$row0["Name"];
//        $fn = $row0['class']; 
//        //all other values of marks too
//
//    //if no errors carry on
//
//        //set the data of the CSV
//        $Content .= $USN.",".$name."\n";
//    }
//}
        //set the file name and create CSV file
        $FileName = $fn."-".date("d-m-y-h:i:s").".csv";
        header('Content-Type: application/csv'); 
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); 
        echo $Content;
        exit();


//if their are errors display them
if(isset($error)){
    foreach($error as $error){
        echo '<p style="color:#ff0000">$error</p>';
    }
}
?>

