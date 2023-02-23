<?php  

 $host="localhost"; 
 $databasename="fika"; 
 $user="root"; 
 $pass=""; 

$mysqli = new mysqli($host,$user,$pass,$databasename);    

if(!$mysqli){
	echo "connection failed " ;
}else{

}

 ?> 
