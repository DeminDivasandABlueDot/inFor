<?php include 'links.php'?>
<?php include 'connection.php'?>
<?php session_start(); ?>
<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
	box-sizing: border-box;
}
body{
	    background: linear-gradient(
          rgba(0, 0, 0, 0.4), 
           rgba(0, 0, 0, 0.5), 
          rgba(0, 0, 0, 0.7)
        ),
        url("https://raw.githubusercontent.com/DeminDivasandABlueDot/inFor/main/img/abstract-background-1.jpg") 50% fixed;
        background-size: cover;
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
        font-weight: bold;
	height: 100vh;
	margin: -20px 0 50px;
}
.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 80%;
  min-height: 100%;
  padding: 20px;
}
.session {
  display:  flex; 
  flex-direction:  row; 
  max-width: 70% ; 
  height:  auto; 
  margin:  auto auto; 
  background:  #e6e6ff; 
  border-radius:  4px; 
  box-shadow:  0px 2px 6px -1px rgba(0,0,0,.12);
}
.left {
  width:  600px; 
  height:  auto; 
  min-height:  100%; 
  position:  relative; 
  background-image: url("https://raw.githubusercontent.com/DeminDivasandABlueDot/inFor/main/img/infor%20tag%20logo%20dark.png");
  background-size:  cover;
  border-top-left-radius:  4px; 
  border-bottom-left-radius:  4px; 
  svg {
    height:  40px; 
    width:  auto; 
    margin:  20px; 
  }
}
h1 {
	font-weight: bold;
	margin: 0;
}

h2 {
	text-align: center;
}

span {
	font-size: 12px;
}

.btn-login {
	border-radius: 20px;
	border: 1px solid #FF4B2B;
	background-color: #CD4236;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
        max-width: 30%;
        text-align: center;
}
.btn-login:active {
        background-color: #222c5d;
	transform: scale(0.9);
}

.btn-login:focus {
	outline: none;
}

.btn-login.ghost {
	background-color: transparent;
	border-color: #FFFFFF;
}

form {
	background-color: #e6e6ff;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #ffffff;
        border-radius: 20px;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
        align-content: center;
}
</style>

<?php
if(isset($_POST['email'])){
    
    $_SESSION['email']=$_POST['email'];
    $password=$_POST['password'];
    
    $sql="select * from profile where email='".$_SESSION['email']."'AND password='".$password."' limit 1";
    
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)==1){
        echo 'Login Successful';
    }
    else{
        echo 'Incorrect Email or Password';
    }
$getusn="SELECT USN as usn FROM profile where email='".$_SESSION['email']."' limit 1";
$usnval = mysqli_query($con, $getusn);
if(mysqli_num_rows($usnval)==1){
    while($row = $usnval->fetch_assoc()){
        $_SESSION['usn']= $row['usn'];
    }
}

$gettid="SELECT TeachID as tid FROM profile where email='".$_SESSION['email']."' limit 1";
$tidval = mysqli_query($con, $gettid);
if(mysqli_num_rows($tidval)==1){
    while($row = $tidval->fetch_assoc()){
        $_SESSION['tid']= $row['tid'];
        echo $_SESSION['tid'];
    }
}
}
?>
<html>
<head>
  <title>Infor Login</title>
</head>
<body>
      <div class="session">
    <div class="left">
      <?xml version="1.0" encoding="UTF-8"?>
      <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
<style type="text/css">
	.st01{fill:#fff;}
</style>
    </div>
    <div  class="wrapper" >
        <form method = "POST" action="login.php">
			<div>
                            Email ID: <input type="email" name="email" placeholder="   Email" size="40"/><br/><br/>
			</div>
			<div>
                            Password: <input type="password" name="password" placeholder="   Password" size='40' minlength="8"/><br/><br/>
			</div>
			<input type="submit" type="submit" value="LOGIN" class="btn-login"/><br/>
		</form>
</div>

</body>
</html>