<?php include 'database_fika.php';  ?>

<?php 
  
   // query

$query = "SELECT * FROM `fika_admin` ORDER BY id ASC";


$sql = $mysqli->query($query) or die($mysqli->error);

while ($row = mysqli_fetch_array($sql,MYSQL_BOTH)):


?>

<!DOCTYPE html>
<html>
<head>
	<title>INDIGINE</title>
	<link rel="stylesheet" type="text/css" href="indigine.css">

</head>
<body>
<div id="wrapper">
 

	<div class="container">

		<img src="images/arm.jpg" height="150" width="150">

		 <h2>FIKA LOCAL GOVERNMENT </h2>
		 <div class="container" style="width: 100px; height: 150px; border: solid black 2px; position: absolute; top: 250px; right: 280px; background: white;">
		 	<table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5"> 

                    <tbody>

   
                     <tr> 

                        <td> 

  

                           <img src="<?php echo $row["image"]; ?>" width="100" heigh="150" align="right">

 

                         </td> 

                       </tr> 

                    </tbody>
                   </table> 
               <?php endwhile; ?>

		 </div>

		 <h4>FIKA, YOBE STATE</h4>

		 <P class="in_cer">INDIGINE CERTIFICATE</P>

		 <P>The Bearer</P>

	
	 	 

		 <i><strong><?php echo $row['first_name']; ?></strong></i>
		 <p>is a Bone Fide of Fika Local Government He/She <br> Hails From <i>.................................. </i>Village in <i>................................................. </i>

		 Ward of Fika Local Government Therefore the Local Government<br> Recommends Him/Her for any help/assistance you 

		may wish to <br>upper Him/Her, Please</p>
		<p>
			<i>...........................................</i>
			<h4>ASPIRANT'S SIGNATURE</h4>
		</p>
	</div>	
	<div class="container">

		<footer id="left" style="float: left; padding-left: 20px;">
			<i>SECRETARY/DPM</i> <BR>FIKA LOCAL GOVERNMENT
			
		</footer>
		<aside id="right" >
			<i>CHAIRMAN</i> <BR> FIKA LOCAL GOVERNMENT

		</aside>
	</div>


</div>	

 

</body>
</html>