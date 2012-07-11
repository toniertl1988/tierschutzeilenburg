<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Tierschutzverein Eilenburg e.V.</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link href="<?php echo $this->baseUrl(); ?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $this->baseUrl(); ?>/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo $this->baseUrl(); ?>/js/jquery.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<div class="row-fluid">
			<div class="span12" id="head"> 
				<h5>Eventuell aktuelles Datum / Zeit / Willkommenstext</h5>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12" id="navlist">
				<h1>Navigation</h1>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12" id="headerimagefield">
				<h3>Titelbild / eventuell &Uuml;berblendeffekte per jQuery</h3>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span9" id="leftcontent">
				<h4>ADMIN</h4>
				<?php echo $this -> layout () -> content; ?>
			</div>
			<div class="span3" id="rightcontent">
				<?php echo $this->partial('about\openinghours.phtml', NULL);?>
			</div>
		</div>
	</div>
</body>
</html>