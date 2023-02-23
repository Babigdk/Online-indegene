<?php include 'database_fika.php' ?>
<?php 


    

       //query
 if (isset($_POST['button'])) {

    $search = $_POST['search'];

    $query = " SELECT * FROM `fika_admin` WHERE `first_name` like '%{$search}%' || last_name like '%{$search}%' 
    
     ";

    $sql = $mysqli->query($query) or die($mysqli->error);

                  if(mysqli_num_rows($sql) > 0 ){
                    while($rows = mysqli_fetch_array($sql)){

                     echo "<table>


                           <tr style='background: green; color: white; font: 14px tahoma; text-align: left;'>
               
                                 <th>FIRST NAME</th>
                                 <th>LAST NAME</th>
                                 <th>HOME TOWN</th>
                                 <th>PHONE NUMBER</th>
                                 <th>CONTACT ADDRESS</th>
                                 <th>EMAIL</th>
                                 <th>GENDER</th>
                                 <th>IMAGE</th>
                                 <th>SUBMISSION DATE</th>
                           </tr>

                           <tr>    
                                 <td>".$rows['first_name']."</td>
                                 <td>".$rows['last_name']."</td>
                                 <td>".$rows['home_town']."</td>
                                 <td>".$rows['phone_number']."</td>
                                 <td>".$rows['contact_address']."</td>
                                 <td>".$rows['email']."</td>
                                 <td>".$rows['gender']."</td>
                                 <td><img src=".$rows['image']." width='100' height='100'/></td>
                                 <td>".$rows['submission_date']."</td>                    
                            </tr>
                      </table>";
                    }
              }else{
                echo "No record found <br><br>";
              }
            
        
            }
           

           

 ?>


 