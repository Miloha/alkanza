<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="ISE iNNpulsa Colombia">
<title>Clickdelivery</title>
<script src="<?=base_url()?>assets/js/jquery-min.js"></script>
<!-- Bootstrap core CSS -->
<link href="<?=base_url()?>assets/css/bootstrap.min.css"
	rel="stylesheet">
<!-- Bootstrap theme -->
<link href="<?=base_url()?>assets/css/bootstrap-theme.min.css"
	rel="stylesheet">

<!-- Custom styles for this template -->
<link href="<?=base_url()?>assets/css/theme.css" rel="stylesheet">

<?php
$htmllogout = '';
$nombre = '';
$reportes = '';

if($this->session->userdata('perfil') != FALSE ){
	
	if($this->session->userdata('perfil') == 'editor' or  $this->session->userdata('perfil') == 'administrador'){
		$reportes .=<<<HTML
		<li><a href="/listperfil">Perfiles</a></li>
		
HTML;

		
		
		
	}
	
	
$nombre = substr($this->session->userdata('nombre'), 0, 8);  // abcd
$url1 = anchor(base_url().'login/logout_ci', 'Cerrar sesión');
$url2 = anchor(base_url().'perfil/index/edit/' . $this->session->userdata('id_usuario'), 'Perfil');
$htmllogout =<<<HTML

<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Administrar <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li>$url2</li>
							$reportes
						</ul>
</li>
				  
				   <li class="active"> $url1 </li>
HTML;
	
}

if(isset($output) && !empty($output)):


foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>
<?php foreach($js_files as $file): ?>

<script src="<?php echo $file; ?>"></script>
<?php endforeach; 
endif;
?>


</head>
<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">
				Clickdelivery - <?=$this->session->userdata('nombre')?> - <?=$this->session->userdata('perfil')?></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				
					<?php echo $htmllogout; ?>
					
					<!--  li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Dropdown <b class="caret"></b> </a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li -->
					
					
				</ul>
			</div >
			<!--/.nav-collapse -->
		</div>
	</div>

<div class="container theme-showcase" role="main">
