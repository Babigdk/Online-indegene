
<?php

use OnlineIndegene\Logger;
use OnlineIndegene\RecordQuery;

require_once __DIR__ . '/database_fika.php';
require_once __DIR__ . '/lib/RecordQuery.php';

function GetImageExtension($imagetype)
{
    $extensions = [
        'image/bmp' => '.bmp',
        'image/gif' => '.gif',
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
    ];

    return $extensions[$imagetype] ?? false;
}

$databaseError = false;

$uploadedFile = null;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $formValues = [];
    foreach (['fname', 'lname', 'pnumber', 'htown', 'caddress', 'email', 'gender'] as $key) {
        $value = $_POST[$key] ?? '';
        if (!is_string($value)) {
            http_response_code(400);
            exit('The submitted record contains invalid fields.');
        }
        $formValues[] = $value;
    }

    $upload = $_FILES['userfile'] ?? null;
    if (!is_array($upload) || ($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        http_response_code(400);
        exit('Please choose an image to submit with the record.');
    }

    $tempName = (string) ($upload['tmp_name'] ?? '');
    if (!is_uploaded_file($tempName)) {
        http_response_code(400);
        exit('The image could not be uploaded. Please try again.');
    }

    $imageType = mime_content_type($tempName);
    $extension = is_string($imageType) ? GetImageExtension($imageType) : false;
    if ($extension === false) {
        http_response_code(400);
        exit('Please upload a BMP, GIF, JPEG, or PNG image.');
    }

    $imageName = bin2hex(random_bytes(16)) . $extension;
    $imagePath = 'images/' . $imageName;
    $uploadedFile = __DIR__ . '/' . $imagePath;
    if (!move_uploaded_file($tempName, $uploadedFile)) {
        http_response_code(400);
        exit('The image could not be uploaded. Please try again.');
    }

    [$firstName, $lastName, $phoneNumber, $homeTown, $contactAddress, $email, $gender] = $formValues;
    $submissionDate = date('Y-m-d');

    try {
        $statement = $mysqli->prepare(RecordQuery::insertSql());
        $statement->bind_param(
            'sssssssss',
            $firstName,
            $lastName,
            $phoneNumber,
            $homeTown,
            $contactAddress,
            $email,
            $gender,
            $imagePath,
            $submissionDate
        );
        $statement->execute();
        $statement->close();
    } catch (mysqli_sql_exception $exception) {
        if ($uploadedFile !== null && is_file($uploadedFile)) {
            unlink($uploadedFile);
        }
        Logger::error('Record insertion failed', $exception);
        http_response_code(500);
        exit('The record could not be saved. Please try again later.');
    }
}

try {
    $sql = $mysqli->query('SELECT * FROM `fika_admin` ORDER BY id ASC');
} catch (mysqli_sql_exception $exception) {
    Logger::error('Record listing failed', $exception);
    http_response_code(500);
    $databaseError = true;
    $sql = null;
}
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
                 if ($databaseError) { ?>
                <td colspan="10">Records are temporarily unavailable. Please try again later.</td>
                <?php } elseif ($sql->num_rows > 0 ) {
                 
                while ($row = $sql->fetch_assoc()): ?>
                <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['last_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['phone_number'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['home_town'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['contact_address'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                  <table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5"> 

                    <tbody>

   
                     <tr> 

                        <td> 

  

                           <img src="<?php echo htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'); ?>" width="100" heigh="200" align="right" alt="Indigene">

 

                         </td> 

                       </tr> 

                    </tbody>
                   </table> 
                </td>
                <td><?php echo htmlspecialchars($row['submission_date'], ENT_QUOTES, 'UTF-8'); ?></td>
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
