<?php
// Load the database configuration file
include_once 'connection.php';
include_once 'links.php';
$class_sub = $_POST['class'];
$class = substr($class_sub, 0, strpos($class_sub, '-'));
$subid= substr($class_sub, strpos($class_sub, '-')+1, strlen($class_sub)-1);
$_SESSION['class']= $class;
$_SESSION['subid']= $subid;
// Get status message
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if (!empty($statusMsg)) { ?>
    <div class="col-xs-12">
        <div class="alert <?php echo $statusType; ?>"> <?php echo $statusMsg; ?></div>
    </div>
<?php } ?>

    <!-- Import link -->
<!--    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-outline-danger" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
    </div>-->
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" >
        <form action="importmarks.php" method="post"  enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-danger" name="importSubmit" value="Import">
            
        </form>
        
<!--    <form action="download.php" method="POST">
         <input type="submit" value="Download Class Template">
         <input type="hidden" value= "<?php $_SESSION['class'] ?>" name="classval">
    </form> -->
    </div>
    <br>
    <!-- Data list table --> 
    <table class="table table-striped table-bordered" style="max-width:100%">
        <thead style="background-color:#181F44;color:white">
<!--                <h5>Sem</h5> 
                <h5>SubID</h5>
                <h5>credit</h5>
                <h5>Subname</h5>
                        <td><?php echo $row['Sem']; ?></td>
                        <td><?php echo $row['SubID']; ?></td>
                        <td><?php echo $row['credit']; ?></td>
                        <td><?php echo $row['Subname']; ?></td> -->
            <tr>
                <th>USN</th>
                <th>Name</th>
                <th>MSE1</th>
                <th>MSE2</th>
                <th>MSE3</th>
                <th>LA1</th>
                <th>LA2</th>
                <th>SEE_Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Get member row
            //$sq = "SELECT * FROM marks WHERE SubID = '".$subid."' and USN= (SELECT USN from profile where CONCAT(Dept,Sem,Sec)= '".$class."')";
            $sq="SELECT USN,Name from profile where CONCAT(Dept,Sem,Sec)= '".$class."'";
            $result = mysqli_query($con, $sq); //ADD Sem and SubID
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 
                        $sql = mysqli_query($con,"SELECT * FROM marks WHERE SubID = '".$subid."' and USN= '".$row['USN']."'"); 
                        if($sql->num_rows >0){
                            while($row1 = $sql->fetch_assoc()){
                        ?>
                        <tr>
                        <td><?php echo $row['USN']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row1['MSE1']; ?></td>
                        <td><?php echo $row1['MSE2']; ?></td>
                        <td><?php echo $row1['MSE3']; ?></td>
                        <td><?php echo $row1['LA1']; ?></td>
                        <td><?php echo $row1['LA2']; ?></td>
                        <td><?php echo $row1['SEE_Grade']; ?></td>
                        </tr>
                   <?php }
                        }
                      }
            } else { ?>
                <tr><td colspan="10">No records(s) found</td></tr>
<?php } ?>
        </tbody>
    </table>

<!-- Show/hide CSV upload form -->
<script>
    function formToggle(ID) {
        var element = document.getElementById(ID);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>