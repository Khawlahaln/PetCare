<?php  
    session_start();

    if(!isset($_SESSION['email'])) {
		header("location: login.php");
		exit();
	}
?>  

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Edit About us information</title>
        <link rel="stylesheet" href="homePageStyle-manger-editAboutUS.css">
    </head>
    
    <body>
        
        <div class="grid">
            
            <div class="nav-bar">
            <ul>
                <li><img src="logo.png" alt="logo" class="nav-bar-logo" ></li>
                <li class="nav-bar-item"><a href="home%20page.php">Log Out</a></li>
                <li class="nav-bar-item"><a href="manage%20appointments.php">Appointments</a></li>
                <li class="nav-bar-item" id="active"><a href="home%20page-manger.php">Home</a></li>
            </ul>
        </div>
            
            
      <div class="grid-about-us">
        <div class="card">
          <div class="card-content">
            <h1 class="card-header"><strong>ABOUT US</strong></h1>
              
        <form role="form" method="post" action="home%20page-manger-editAboutUS.php"> 
            <label>Picture:</label>
                <input type="file" id="file" class="box-img" name="photo">
              
            <label>Description:</label><br>
              <textarea name="description" rows="18" cols="50" maxlength="250"></textarea><br>
             
            <label>Location:</label>
            <input name="location" type="text" maxlength="60" size="50%" style="height: 30px;margin-bottom: 20px;">
            
            <div class="controlBtn-about">
                <input type="submit" value="Save" name="aboutUS">
                <input type="reset" value="Clear" >
                <a href="home%20page-manger.php"><input type="button" value="Cancel"></a>
            </div>
              </form>
              
          </div>
        </div>
      </div>
            
            <div class="service-title" >
                <h1>Our Services</h1>
            </div>
            <a href="addservice.php" class="add-serv" >Add service</a>
                
    <div class="services">
        
          <?php
        
        if (!( $database = mysqli_connect( "localhost", "root", "" )))
        die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "webpro" ))
        die( "<p>Could not open URL database</p>" );
            
       $sql2 = "SELECT * FROM `service`;";
    
       $result = mysqli_query($database, $sql2);

       if ($result) {
                     
           while ($data = mysqli_fetch_row($result)) {
               Print "<div class='serv' ><div class='card-image' style='background-image: url($data[1])'></div><div class='card-text1'><h2>". $data[0]."</h2><p>".$data[2]."</p></div><div class='card-stats'><div class='type'>price</div><div class='value'>".$data[3]."SR</div></div></div>"; 
            }
        }

        else
        echo "There are no Services.";
?>  
            
            </div></div>
    </body>
</html>


<?php  
    if (!( $database = mysqli_connect( "localhost", "root", "" )))
        die( "<p>Could not connect to database</p>" );

    if (!mysqli_select_db( $database, "webpro" ))
        die( "<p>Could not open URL database</p>" );

    if(isset($_POST['aboutUS'])) {  
        if($_POST['photo']!="" && $_POST['description']!="" && $_POST['location']!=""){
        $photo=$_POST['photo'];    
        $description=$_POST['description'];
        $location=$_POST['location'];
        
        $sql = "UPDATE `veterinary` SET `photo` = '$photo', `location` = '$location' , `description` = '$description' WHERE `veterinary`.`email` = '".$_SESSION['email']."';";}
        
         else if ($_POST['photo']!="" && $_POST['description']!=""){
           $photo=$_POST['photo'];    
            $description=$_POST['description'];
        
            $sql = "UPDATE `veterinary` SET `photo` = '$photo', `description` = '$description' WHERE `veterinary`.`email` = '".$_SESSION['email']."';";  
             
         }
          else if ($_POST['photo']!="" && $_POST['location']!=""){
           $photo=$_POST['photo'];    
           $location=$_POST['location'];
        
            $sql = "UPDATE `veterinary` SET `photo` = '$photo', `location` = '$location'  WHERE `veterinary`.`email` = '".$_SESSION['email']."';";  
             
         }
        
         else if ($_POST['description']!="" && $_POST['location']!=""){
           $location=$_POST['location'];  
            $description=$_POST['description'];
        
            $sql = "UPDATE `veterinary` SET description` = '$description', `location` = '$location'  WHERE `veterinary`.`email` = '".$_SESSION['email']."';";  
             
         }
        
         else if ($_POST['photo']!=""){
           $photo=$_POST['photo'];    
                   
            $sql = "UPDATE `veterinary` SET `photo` = '$photo' WHERE `veterinary`.`email` = '".$_SESSION['email']."';";       
         }
        
         else if ($_POST['description']!=""){ 
            $description=$_POST['description'];
        
            $sql = "UPDATE `veterinary` SET `description` = '$description' WHERE `veterinary`.`email` = '".$_SESSION['email']."';";  
             
         }
        
         else if ($_POST['location']!=""){
           $location=$_POST['location'];  
        
            $sql = "UPDATE `veterinary` SET `location` = '$location'  WHERE `veterinary`.`email` = '".$_SESSION['email']."';";       
         }
        
        if($_POST['photo']=="" && $_POST['description']=="" && $_POST['location']==""){
            echo "<script>alert('You did not edit anything!')</script>"; 
        }
                 
         
else{
        if(mysqli_query($database, $sql)) {  
            header("location: home%20page-manger.php");
        } else {
             echo "<script>alert('Somthing wrong')</script>"; 
            }
    } } 
?>  