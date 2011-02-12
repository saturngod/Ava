<!Doctype html>
<html>
<head>
<title>Nifty Framework</title>

<!-- load jquery -->
<?php 

// get latest jquery
// echo $this->jq->get_latest();

//load from public folder
echo $this->jq->get_script() ;
?>
<!-- end loading jquery -->
</head>
<body>