<?php
require "../include/connect.php";
$sql = "SELECT * FROM products";
  $res = $dbh->prepare($sql);
  $res->execute();
  $result = $res->get_result();
?>

<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Produkter</title>
		 <link rel="stylesheet" href="css/stilmall.css">
  </head>
  <body id="produkter">
    <div id="wrapper">
	  <?php
	  require "masthead.php";
	  require "meny.php";
	  //require "connect.php";
	  ?>
      

		
			
		<main> <!--Huvudinnehåll-->
			<section id="content">
				<h2>Varor</h2>
				<table>
					<thead>
						<tr>
							<th>Namn</th>
							<th>Beskrivning</th>
							<th>Bild</th>
							<th>Pris</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row=$result->fetch_assoc()){
						echo "<tr><td>";
						echo $row['name'];
						echo "</td><td>";
						echo $row['description'];
						echo "</td><td>";
						echo "<img src='";
						echo $row['picture'];
						echo "'></td><td>";
						echo $row['price'];
						echo "<td></tr>";
					}
					?>
						<!--tr>
							<td>Äpple</td>
							<td>Grönt surt</td>
							<td><img src="bilder/apple.jpg" alt="Grönt surt"></td>
							<td>50</td>
							<td><a href="#">Köp</a></td>
						</tr>
						<tr>
							<td>Apelsin</td>
							<td>Orange söt</td>
							<td><img src="bilder/orange.jpg" alt="Orange söt"></td>
							<td>38</td>
							<td><a href="#">Köp</a></td>
						</tr>
						<tr>
							<td>Päron</td>
							<td>Gult saftigt</td>
							<td><img src="bilder/pear.jpg" alt="Gult saftigt"></td>
							<td>100</td>
							<td><a href="#">Köp</a></td>
						</tr>
						<tr>
							<td>Banan</td>
							<td>Gul böjd</td>
							<td><img src="bilder/banana.jpg" alt="Gul böjd"></td>
							<td>30</td>
							<td><a href="#">Köp</a></td>
						</tr>-->
					</tbody>
				</table>

			</section>
		</main>
	
		<?php
			require "footer.php";
			?>
	</div>
  </body>
</html>
