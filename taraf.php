
<?php
	ob_start();
	session_start();
	$pageTitle = 'اجازه الوضع  ';
	include 'init.php';
    // Page Content
if(isset($_SESSION['uid'])){
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
	$formErrors = array();

                $report		= filter_var($_POST['description'], FILTER_SANITIZE_STRING);
		
				// Insert Userinfo In Database

				$stmt = $con->prepare("INSERT INTO 
          
    taraf(Description , Doctorid)

					VALUES(:zreport,:zdoc)");

				$stmt->execute(array(

					'zreport' 	=> $report ,
					'zdoc' 	=> $_SESSION['uid'],

				));

				// Echo Success Message

				if ($stmt) {

      $succesMsg =  'تم أرسال  الطلب  بنجاح فى  انتظار  موافقه أعضاء هيئه التدريس  ' ;
					
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
}
?>

<div class="qequest_form">
        <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">  
            
            <input type="hidden" name="vaction"  value="<?php echo $vacancyno ?>" >
                                    <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">طلب  كتابيا للموافقه على  اخلاء  طرف   </label>
                                        <div class="col-sm-10 col-md-9">
                                            <textarea 
                                                
                                                name="description" 
                                                class="form-control live"  
                                              
                                                required ></textarea>
                                        </div>
                                    </div>
                                    <!-- End Name Field -->
                   
            
                                    <!-- End Image Field -->

                                    <!-- End Tags Field -->
                                    <!-- Start Submit Field -->
                                    <div class="form-group form-group-lg">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <input type="submit" value="اضافه الطلب  " class="btn btn-primary btn-sm" />
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
