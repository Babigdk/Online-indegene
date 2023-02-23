
<?php   include 'database_fika.php'; ?>

<?php

 //get the image extension function

    function GetImageExtension($imagetype) 
      { 
        if(empty($imagetype)) return false; 
        switch($imagetype) 
        { 
            case 'images/bmp': return '.bmp'; 
            case 'images/gif': return '.gif'; 
            case 'images/jpeg': return '.jpg'; 
            case 'images/png': return '.png'; 
            default: return false; 
        } 
     } 

     // getting forms value

 if (!empty($_FILES["userfile"]["name"])) { 
     $file_name = $_FILES["userfile"]["name"]; 
     $temp_name = $_FILES["userfile"]["tmp_name"]; 
     $imgtype = $_FILES["userfile"]["type"]; 
     $ext = GetImageExtension($imgtype); 
     $imagename = date("d-m-Y")."-".time().$ext; 
     $target_path = "images/".$imagename; 
     $first_name = $_POST['fname'];
     $last_name = $_POST['lname'];
     $phone_number = $_POST['pnumber'];
     $home_town = $_POST['htown'];
     $contact_address = $_POST['caddress'];
     $email = $_POST['email'];
     $gender = $_POST['gender'];

     // prepare for the insert
  
if(move_uploaded_file($temp_name, $target_path)) {

   $query_upload = "INSERT INTO `fika_admin` (`id`,`first_name`,`last_name`,`phone_number`,`home_town`,`contact_address`,`email`,`gender`,`image`,`submission_date`) VALUES  ('','".$first_name."','".$last_name."','".$phone_number."','".$home_town."','".$contact_address."','".$email."','".$gender."','".$target_path."','".date("Y-m-d")."')";  

       $mysqli->query($query_upload) or die($mysqli->error);   
 
}else{
  exit("error while uploading image on the server");
 } 

}

// query

$query = "SELECT * FROM `fika_admin` ORDER BY id ASC";


$sql = $mysqli->query($query) or die($mysqli->error); 

?>


<!DOCTYPE html>
<html>
<head>
	<title>Fika Indegine</title>
	 
	 <link rel="stylesheet" type="text/css" href="css/css_fa.css">
     <link rel="stylesheet" type="text/css" href="css_fika.css">

	 <style>

	*{
 	margin: 0px;
 	padding: 0px;
    }
    h1{
 	font: bold 20px tahoma;
    }
    h2{
 	font: bold 14px tahoma;
    }
    header, nav, section, aside, footer, hgroup, main, article {
 	display: block;
    }
    body{
 	width: 100%;
 	display: -webkit-box;
 	-webkit-box-pack: center;
    }
    #wrapper{
 	max-width: 1000px;
 	margin: 0px 0;
 	display: -webkit-box;
 	-webkit-box-orient: vertical;
    -webkit-box-flex: 1;
    overflow: auto;
    }
     
    #fooo{
    	text-align: center;
    	padding: 20px;
    	border-top: 2px solid green;
        margin-top: 20px;
    }
    #top_link{
    	float: right;
    	margin-top: 1px;
    	overflow: auto;
    }
    #top_link li{
    	display: inline-block;
    	color: green;
    	list-style: none;
    	font: 14px tahoma;
    }
    #top_serch{

    }
    
    #top_serch button{
    	color: white;
    	background: green;
    	height: 35px;
    	width: 50px;
    	border-radius: 7px;
    	overflow: auto;
    }
    #pop{
        background: lightgreen;
        color: white;
        margin-top: 25px;
        height: 40px;
        width: 75%;
        padding: 7px;
        margin-left: 20px;

    }
    table{
      margin-top: 20px;
      
    }


	</style>

</head>
<body>
	<div id="wrapper">
		
	  	
	  <?php include 'header_fika.php' ?>
	
          <main>
              
          <div>
            
        
            <table width="100%">
              <tr style="background: green; color: white; font: 14px tahoma; text-align: left;">
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>PHONE NUMBER </th>
                <th>HOME TOWN</th>
                <th>CONTACT ADDRESS</th>
                <th>EMAIL</th>
                <th>GENDER</th>
                <th>IMAGE</th>
                <th>SUBMISSION DATE</th>
              </tr>
              

              <tr>


                <?php 
                 if ($sql->num_rows > 0 ) {
                 
                while ($row = mysqli_fetch_array($sql, MYSQL_BOTH)): ?>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['phone_number'];  ?></td>
                <td><?php echo $row['home_town'];  ?></td>
                <td><?php echo $row['contact_address'];  ?></td>
                <td><?php echo $row['email'];  ?></td>
                <td><?php echo $row['gender'];  ?></td>
                <td>
                  <table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5"> 

                    <tbody>

   
                     <tr> 

                        <td> 

  

                           <img src="<?php echo $row["image"]; ?>" width="100" heigh="200" align="right">

 

                         </td> 

                       </tr> 

                    </tbody>
                   </table> 
                </td>
                <td><?php echo $row['submission_date'];  ?></td>
              </tr>
              <?php endwhile; }?>
            </table>




          </div>

          </main>
	 

		<div id="fooo">
			Copyright &copy; 2014 Fika Local Government
			
		</div>
	
    
     </div>
</body>
</html>
