
<?php   include 'database_fika.php'; ?> 
  

<!DOCTYPE html>
<html>
<head>
	<title>Fika Indegine</title>
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
    #top_header{
     overflow: auto;
 	 padding: 15px;
 	}
 	#top_menu{
 	 background: green;
 	 color: white;
 	}
 	#top_menu li{
 	 display: inline-block;
 	 padding: 10px;
 	 list-style: none;
 	 font: bold 14px tahoma;  
 	}
    #new_div{
    	display: -webkit-box
    	-webkit-box-orient: horizontal;
    }
    #right_side{
    	border: 2px solid lightgreen;
    	-webkit-box-flex: 1;
    	padding: 20px;
    	margin: 20px;
    	float: left;
    	background: green;
    	color: white;
    	border-radius: 7px;
    	box-shadow: 7px 7px 5px #011111;
    }
    #left_side{
    	border: 1px solid green;
    	width: 220px;
    	padding: 20px 0;
    	margin: 30px;
    	background:  lightgreen;
        float: left;
        -webkit-box-flex: 1;
    }
    #fooo{
    	text-align: center;
    	padding: 20px;
    	border-top: 2px solid green;
    }
    #top_link{
    	float: right;
		margin-top: -15px;
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
    #top_serch input{
    	width: 700px;
    	border-radius: 5px;
    	border: 2px solid green;
    	height: 35px;
    	padding: 5px 5px;
    	overflow: auto;
    	margin-left: 20px;
    }
    #top_serch button{
    	color: white;
    	background: green;
    	height: 35px;
    	width: 50px;
    	border-radius: 7px;
    	overflow: auto;
    }
    #fl input{
    	display: inline-block;
    	width: 250px;
    	border-radius: 7px;
    	height: 25px;
    }
    #hc input{
    	display: inline-block;
    }
    #pnumber input{
    	width: 510px;
    	height: 25px;
    	border-radius: 7px;
    }
    #hc input{
    	width: 250px;
    	height: 25px;
    	border-radius: 7px;

    }
    #e input{
    	width: 510px;
    	height: 25px;
    	border-radius: 7px;
    }
    #gp{
    	border: 2px solid white;
    	border-radius: 7px;
    	width: 500px;
    	height: 100px;

    }

    button{
    	background:   blue;
    	color:  white;
    	font: 14px tahoma;
    	width: 510px;
    	height: 30px;
    	border-radius: 7px;
    }
     #gp .input{
     	width: 200px;
     	height: 25px;
     	border-radius: 7px;
     }
    #general_form input{
     	text-align: center;
     }
    a:hover{
        color: yellow;
    }

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
	   

	<div id="new_div">
		
		<section id="right_side" >

			<form  role="form" method="post" action="Record_fika.php" enctype="multipart/form-data">
				<div id="general_form">
					<div id="fl">
		        <P style="text-align: center; margin-bottom: 15px; font: 20px tahoma;"> REGISTRATION FORM </P>
		     	    
		     	     
		     		     <input type="text" name="fname" placeholder="First Name" class="input" id="fname">
		     
                 
		     	     
		     	        
		     	          <input type="text" name="lname" placeholder="Last Name" class="input" id="fname">
                   </div>
                 <br>  
                 <div id="pnumber">
		     	    
		     	        
		     	            <input type="number" name="pnumber" placeholder="Phone Number" class="input" id="pnumber">
		         </div> 
		                                 

		        <div id="hc">
		     	    <br> 
		     	        
		                	<input type="text" name="htown" placeholder="Home Town" class="input" id="Htown">
                                        
		     	            <input type="text" name="caddress" placeholder="Contact Address" class="input" id="Caddress ">
		                
		       </div>

		        <br>
		        <div id="e">
		     	     		     	         
		            <input type="email" name="email"  placeholder="Email" class="input" id="email">
                        
                </div>
                           <br>
               <div id="gp">
              	   <br> 
		     	        
		     	            <select name="gender" class="input">
		     	 	            <option>Choice Gender</option>
		     	             	<option value="Male">Male</option>
		     	 	            <option value="Female">Female</option>
		     	            </select>
		     	 
		     	 
		     		 <br><br>
		     		 
		     		<input type="file" name="userfile"  class="input">

		           <br><br><br>
		     		 
                </div>

<br><br>
		     	 <button type="submit" name="submit">Submit</button>
		     	 
            </form>
		</section>
     
		<aside id="left_side">
			<marquee><p>Hello Welcome to Online keeping indigene record for Fika Local Government Yobe State Portal</p></marquee>
		</aside>

	</div>


		<div id="fooo">
			Copyright &copy; 2014 Fika Local Government
			
		</div>
	
    
     </div>
</body>
</html>
