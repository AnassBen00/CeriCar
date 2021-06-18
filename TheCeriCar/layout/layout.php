<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <!--- Bootstrap--->   
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  
  <!--- Css---> 
  <link rel="stylesheet" href="css/v1.css">

  
  <!----- Fonts ------------>
  <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  

  <!--- jQuery--->   
  <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

  <!--- Ajax--->      
  <script type="text/javascript" src="js/rechercheVoyage.js"></script>
  <script type="text/javascript" src="js/afficherVoyage.js"></script> 
  <script type="text/javascript" src="js/login.js"></script> 
  <script type="text/javascript" src="js/reservation.js"></script>
  <script type="text/javascript" src="js/newVoyage.js"></script> 
  <script type="text/javascript" src="js/mesVoyage.js"></script> 
 
  

  
  
    <title>
     The CeriCar
    </title>
    <style>
      
      </style>
   
  </head>

  <body>
    <header id="header">
      <?php include($nameApp."/view/headerSuccess.php"); ?>
    </header>

    <div id="page">
      <?php if($context->error): ?>
      	<div id="flash_error" class="error">
        	
      	</div>
      
      <?php endif; ?>
      <div>
     
      </div>
      <div id="page_maincontent">	

      	<?php include($template_view); ?>
      
      </div>
    </div>
      

  </body>
  

</html>
