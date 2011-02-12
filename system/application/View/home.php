<?php
//variable for parsing
$data['base']=$base;
$data['public']=$public;
?>
<?php $this->load->view('header',$data); //load header ?>

<h2>Nifty Framework</h2>
<p><?php echo $txt; ?></p>

<?php $this->load->view('footer',$data); //load footer ?>