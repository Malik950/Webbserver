<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
if(!isset($_SESSION['username'])){
	echo<<<NAV
	<nav>
	 <ul>
	  <li><a href="index.php">Start</a></li>
	  <li><a href="products.php">Produkter</a></li>
	  <li><a href="sida3.php">Varusida 2</a></li>
	  <li><a href="login.php">Logga in</a></li>
	  </ul>
	 </nav>
NAV;
    }
	
else{
	if($_SESSION['status']==1){
		echo<<<NAV
		  <nav>
		  <ul>
		      <li><a href="index.php">Start</a></li>
			  <li><a href="products.php">Produkter</a></li>
              <li><a href="sida3.php">Varusida 2</a></li>
              <li><a href="admin.php">Admin</a></li>
		  </ul>
		  </nav>
NAV;
	}
		
	elseif($_SESSION['status']==2){
		echo<<<NAV
		  <nav id="admin">
		  <ul>
		      <li><a href="index.php">Start</a></li>
				  <li><a href="createProduct.php">Lägg till produkt</a></li>
	              <li><a href="sida3.php">Ändra produkt</a></li>
	              <li><a href="#">Ta bort produkt</a></li>
				  <li><a href="admin.php">Admin</a></li>
			  </ul>
			  </nav>
NAV;
    }
}  