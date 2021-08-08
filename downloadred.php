<?php

$class_sub = $_POST['class'];

$class = substr($class_sub, 0, strpos($class_sub, '-'));
$subid= substr($class_sub, strpos($class_sub, '-')+1, strlen($class_sub)-1);
$_SESSION['class']= $class;
$_SESSION['subid']= $subid;
?>

  