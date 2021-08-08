<?php
class timeslots{
    public $subID;
    public  $teachID;
    public  $batch;
    public $subName;
    public $teachName;
    public $meetLink;
    function __construct($subID, $teachID, $batch,$subName,$teachName, $meetLink) {
    $this->subID = $subID;
    $this->teachID = $teachID;
    $this->batch = $batch;
    $this->subName = $subName;
    $this->teachName=$teachName;
    $this->meetLink=$meetLink;
  }
}

ini_set("SMTP","smtp.gmail.com" );
ini_set("smtp_port","465");
ini_set('sendmail_from', 'infornmit@gmail.com');          


     
          ini_set('max_execution_time', '0');
          
          while(true){
           $hour=(date("H")+3)%24;
           if($hour==18){
           $day= date("l");
           echo $day;
        
           if($day=="Sunday")
               $x=-1;
           else if($day=="Monday")
               $x=0;
           else if($day=="Tuesday")
               $x=1;
           else if($day=="Wednesday")
               $x=2;
           else if($day=="Thursday")
               $x=3;
           else if($day=="Friday")
               $x=4;
           else if($day=="Saturday")
               $x=5;
           
           $servername = "localhost:3306";
            $username = "root";
            $password = "";
            $dbname = "infor";

           $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
  
            $sql = "SELECT * from profile";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
     
              while($row = $result->fetch_assoc())
              {
                  
                 $email=$row["email"];
                 $teach=$row["TeachID"];
                 if(is_null($teach))
                 {
                     $dept=$row["Dept"];
                     $sem=$row["Sem"];
                     $sec=$row["Sec"];
                     echo" $dept $sem $sec";
                     $conn = new mysqli($servername, $username, $password, $dbname);
                     $sql1 = "SELECT ts.Hour, ts.Day, s.SubName, s.SubID, t.TeachID, t.TeachName, t.meetlink"
                             . " from timeslots ts, subjects s, teachers t "
                             . " where ts.Day=$x and ts.Semester=$sem and ts.Section= '$sec' and ts.Department='$dept' and ts.SubID=s.SubID and t.TeachID=ts.TeachID ";
                     $result1 = mysqli_query($conn, $sql1);
                    if (mysqli_num_rows($result) > 0){
                      while($row1 = $result1->fetch_assoc())
                       {
                            $teachID=$row1['TeachID'];
                            $subID=$row1['SubID'];
                            $teachName=$row1['TeachName'];
                            $subName=$row1['SubName'];  
                            $meetLink=$row1["meetlink"];
                            $arr[$row1['Hour']]= new timeslots($subID, $teachID, 1,  $subName, $teachName, $meetLink);
                       }
                       $to_email = "dot123rahul@gmail.com";
                       $subject = "inFor";
                       $body = "<img src='https://raw.githubusercontent.com/DotBloo/OS_Semaphores/main/email%20header.png'>";
                       $headers = "MIME-Version: 1.0" . "\r\n"; 
                       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                       $headers .= "From:infornmit@gmail.com";
                       $body.="<h1><pre>You have the following classes scheduled for $day:<br>";
                         print_r($arr);
                   
                          for($j=0;$j<6;$j++)
                          {   
                              if(!is_null($arr[$j])){
                                  $var= $arr[$j]->subName;
                                  $meetLink= $arr[$j]->meetLink;
                                  $body.=($j+1)." Hour: $var <a href='$meetLink'>meeting link</a><br>";
                              }
                          }
                         $body.="</pre></h1>";
                         print_r($body);
                         if (mail($email, $subject, $body, $headers)) {
                             echo "Email successfully sent to $to_email...";
                        }
                     }
                     
                 }
                 else
                 {
                      $conn1 = new mysqli($servername, $username, $password, $dbname);
                     $sql1 = "SELECT ts.Hour, s.SubName, s.SubID, t.TeachID, t.TeachName, ts.Department, ts.Semester, ts.Section, t.meetlink"
                             . " from timeslots TS, subjects s, teachers t "
                             . " where ts.Day=".$x." and ts.TeachID='$teach' and ts.SubID=s.SubID and t.TeachID=ts.TeachID ORDER BY ts.Hour ASC";
                     $result1 = mysqli_query($conn1, $sql1);
                    if (mysqli_num_rows($result) > 0){
                       $to_email = "dot123rahul@gmail.com";
                       $subject = "inFor";
                      $body = "<img src='https://raw.githubusercontent.com/DotBloo/OS_Semaphores/main/email%20header.png'>";
                       $headers = "MIME-Version: 1.0" . "\r\n"; 
                       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                       $headers .= "From:infornmit@gmail.com";
                         $body.="<h1><pre>You have the following classes scheduled for $day:<br>";
                      while($row1 = $result1->fetch_assoc())
                       {
                            $meetLink=$row1['meetlink'];
                            $teachID=$row1['TeachID'];
                            $subID=$row1['SubID'];
                            $teachName=$row1['TeachName'];
                            $subName=$row1['SubName'];      
                            $arr[$row1['Hour']]= new timeslots($subID, $teachID, 1,  $subName, $teachName);
                            $body.=($row1["Hour"]+1)." Hour:  ".$row1["SubName"]." for ".$row1["Semester"]." Semester ".$row1["Section"]." Section <br>";
                       }
                       $body.="<a href='$meetLink'> Click Me </a> to join your meeting!</pre> </h1>";
                         print_r($body);
                         if (mail($to_email, $subject, $body, $headers)) {
                             echo "Email successfully sent to $to_email...";
                    }
                 }
             
            }
            }
            }
           }
           sleep(3600);
       }