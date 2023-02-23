<?php
 echo '
<!DOCTYPE html>
	
<html>
<head>
	<title>Fika Indegine</title>
	 
	 <!--<link rel="stylesheet" type="text/css" href="css/css_fa.css">-->
	 <link rel="stylesheet" type="text/css" href="css_fika.css">


	 <style>

	

	</style>
</head>
<body>
	<div id="wrapper">
		
	 <header>
		<div id="top_header">
			<div id="top_link">
			<ul>
				<a href="home_fika.php"><li>Home</li></a> |
                <a href="add_fika.php"><li>Register</li></a> |
                <a href="Record_fika.php"><li>Records</li>  </a>	
			</ul>
			</div>
			  <img src="images/YARO.JPG" width="100%" height="160">
		</div>	  
	</header>	
	 <nav>
	 	<div id="top_serch">
            <form action="" method="post">
                <input type="search" name="search" >
                <button type="submit" name="button">Seach</button>
            </form>
        </div>
        
	 </nav>
 
     </div>
</body>
</html>

'; ?>
<?php   include "search.php"; ?> 