
<?php
	ob_start();
	session_start();
	$pageTitle = 'اجازه  وضع ';
	include 'init.php';
    // Page Content
	
	
	
	

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(empty($_POST['num'])) {

echo '<div id="info-message" class="alert alert-success">num of day is empty</div>';
exit();
}



 $GLOBALS['num1']= $_POST['num'];


$getUser = $con->prepare("SELECT * FROM users WHERE UserID = ?");
		$getUser->execute(array($_SESSION['uid']));
		$info = $getUser->fetch();
		//$n_d = $info['NUM_OF_DAY'];

if($info['NUM_OF_DAY'] == 0){
	
echo '<div id="info-message" class="alert alert-danger"> ناسف لعدم الاستجابه لان عدد ايام الاجازات لديك = صفر </div>';
exit();
	
}

if($info['NUM_OF_DAY'] - $num1 == 0 || $info['NUM_OF_DAY'] - $num1 < 0 ){
	$x="ناسف لعدم الاستجابه لطلبك لان عدد ايام الاجازه المتبقيه لديك = ".$info['NUM_OF_DAY'];
echo '<br><br><div id="info-message" class="alert alert-danger">'.$x.' </div>';
exit();
	
}
}
	
	

	
	
	
     $vacancyno = isset($_GET['vactionid']) ? $_GET['vactionid'] : '1';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {		        
	$num = $_POST['num'];

	$formErrors = array();
                $report		= filter_var($_POST['description'], FILTER_SANITIZE_STRING);
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

				$stmt = $con->prepare("INSERT INTO 
          
          vaction_requests(facultyid,num_of_day,report_child_care, birth_certificate, Add_Date , vaction_ID , Doctor_ID)

					VALUES(:facultyid,:num,:zreport, :zcert, now() , :zvac,:zdoc)");

				$stmt->execute(array(
				'facultyid' 	=> $_SESSION['facultyid']	,
 'num' 	=> $num ,
					'zreport' 	=> $report ,
					'zcert' 	=> $product_real_name ,
					'zvac' 	=>   $vacancyno ,
					'zdoc' 	=> $_SESSION['uid'],

				));

				// Echo Success Message

				// Echo Success Message

				if ($stmt) {

/*
$getUser = $con->prepare("SELECT * FROM users WHERE UserID = ?");
		$getUser->execute(array($_SESSION['uid']));
		$info = $getUser->fetch();
		//$n_d = $info['NUM_OF_DAY'];
//////////////////////////////////
$Balance=$info['NUM_OF_DAY']-$num;

	$stmt = $con->prepare("UPDATE users SET NUM_OF_DAY = ?  WHERE UserID = ?");

	$stmt->execute(array($Balance  ,   $_SESSION['uid']));

*/



		
		


///////////////////////////////////////////

      $succesMsg =  'تم أرسال  الطلب  بنجاح فى  انتظار  موافقه  رئيس  القسم  و العميده ' ;
					
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
                                    <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">طلب  كتابيا للموافقه على  اجازه لرعايه طفلا </label>
                                        <div class="col-sm-10 col-md-9">
                                            <textarea 
                                                
                                                name="description" 
                                                class="form-control live"  
                                              
                                                required ></textarea>
                                        </div>
                                    </div>
                                    <!-- End Name Field -->
                   
                                    <div class="form-group form-group-lg">
                                        <label class="col-sm-3 control-label">صوره من شهاده ميلاد الطفل</label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="product_image"
                                    />
                                        </div>
                                    </div>
                                    <!-- End Image Field -->


 <div class="form-group form-group-lg">
                                        <div class="col-sm-offset-3 col-sm-9">
<a href="one.php?pdf=3" class="btn btn-primary btn-sm">قوانين الاجازه</a>

                                        </div>
										
									<div class="col-sm-offset-3 col-sm-9">
                                        </div>	
										
										
                                    </div>




                                    <!-- End Tags Field -->
                                    <!-- Start Submit Field -->
                                    <div class="form-group form-group-lg">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <input type="submit" value="اضافه الطلب  " class="btn btn-primary btn-sm" />
                                        </div>
                                     <div class="col-sm-12 col-md-12">

								
                                        <label class="col-md-12">عدد ايام الاجازه </label>
      <input  type="text" name="num"  class="form-control form-control-line">
									
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
