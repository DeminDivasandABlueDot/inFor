
<?php
// Load the database configuration file
include_once 'connection.php';
include_once 'links.php';
if(isset($_POST['importSubmit'])){
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
         $fileName = $_FILES["file"]["tmp_name"];
        if(is_uploaded_file($fileName)){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($fileName, 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data   
                $usn   = $line[0];
                $semval  = $line[1];
                $subid  = $line[2];
                $credit = $line[3];
                $subname = $line[4];
                $mse1 = $line[5];
                $mse2 = $line[6];
                $mse3 = $line[7];
                $la1 = $line[8];
                $la2 = $line[9];
                $see = $line[10];
                
                echo "USN : ".$usn;
                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM marks WHERE SubID = '".$subid."' AND USN= '".$usn."'";
                $prevResult = $con->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $con->query("UPDATE marks SET MSE1 = ".$mse1.", MSE2 = ".$mse2.", MSE3 = ".$mse3.", LA1 = ".$la1.", LA2 = ".$la2.", SEE_Grade = ".$see." WHERE USN = '".$usn."' and SubID = '".$subid."'");
                }else{
                    //echo '   INSERTING';
                    // Insert member data in the database
                mysqli_query($con,"INSERT INTO marks (USN, Sem, SubID, credit, Subname, MSE1, MSE2, MSE3, LA1, LA2, SEE_Grade) VALUES ('".$usn."', ".$semval.", '".$subid."', ".$credit.", '".$subname."', ".$mse1.", ".$mse2.", ".$mse3.", ".$la1.", ".$la2.", ".$see.")");
                //mysqli_query($con,"INSERT INTO marks (USN,Sem) VALUES ('".$usn."' , ".$semval.")");
            }
                
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
// Redirect to the listing page
header("Location: uploadmarks.php ".$qstring);
