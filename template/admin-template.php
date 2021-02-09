<?php
require "../include/connect.php";


$username=$_SESSION['username'];
$sql = "SELECT * FROM customers WHERE username = ?";
  $res = $dbh->prepare($sql);
  $res->bind_param("s",$username);
  $res->execute();
  $result = $res->get_result();
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
				<h2>användare</h2>
				<table>
					<thead>
						<tr>
							<th>Namn</th>
							<th>Efernamn</th>
							<th>adress</th>
							<th>city</th>
							<th>phone</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row=$result->fetch_assoc()){
						echo "<tr><td>";
						echo $row['firstname'];
						echo "</td><td>";
						echo $row['lastname'];
						echo "<td></td>";
						echo $row['adress'];
						echo "</td><td>";
						echo $row['city'];
						echo "</td><td>";
						echo $row['phone'];
						echo "</td><tr>";
					}
					?>
						
					</tbody>
				</table>

			</section>
		</main>
	
		<?php
			require "footer.php";
			?>
			
			<p id="uniktId">Logga ut</p>
			<a href="utloggning.php#uniktId">Logout</a>
	</div>
  </body>
</html>
