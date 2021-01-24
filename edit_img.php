<?php
	ob_start();
	session_start();
	$pageTitle = 'اجازه لرعايه طفل ';
	include 'init.php';
    // Page Content



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	

$getUser = $con->prepare("SELECT * FROM users WHERE UserID = ?");
		$getUser->execute(array($_SESSION['uid']));
		$info = $getUser->fetch();
		//$n_d = $info['NUM_OF_DAY'];



}





	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		
		

		
		
		
		
		
		
		
		
		
		
		
		
	$formErrors = array();

	


                $vacancyno = $_POST['vaction'];
            //    $report		= filter_var($_POST['description'], FILTER_SANITIZE_STRING);
			    $product_Name = $_FILES['product_image']['name'] ;
                $product_Type = $_FILES['product_image']['type'] ;
                $product_Size = $_FILES['product_image']['size'] ;
                $product_temp = $_FILES['product_image']['tmp_name'] ;
                $product_extenstion = array ("png","jpg","jpeg","gif","pdf") ;
                $product_real = explode('.' ,$product_Name); 
                 $product_real_extens=  end($product_real);
          $product_real_extension =strtolower($product_real_extens) ;
                $product_real_name = rand( 0  , 100000). '_' . $product_Name  ;

             
			   if (empty($product_Name )) {
                    $formErrors[] = 'Images cannot be <strong>Empty</strong>';
                }
                if ($product_Size > 41943041024 ) {
                    $formErrors[] = 'Image Is very  <strong>Big</strong>';
                }
                if ( !in_array( $product_real_extension ,  $product_extenstion ) && !empty($product_Name ) ) {
                    $formErrors[] = 'This <strong> Extention </strong> Is Not correct  ';
                }
                move_uploaded_file($product_temp , "admin\uploads\\vaction\\". $product_real_name) ;








				// Insert Userinfo In Database

			
				
				
				
						$stmt = $con->prepare("UPDATE users SET Image = ?  WHERE UserID = ?");

						$stmt->execute(array($product_real_name ,$_SESSION["UserID"]));


				// Echo Success Message

				if ($stmt) {



      $succesMsg =  'تم التعديل' ;
					
				}
        
        
					if (! empty($formErrors)) {
						foreach ($formErrors as $error) {
							echo '<div id="info-message" class="alert alert-danger">' . $error . '</div>';
						}
					}
					if (isset($succesMsg)) {
						echo '<div id="info-message" class="alert alert-success">' . $succesMsg . '</div>';
					}
			

	

		}
?>


<div class="qequest_form">
        <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data"> 
                 <input type="hidden" name="vaction"  value="<?php echo $vacancyno ?>" >
                                    <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">تعديل الصوره الشخصيه </label>
	      
<br>

                                    
									
									
									
									
								 

									
									
									
									
									                                    </div>

									
									
									
                                    <!-- End Name Field -->
                   
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">اضف الصوره</label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="product_image"
                                    />
                                        </div>
                                    </div>
                                    <!-- End Image Field -->

                                    <!-- End Tags Field -->
                                    <!-- Start Submit Field -->
                                  
									
									  <div class="form-group form-group-lg">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <input type="submit" value="تعديل  " class="btn btn-primary btn-sm" />
                                        </div>
                                    </div>
									
									
                                    <!-- End Submit Field -->
          </form>
</div>


<script>
  setTimeout(function(){
    document.getElementById('info-message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 5000);
</script>



    <?php
        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>
