<?php
	ob_start();
	session_start();
	$pageTitle = 'اجازه لرعايه طفل ';
	include 'init.php';
    // Page Content



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	
if(isset($_POST['submit2'])) {
	
	
echo'
<embed src="http://example.com/the.pdf" width="500" height="375" 
 type="application/pdf">

';
	
	
}




		if(empty($_POST['num']) ) {

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
/*
if($info['NUM_OF_DAY'] - $num1 == 0 || $info['NUM_OF_DAY'] - $num1 < 0 ){
	$x="ناسف لعدم الاستجابه لطلبك لان عدد ايام الاجازه المتبقيه لديك = ".$info['NUM_OF_DAY'];
echo '<br><br><div id="info-message" class="alert alert-danger">'.$x.' </div>';
exit();
	
}*/
}





 $vacancyno = isset($_GET['vactionid']) ? $_GET['vactionid'] : '1';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		
		

		
		
		
		
		
		
		
		
		
		
		
		
	$formErrors = array();

	
	                $num = $_POST['num'];
					 $start = $_POST['start'];
	                $end = $_POST['end'];
	                $cos = $_POST['cos'];
	                $type = " اجازه لرعايه طفلا";

 $report="تحيه طيب وبعد <br> مقدم لسيادتكم من عضو هيئه التدريس بجامعه بنها <br> اتشرف بعرض الاتي <br> ارجو من سيادتكم التكرم بالموافقه على اعطائى  , تجديد , اعطائى اجازه '.$type .'
 لمده '.$num . '
 <br> تبدا من تاريخ '.$start . '
 <br> وتنتهى فى تاريخ '.$end . '
 <br> بسبب '.$cos . '
 <br> والتفضل بالتلبيه باتخاذ اللازم والتفضل بقبول فائق الاحترام
 ";






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
					echo '<br><br>';
					echo 'الصيغه التى سيتم ارسال الطلب بها ';
echo '<br><br>';
					
echo $report;					
					

echo '<br><br>';

	


echo "<td>
									
   <a href='pdfar/pdf/ar6.php?do=Delete&num=" . $num .
"&start=" . $start .
"&end=" . $end .
"&cos=" . $cos .
"&type=" . $type .
"&report=" . $report . 
   


" ><i class='fa fa-close'></i> print </a>";	
					
					
					}
			

	

		}
?>


<div class="qequest_form">
        <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data"> 
                 <input type="hidden" name="vaction"  value="<?php echo $vacancyno ?>" >
                                    <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">طلب  كتابيا للموافقه على  اجازه لرعايه طفلا </label>
	          <label class="col-sm-6 control-label">سيتم ارسال طلب الاجازه بالصيغه الرسميه </label>
<br>

                                    
									
									
									
									
								   <div class="col-sm-12 col-md-12">

								
                                        <label class="col-md-12">عدد ايام الاجازه </label>
      <input  type="text" name="num"  class="form-control form-control-line">
									
			
 
    <label class="col-md-12">تبدا من تاريخ  </label>
      <input  type="text" name="start"  class="form-control form-control-line">
	      <label class="col-md-12">تنتهى فى تاريخ </label>
      <input  type="text" name="end"  class="form-control form-control-line">
   <label class="col-md-12">الاسباب</label>
      <input  type="text" name="cos"  class="form-control form-control-line">


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

                                    <!-- End Tags Field -->
                                    <!-- Start Submit Field -->
                                  
									  <div class="form-group form-group-lg">
                                        <div class="col-sm-offset-3 col-sm-9">
<a href="one.php?pdf=1" class="btn btn-primary btn-sm">قوانين الاجازه</a>

                                        </div>
										
									<div class="col-sm-offset-3 col-sm-9">
                                        </div>	
										
										
                                    </div>
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
