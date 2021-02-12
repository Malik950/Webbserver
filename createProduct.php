<?php
$target_dir = "./bilder";
var_dump($_FILES);
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$check = getimages($_FILES["picture"]["tmp_name"]);
if($check === false) {
header("location:createProduct.php?errmsg=1");
}

if(file_exists($target_file)) {
header("location:createproduct.php?errmsg=2");
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
header("location.createProduct.php?errmsg=3");
}

if(move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
$sql = "INSRET INTO products(name, description, price, picture) VALUE(?,?,?,?)";
$res=$dbh->prepare($sql);
$res->bind_param("ssis",$namn, $descr, $pris,  $target_file);
}
	$str.=<<<FORM
	<form action="createProduct.php" method="post">
      <p><label for="fruit">Name:</label>
       <input type="text" id="name" name="Äpple"></p>
	   <p><label for="fruit">description:</label>
	   <input type="text" id="description" name="description"></p>
		<p><label for="price">price:</label>
		<input type="text" id="price" name="pris"></p>
	    <p><label for="picture">picture:</label>
		<input type="text" id="picture" name="bild"></p>
           <p>
         <input type="submit" value="Skapa användare">
           </p>
          </form>
FORM;
   