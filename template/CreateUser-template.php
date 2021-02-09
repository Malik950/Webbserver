<?php

$str="";


if(isset($_GET['name'])){
	$usr=$_GET['name'];
	$str="Användarnamnet $usr är upptaget";
}
elseif(isset($_GET['mail'])){
	$ma=$_GET['mail'];
	$str="Mailadressen $ma är uptagen";
}

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['zip']) && isset($_POST['City']) && isset($_POST['mail']) &&isset($_POST['phone']) 
&& isset($_POST['password']) && isset($_POST['address']) && isset($_POST['username'])){
	 $fname = filter_input(INPUT_POST,'fname', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 $lname = filter_input(INPUT_POST,'lnamn', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 $zip = filter_input(INPUT_POST,'zip', FILTER_SANITIZE_NUMBER_INT);
	 $city = filter_input(INPUT_POST,'City', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 $mail = filter_input(INPUT_POST,'mail', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW); 
	 $phone = filter_input(INPUT_POST,'phone', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 $adress = filter_input(INPUT_POST,'address', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	  $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 require "../include/connect.php";

	$sql="SELECT * FROM users WHERE username = ? OR email = ?";
	$res=$dbh->prepare($sql);
	$res->bind_param("ss",$username,$mail);
	$res->execute();
	$result=$res->get_result();
	$row=$result->fetch_assoc();

	//om användaren finns
	if($row !==NULL)
	{
		if($row['username']===$username){
			header("location.CreateUser.php?name=$username");
		}
		
		elseif($row['username']===$username){
			header("location.CreateUser.php?mail=$mail");
		}
		//elseif($row['email']===$mail{
		//	header("location.CreateUser.php?mail=$mail");
		//}
	}
	else{
		$status = 1;
		
		$sql = "INSERT INTO customers(username, firstname, lastname, adress, zip, city, phone) VALUE (?,?,?,?,?,?,?)";
		$res=$dbh->prepare($sql);
		$res->bind_param("ssssiss",$username, $fname, $lname, $adress, $zip, $city, $phone);
		$res->execute();
		
		$sql = "INSERT INTO users(username, email, password, status) VALUE (?,?,?,?)";
		$res=$dbh->prepare($sql);
		$res->bind_param("sssi",$username, $mail, $password, $status);
		$res->execute();
		
		
		$str="Användaren tillagd";
		
	}
}
else{

	
	$str.=<<<FORM
	<form action="createUser.php" method="post">
      <p><label for="fnamn">Förnamn:</label>
       <input type="text" id="fname" name="fname"></p>
	   <p><label for="lnamn">Efternamn:</label>
	   <input type="text" id="lname" name="lname"></p>
		<p><label for="address">Adress:</label>
		<input type="text" id="address" name="address"></p>
	    <p><label for="zip">Postnummer:</label>
		<input type="text" id="zip" name="zip"></p>
		<p><label for="City">Ort:</label>
		<input type="text" id="City" name="City"></p>
		<p><label for="phone">Telefon:</label>
		<input type="text" id="phone" name="phone"></p>
		<p><label for="mail">Epost:</label>
		<input type="email" id="mail" name="mail"></p>
		<p><label for="username">Användarnamn:</label>
		<input type="text" id="username" name="username"></p>
        <p><label for="pwd">Lösenord:</label>
         <input type="password" id="pwd" name="password"></p>
           <p>
         <input type="submit" value="Skapa användare">
           </p>
          </form>
FORM;
    }
?>

<!DOCTYPE html>

<html lang="sv">

  <head>
     <meta charset="utf-8">
     <title>Logga in</title>
		 <link rel="stylesheet" href="css/stilmall.css">
	</head>
  <body id="login">
    <div id="wrapper">
     	<?php
	  require "masthead.php";
	  require "meny.php";
	  ?>
		
			<main> <!--Huvudinnehåll-->
		
				<section>
				          
				<?php echo $str; ?>
				</section>
				
			</main>

    </div>
    <?php
			require "footer.php";
			?>

	</body>
</html>
}