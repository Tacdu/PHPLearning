<?php include 'func.inc.php'; ?>

 <html
     
     <head
         <title>Search</title>
     </head>
     
     <body>
         
         <h2>Search</h2>
         
         <form action="" method="POST">
             <P>
                 <input type="text" name="keywords"/> <input type="submit" value="Search"/>
                 
             </P>
         </form>
    <?php 
    if(isset($_POST['keywords'])){
        $keywords = mysqli_real_escape_string($conn,htmlentities(trim($_POST['keywords'])));
        
        $errors = array();
        
        if (empty($keywords)){
            $errors[] = 'Please enter a Book name or related details to search';
        } else if (search_results($conn,$keywords)===false){
            $errors[] = 'No Book found with search term ' .$keywords. ', pleases try a different term to search';
        }
    
        if (empty($errors)){
            
            echo '<pre>', print_r (search_results($conn,$keywords)), '</pre>';
                      
        } else {
            foreach ($errors as $error){
                echo $error, '</br>';
            }
        }
    }
    ?>
     </body>
 </html>

