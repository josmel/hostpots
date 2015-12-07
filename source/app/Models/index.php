<?php

/*
include ('funciones.php') ;


$conectar = new funciones();
$conectar->Conexion("radius");
//$mac="D4:40:F0:6A:76:63";
$mac=$_GET['mac'];
$url=$_GET['url'];




$userpass = $conectar->verUsuario($mac);
$user=$userpass[0];
$password=$userpass[1];
//print_r($userpass);
if (!empty($user)){

header ("Location: http://voy.pe/wifi/free/ingresando.php?user=$user&password=$password&userurl=$url");
	
}

*/

/*

$user=$userpass[0]);

$pass=$userpass[1]);
*/

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap.min.js"></script>
<link href="style.css" rel="stylesheet">
</head>	
<?php
/*
 *********************************************************************************************************
 * daloRADIUS - RADIUS Web Platform
 * Copyright (C) 2007 - Liran Tal <liran@enginx.com> All Rights Reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *********************************************************************************************************
 *
 * Authors:     Liran Tal <liran@enginx.com>
 *
 * Credits to the implementation of captcha are due to G.Sujith Kumar of codewalkers
 *
 *********************************************************************************************************
 */


//session_start();                                                // we keep a session to save the captcha key




	$status = "firstload";

        if (isset($_POST['submit'])) {

                isset($_POST['firstname']) ? $firstname = $_POST['firstname'] : $firstname = "";
                isset($_POST['lastname']) ? $lastname = $_POST['lastname'] : $lastname = "";
               // isset($_POST['email']) ? $email = $_POST['email'] : $email = "";

                //$captchaKey = substr($_SESSION['key'],0,5);
				$captchaKey = 1 ;
                //$formKey = $_POST['formKey'];
				$formKey = 1 ;
                if ( $formKey == $captchaKey ) {

                        if ( ($firstname) && ($lastname) ) {

                                include('library/opendb.php');
                                include('include/common/common.php');


                                $firstname = $dbSocket->escapeSimple($firstname);
                                $lastname = $dbSocket->escapeSimple($lastname);
                                $email = $dbSocket->escapeSimple($email);


                                /* let's generate a random username and password
                                   of length 4 and with username prefix 'guest' */
                                $rand = createPassword($configValues['CONFIG_USERNAME_LENGTH'], $configValues['CONFIG_USER_ALLOWEDRANDOMCHARS']);
                                $username = $configValues['CONFIG_USERNAME_PREFIX'] . $rand;
							
								
                                //$password = createPassword($configValues['CONFIG_PASSWORD_LENGTH'], $configValues['CONFIG_USER_ALLOWEDRANDOMCHARS']);
								$password = createPassword($configValues['CONFIG_PASSWORD_LENGTH'], $configValues['CONFIG_USER_ALLOWEDRANDOMCHARS']);
                                /* adding the user to the radcheck table */
                                $sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADCHECK']." (id, Username, Attribute, op, Value) ".
                                        " VALUES (0, '$username', 'User-Password', '==', '$password')";
                                $res = $dbSocket->query($sql);

                                /* adding user information to the userinfo table */
                                $sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_DALOUSERINFO']." (username, firstname, lastname, email,notes) ".
                                        " VALUES ('$username', '$firstname', '$lastname', '$email','$_POST[mac]')";
										
								//print_r($sql);		
								//print_r($_GET);
										
                                $res = $dbSocket->query($sql);


                                /* adding the user to the default group defined */
                                if (isset($configValues['CONFIG_GROUP_NAME']) && $configValues['CONFIG_GROUP_NAME'] != "") {
                                        $sql = "INSERT INTO ".$configValues['CONFIG_DB_TBL_RADUSERGROUP']." (UserName, GroupName, priority) ".
                                                " VALUES ('$username', '".$configValues['CONFIG_GROUP_NAME']."', '".$configValues['CONFIG_GROUP_PRIORITY']."')";
                                        $res = $dbSocket->query($sql);
                                }


                                include('library/closedb.php');

				$status = "success";
                        } else {
				$status = "fieldsFailure";
                        } 

                } else {
			$status = "captchaFailure";
                } 

        } 
?>




<script src="library/javascript/common.js" type="text/javascript"></script>
<body  onLoad="return setFocus();">
<div class="container">

	 <div class="row">
		<div >
    		
				<center><img src="saga.jpg" alt="Jose Areche" style="width:504px;height:428px;" > </center>
				
				
				
			
		</div>  
	</div>
	 
	 <div class="row">
		<div >
    		
			<center><?php print_r($_GET)?></center>
			
		</div>  
	</div>
	


    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  <!--	<div class="panel-heading">
			    	<h3 class="panel-title">Ingresar</h3> 
			 	</div>  -->
				<div class="panel-body">
			    	
						<?php

		/*************************************************************************************************************************************************
		 *
		 * switch case for status of the sign-up process, whether it's the first time the user accesses it, or rather he already submitted
		 * the form with either successful or errornous result
		 *
		 *************************************************************************************************************************************************/     

		include("library/daloradius.conf.php");

		function showForm() {

			include("library/daloradius.conf.php");
			
			
			//print_r($_POST);
			
			?>
					
					
					<form name="signup" action="index.php" method="post">
				
                    <fieldset>
			    	  <div class="form-group">
			    		    <input class="form-control" placeholder="Nombre" name="firstname" type="hidden" value="ss">
							<input placeholder="lastname" name="lastname" type="hidden" value="ss">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Email" name="email" type="hidden" value="" value="ss">
			    		</div> 
							<input class="form-control" placeholder="Email" name="mac" type="hidden" value="ssss">
			    		<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Register">
			    	</fieldset>
			      	</form>
					
					
					
					
					<?php
				
		}
	
		switch ($status) {
			case "firstload":
				showForm();
				break;


			case "success":
				echo "<font color='blue'>Registro completado</font><br/><br/>".
				"<b>".$_POST['firstname']." </b>".
					//$configValues['CONFIG_SIGNUP_SUCCESS_MSG_HEADER']."<br/><br/>".
					//$configValues['CONFIG_SIGNUP_SUCCESS_MSG_BODY'].
					
					"<br/>Click <b><a href='http://10.5.50.1/login?user=juan&password=juan&dst=http://www.google.com'>Aqui</a></b>".
					" Para empezar a navegar <br/><br/>";
					;
					
					//$configValues['CONFIG_SIGNUP_SUCCESS_MSG_LOGIN_LINK'];
					
				break;


			case "fieldsFailure":
                                echo "<font color='red'>".$configValues['CONFIG_SIGNUP_FAILURE_MSG_FIELDS']."</font><br/><br/>";

				showForm();
				break;


			case "captchaFailure":
                                echo "<font color='red'>".$configValues['CONFIG_SIGNUP_FAILURE_MSG_CAPTCHA']."</font><br/><br/>";
				showForm();
				break;

		}


	?>
					
					
			    </div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</div>


</body>
</html>

