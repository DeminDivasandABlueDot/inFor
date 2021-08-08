<?php include 'connection.php'?>
<?php error_reporting(E_ERROR | E_PARSE); ?>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 

    <style>
         th {
            background-color: #222c5d;
            color: white;
        } 
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
            z-index:10;
            
        }
        li {
            font-size: 28px;
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
        <li><img src="https://raw.githubusercontent.com/DeminDivasandABlueDot/inFor/main/img/infor%20header%20(1).png" alt="alt"/></li>\
        <li><a  href="timetable.php">Timetable</a></li>
            <?php
            session_start();
            if ($_SESSION['state'] == 0) {
                ?>
            <li><a class="active" href="SMarksDD.php">Marks</a></li>
            <?php } else {
            ?>
            <li><a class="active" href="TMarksDD.php">Marks</a></li>
    <?php } ?>
            <button onclick="index.php" class="btn btn-outline-danger btn-lg" style="float:left;margin-left:1100px;margin-top:30px"><a href="index.php" style="color:red">Logout</a></button>
    </ul>

    <center>
        <div  class="d-flex justify-content-between" style="position:relative;display:inline-block;padding-left:25%;text-align:center;padding-top:50px;">
    <form method = "POST" action="#" id="DropM" style="display:block;" >
        <h3> Your Classes:</h3>
                    <?php
                    session_start();
                    $sql="SELECT *, CONCAT(Department, Sem, Section, '-', SubID) as classes FROM teacherallo where TeachID = '".$_SESSION['tid']."'";
           
                    $res = mysqli_query($con,$sql);
                    
                    echo"<div style='max-width:50vw;;text-align:center;'>";
                   echo '<select id="cselect" name="class" class="form-control"  value="-1">';
                    echo "<option value ='-1' style='width:50vw;' >"."---SELECT---"."</option>";
                    while ($row = $res->fetch_assoc()) { 
                        echo "<option value= '". $row['classes'] ."'> ".$row['classes']." </option>";            
                    }
                    echo '</select>';
                    echo"</div>"
                    . "<br>";
                    ?>
                    <div id="mDisplay" style="">
                        <?php
                                $sql="SELECT s.SubName, ts.Department, ts.Sem, ts.Section FROM teacherallo ts, subjects s where ts.TeachID='".$_SESSION['tid']."' and ts.SubID=s.SubID ";
                                echo"<h2> Subject list: </h2> <table  class='table table-striped table-bordered' style='max-width:100%;'> <tr> <th>Subject Name </th><th> Department </th><th> Sem </th><th> Section </th> </tr>";
                                $res = mysqli_query($con,$sql);
                                 while ($row = $res->fetch_assoc()) {
                                    echo"<tr>";
                                    echo"<td>".$row["SubName"]."</td>";
                                    echo"<td>".$row["Department"]."</td>";
                                    echo"<td>".$row["Sem"]."</td>";
                                    echo"<td>".$row["Section"]."</td>";
                                    echo"</tr>";
                                 }
                                 echo"</table>";
                            ?>
                    </div>
                    <input type="submit" class="btn btn-primary" value="download" formaction="download.php" formmethod="post" style="background-color:#222c5d;">
		</form>
       
    <script>
                            $(function(){
                             $("#DropM").on('change','select', function(ev) {
                               var x = $('#cselect').val();
                               $.ajax({url:'uploadmarks.php',data:"class="+x, type:'POST' ,success:function(result) {
                                 $("#mDisplay").html(result);
                             }});
                           
                                  
                             });
                            });
                               
                      </script>  
         
                         </div>
</center>
</div>
    </body>
</html>

