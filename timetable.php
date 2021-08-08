<html>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 

    <style>
        body {
            font-size: 28px;
            background-color:#f5f5f5;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #181F44;
            position: -webkit-sticky; /* Safari */
            position: sticky;
            top: 0;
            
        }
        li {
            float: left;
        }
        ul img{
               
                max-width: 60%;
                margin-left:30px;
        }
        li a {
        
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            padding:   31px 20px;
        }

        li a:hover {
            background-color: #D2544A;
           padding:   31px 20px;
          
        }

        .active {
            
            background-color: #CD4236;
        }
    </style>
</head>
<body>
    
    <ul>
        <li><img src="https://raw.githubusercontent.com/DeminDivasandABlueDot/inFor/main/img/infor%20header%20(1).png" alt="alt"/></li>
        <li><a class="active" href="timetable.php">Timetable</a></li>
            <?php
            session_start();
            if ($_SESSION['state'] == 0) {
                ?>
            <li><a href="SMarksDD.php">Marks</a></li>
            <?php } else {
            ?>
            <li><a href="TMarksDD.php">Marks</a></li>
            
    <?php } ?>
                <button onclick="index.php" class="btn btn-outline-danger btn-lg" style="float:left;margin-left:1100px;margin-top:30px"><a href="index.php" style="color:red">Logout</a></button>
        </ul>
    
      <?php
    $email = $_SESSION['email'];
 
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "infor";
        $db2 = "slatedbs2";
        $con = new mysqli($host, $user, $password, $db);
        $query = mysqli_query($con, "SELECT Name from profile where email='" . $email . "'");
        if (mysqli_num_rows($query) == 1) {
            while ($row = $query->fetch_assoc()) {
                $name=$row["Name"];
            }
        }
        echo"<br><div style='position:relative;left:18vh;'><h1> Hello, ".$name."</h1><br> <h4> This is your schedule:</h4></div>";
    ?>
           
            
        
        
        <?php
        $arr=array();
        $arr[0]="Monday"; $arr[1]="Tuesday"; $arr[2]="Wednesday"; $arr[3]="Thursday"; $arr[4]="Friday"; $arr[5]="Saturday";
     
        $con = new mysqli($host, $user, $password, $db);
        $con2 = new mysqli($host, $user, $password, $db);
        $query = mysqli_query($con, "SELECT TeachID, Dept, Sem, Sec from profile where email='" . $email . "'");
        if (mysqli_num_rows($query) == 1) {
            while ($row = $query->fetch_assoc()) {
                $TeachID = $row["TeachID"]; //"CS001" 
                $out = "<table class='table table-striped table-bordered' style='max-width:80%;position:relative;left:9%;top:2vh;'>";
                $out .= "<tr style='background-color:#181F44;color:white;'><th scope='col'>Day</th><th scope='col'>1st Hour</th><th scope='col'>2nd Hour</th><th scope='col'>Short Break</th><th scope='col'>3rd Hour</th><th scope='col'>4th Hour</th><th scope='col'>Lunch Break</th><th scope='col'>5th Hour</th><th scope='col'>6th Hour</th></tr>";

                if (is_null($TeachID)) {
                    $Dept = $row['Dept'];
                    $Sem = $row['Sem'];
                    $Sec = $row['Sec'];

                    for ($i = 0; $i < 6; $i++) {
                        $out .= "<tr class='col'>";
                        for ($j = -1; $j < 6; $j++) {
                            if ($j == 2 || $j == 4) {
                                $out .= "<td></td>";
                            }
                            if($j==-1)
                            {
                                $out.="<td style='background-color:#181F44;color:white'>".$arr[$i]."</td>";
                            }
                            else{
                            $q = mysqli_query($con2, "Select s.SubName, ts.SubID from timeslots ts, subjects s where (ts.SubID=s.SubID or ts.SubID='18CSE46') and ts.Semester=" . $Sem . " and ts.Section='" . $Sec . "' and ts.Department='" . $Dept . "' and ts.Hour=" . $j . " and ts.Day=" . $i . " limit 1");
                            if (mysqli_num_rows($q) > 0) {
                                while ($row0 = $q->fetch_assoc()) {
                                    if ($row0['SubID'] == "18CSE46") {
                                        $out .= "<td>Program Elective</td>";
                                    } else {
                                        $out .= "<td>" . $row0["SubName"] . "</td>";
                                    }
                                }
                            } else {
                                $out .= "<td></td>";
                            }
                            }
                        }
                        $out .= "</tr>";
                    }
                    $out .= "</table> ";
                } else {




                    for ($i = 0; $i < 6; $i++) {
                        $out .= "<tr class='col'>";
                        for ($j = -1; $j < 6; $j++) {
                            if ($j == 2 || $j == 4) {
                                $out .= "<td></td>";
                            }
                             if($j==-1)
                            {
                                $out.="<td style='background-color:#181F44;color:white'>".$arr[$i]."</td>";
                            }
                            else{
                            $q = mysqli_query($con2, "Select s.SubName, ts.Semester, ts.Section, ts.Department, ts.SubID "
                                    . "from timeslots ts, subjects s "
                                    . " where (ts.SubID=s.SubID) and ts.TeachID='".$TeachID."' and ts.Hour=".$j." and ts.Day=".$i." ");
                            if (mysqli_num_rows($q) > 0) {
                                while ($row0 = $q->fetch_assoc()) {
                                    if ($row0['SubID'] == "18CSE46") {
                                        $out .= "<td>Program Elective</td>";
                                        break;
                                    } else if ($row0['SubID'] == "18CSL48") {
                                     $out .= "<td colspan='2' >" . $row0["SubName"] . "--" . $row0["Department"] . " " . $row0["Semester"] . " Sem " . $row0["Section"] . " Sec </td>";
                                    $j++;
                                    }
                                    else{
                                  
                                        $out .= "<td>" . $row0["SubName"] . "--" . $row0["Department"] . " " . $row0["Semester"] . " Sem " . $row0["Section"] . " Sec </td>";
                                        break;
                                    }
                                   
                                }
                            } else {
                                $out .= "<td></td>";
                            }
                            }
                        }
                        $out .= "</tr>";
                    }
                    $out .= "</table>";
                }
                print_r($out);
            }
        }
        ?>
   </body>
</html>