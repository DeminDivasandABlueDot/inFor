<?php include 'connection.php'?>
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
           color:white;
          
        }

        .active {
            
            background-color: #CD4236;
        }
    </style>
</head>
<body style="background-color:#EEEEEE">
    <div style="font-size: 28px;">
    <ul>
        <li><img src="https://raw.githubusercontent.com/DeminDivasandABlueDot/inFor/main/img/infor%20header%20(1).png" alt="alt"/></li>
        <li><a  href="timetable.php">Timetable</a></li>
            <?php
            session_start();
            if ($_SESSION['state'] == 0) {
                ?>
            <li><a class="active" href="SMarksDD.php">Marks</a></li>
            <?php } else {
            ?>
            <li><a  href="TMarksDD.php">Marks</a></li>
    <?php } ?>
           
                <button onclick="index.php" class="btn btn-outline-danger btn-lg" style="float:left;margin-left:1100px;margin-top:30px"><a href="index.php" style="color:red">Logout</a></button>
        </ul>
    </div>
<div  align="center">
                <form method = "POST" action="#" id="DropD" >
                    <h3>Semester:</h3>
                    <?php
                    session_start();
                    $sql="SELECT Sem as s FROM marks WHERE USN='".$_SESSION['usn']."' GROUP BY Sem";
                    $res = mysqli_query($con,$sql);
                    
                    echo '<select id="semselect" name="sem" class="form-control" style="max-width: 15%">';
                    echo "<option value= '-1'  >"."Overall"."</option>";
                   
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<option value='". $row['s'] ."'>".$row['s']."</option>";
                    }
                    echo '</select>';
                    ?>
                    <div id="mDisplay">
                        <?php include 'marks.php'?> 
                         <script>
                            $(function(){
                             $("#DropD").on('change','select', function(ev) {
                               var x = $('#semselect').val();
                               $.ajax({url:'marks.php',data:"sem="+x, type:'POST' ,success:function(result) {
                                 $("#mDisplay").html(result);
                             }});
                             });
                            });
                         </script>   
                    </div>
		</form>
     <?php
      if(isset($_POST['submit'])){
        if(!empty($_POST['sem'])) {
          $_SESSION['sem'] = $_POST['sem'];
      }
      }
    ?>
</div>
</body>
</html>