<?php
$str="";
if(isset($_POST['Äpple']) && isset($_POST['description']) && isset($_POST['pris']) && isset($_POST['bild'])){
	 $name = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 $description = filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW); 
	 $price = filter_input(INPUT_POST,'price', FILTER_SANITIZE_NUMBER_INT);
	 $picture = filter_input(INPUT_POST,'picture', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
	 require "../include/connect.php";
	 
$target_dir = "./bilder";
var_dump($_FILES);
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimagesize($_FILES["picture"]["tmp_name"]);
if($check === false) {
header("location:createProduct.php?errmsg=1");
}

if(!file_exists($target_file)) {
header("location:createProduct.php?errmsg=2");
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
header("location.createProduct.php?errmsg=3");
}

if(move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
$sql = "INSRET INTO products(name, description, price, picture) VALUE(?,?,?,?)";
$res=$dbh->prepare($sql);
$res->bind_param("ssis",$namn, $descr, $pris,  $target_file);
$res->execute($sql);

header("location:products.php");
}
}else{
	$str.=<<<FORM
	<form action="createProduct.php" method="post">
      <p><label for="fruit">Name:</label>
       <input type="text" id="name" name="Äpple"></p>
	   <p><label for="fruit">description:</label>
	   <input type="text" id="description" name="description"></p>
		<p><label for="price">price:</label>
		<input type="text" id="price" name="pris"></p>
	    <p><label for="picture">picture:</label>
		<input type="file" id="picture" name="bild"></p>
           <p>
         <input type="submit" value="Skapa produkter">
           </p>
          </form>
FORM;
}
?>

<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>admin</title>
		 <link rel="stylesheet" href="css/stilmall.css">
  </head>
  <body id="admin">
    <div id="wrapper">
	  <?php
	  require "masthead.php";
	  require "meny.php";
	  
	  ?>
      

		
			
<main> <!--Huvudinnehåll-->
   <section id="content">
	<h2>Lägg till produkter</h2>
		<?php echo $str;?>

	</section>
	</main>
	
<?php
  require "footer.php";
?>
			
	</div>				
  </body>
</html>

}