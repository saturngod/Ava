<!Doctype html>
<html>
<head>
<title><?php echo $title ?></title>
<?php
    //load from public folder

    echo $this->load->css('css/style');
    echo $this->load->css('css/960');
    echo $this->load->js('js/jquery.js') ;
    
    //load syntax highlighter
    $shbrush= array("js/syntaxhighlighter/shCore",'js/syntaxhighlighter/shBrushJScript','js/syntaxhighlighter/shBrushPhp','js/syntaxhighlighter/shBrushXml');
    echo $this->load->js($shbrush);


    echo $this->load->css('css/syntaxhighlighter/shCore');
    echo $this->load->css('css/syntaxhighlighter/shCoreDefault');
?>
<script type="text/javascript">

    SyntaxHighlighter.defaults['toolbar']=false;
    SyntaxHighlighter.defaults['gutter']=false;
    SyntaxHighlighter.all();


    $(document).ready(function(){
        $("#menu li a").each(function(index){
            if($(this).attr("href")==location.href)
            {

                $(this).addClass('active');
            }
        });
    });
</script>
<!-- icon -->
<link rel="shortcut icon" href="<?php echo AvaConfig::base_url ?>/images/favicon.ico" />
<link rel="icon" type="image/png" href="<?php echo AvaConfig::base_url ?>/images/favicon.png" />
<!-- end icon -->

 <!-- google web font -->
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:light,regular,bold' rel='stylesheet' type='text/css'>
<!-- end google web font -->
</head>
<body>
<div class="container_12">
<header>
    <h1 class="title">Ava Framework Documentation</h1>
    <nav>
        <!-- navigation bar -->
    </nav>
</header>
<?php
$this->load->view('leftsidebar')
?>

<section id="detail" class="grid_10">
    <div class="detail">