<?php 
 include("myconnection.php"); 

  

 $select_query = "SELECT images_path FROM  `images_tbl`"; 

 $sql = mysql_query($select_query) or die(mysql_error());     

 while($row = mysql_fetch_array($sql,MYSQL_BOTH)){ 
  

 ?> 


   

<table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5"> 

 <tbody>

 	 
     <tr> 

       <td> 

  

          <img src="<?php echo $row["images_path"]; ?>" width="100" heigh="200" align="right">

 

        </td> 

     </tr> 

 </tbody>
</table> 

   
  <?php 

 } 

 ?> 

