<?php
	ob_start();
	session_start();
	$pageTitle = 'أجازه خاصه  ';
	include 'init.php';
    // Page Content
	
	
	
	
	

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(empty($_POST['num'])) {

echo '<div id="info-message" class="alert alert-success">num of day is empty</div>';
exit();
}





 $GLOBALS['num1']= $_POST['num'];
 
               $num = $_POST['num'];
					 $start = $_POST['start'];
	                $end = $_POST['end'];
	                $cos = $_POST['cos'];
	                $type = "الخاصه لمرافقه الزوج او الزوجه";

 $description="تحيه طيب وبعد <br> مقدم لسيادتكم من عضو هيئه التدريس بجامعه بنها <br> اتشرف بعرض الاتي <br> ارجو من سيادتكم التكرم بالموافقه على اعطائى  , تجديد , اعطائى اجازه '.$type .'
 لمده '.$num . '
 <br> تبدا من تاريخ '.$start . '
 <br> وتنتهى فى تاريخ '.$end . '
 <br> بسبب '.$cos . '
 <br> والتفضل بالتلبيه باتخاذ اللازم والتفضل بقبول فائق الاحترام
 ";
 
 
 
 
 
 


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
              $vacancyno = $_POST['vaction'];
              //  $description = $_POST['description'];
			    $product_Name = $_FILES['marrige']['name'] ;
                $product_Type = $_FILES['marrige']['type'] ;
                $product_Size = $_FILES['marrige']['size'] ;
                $product_temp = $_FILES['marrige']['tmp_name'] ;
                $product_extenstion = array ("png","jpg","jpeg","gif","pdf") ;
                $product_real = explode('.' ,$product_Name); 
                $product_real_extens=  end($product_real);
                $product_real_extension =strtolower($product_real_extens) ;
                $product_real_name = rand( 0  , 100000). '_' . $product_Name  ;

                  
                move_uploaded_file($product_temp , "admin\uploads\\vaction\\". $product_real_name) ;

        
        	    $visa_Name = $_FILES['visa']['name'] ;
                $visa_Type = $_FILES['visa']['type'] ;
                $visa_Size = $_FILES['visa']['size'] ;
                $visa_temp = $_FILES['visa']['tmp_name'] ;
                $visa_extenstion = array ("png","jpg","jpeg","gif","pdf") ;
                $visa_real = explode('.' ,$product_Name); 
                $visa_real_extens=  end($product_real);
                $visa_real_extension =strtolower($product_real_extens) ;
                $visa_real_name = rand( 0  , 100000). '_' . $product_Name  ;

                move_uploaded_file($visa_temp , "admin\uploads\\vaction\\". $visa_real_name) ;

              
        
        
        
        
               	$work_permit_Name = $_FILES['work_permit']['name'] ;
                $work_permit_Type = $_FILES['work_permit']['type'] ;
                $work_permit_Size = $_FILES['work_permit']['size'] ;
                $work_permit_real_name_temp = $_FILES['work_permit']['tmp_name'] ;
                $work_permit_extenstion = array ("png","jpg","jpeg","gif","pdf") ;
                $work_permit_real = explode('.' ,$product_Name); 
                $work_permit_real_extens=  end($product_real);
                $work_permit_real_extension =strtolower($product_real_extens) ;
                $work_permit_real_name = rand( 0  , 100000). '_' . $product_Name  ;

                move_uploaded_file($work_permit_real_name_temp , "admin\uploads\\vaction\\". $work_permit_real_name) ;
        
        
               	$residence_Name = $_FILES['residence']['name'] ;
                $residence_Type = $_FILES['residence']['type'] ;
                $residence_Size = $_FILES['residence']['size'] ;
                $residence_temp = $_FILES['residence']['tmp_name'] ;
                $residence_extenstion = array ("png","jpg","jpeg","gif","pdf") ;
                $residence_real = explode('.' ,$product_Name); 
                $residence_real_extens=  end($product_real);
                $residence_real_extension =strtolower($product_real_extens) ;
                $residence_real_name = rand( 0  , 100000). '_' . $product_Name  ;

                move_uploaded_file($residence_temp , "admin\uploads\\vaction\\". $residence_real_name) ;

        
          	$contract_Name = $_FILES['contract']['name'] ;
                $contract_Type = $_FILES['contract']['type'] ;
                $contract_Size = $_FILES['contract']['size'] ;
                $contract_temp = $_FILES['contract']['tmp_name'] ;
                $contract_extenstion = array ("png","jpg","jpeg","gif","pdf") ;
                $contract_real = explode('.' ,$product_Name); 
                $contract_real_extens=  end($product_real);
                $contract_real_extension =strtolower($product_real_extens) ;
                $contract_real_name = rand( 0  , 100000). '_' . $product_Name  ;

                move_uploaded_file($contract_temp , "admin\uploads\\vaction\\". $contract_real_name) ;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
			
				// Insert Userinfo In Database

				$stmt = $con->prepare("INSERT INTO 
          
          vaction_requests(facultyid,num_of_day,report_child_care ,Marriage_certificate,visa 
		  ,work_permit ,residence,contract ,  Add_Date , vaction_ID , Doctor_ID)

					VALUES(:facultyid,:num,:zdesc , :zmarrige , :zvisa 
					,:zwork ,:zresidence,:zcontract ,  now() , :zvac,:zdoc)");

				$stmt->execute(array(
				'facultyid' 	=> $_SESSION['facultyid']	,
				     'num' 	=> $num ,
                    'zdesc' =>$description , 
					'zmarrige' 	=> $product_real_name ,
                    'zvisa' =>$visa_real_name ,
					'zvac' 	=>   $vacancyno ,
                    'zwork' => $work_permit_real_name ,
                    'zresidence' => $residence_real_name ,
					 'zcontract' => $contract_real_name ,

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
				
echo '<br><br>';
					echo 'الصيغه التى سيتم ارسال الطلب بها ';
echo '<br><br>';
					
echo $description;					
					

echo '<br><br>';

	


echo "<td>
									
   <a href='pdfar/pdf/ar6.php?do=Delete&num=" . $num .
"&start=" . $start .
"&end=" . $end .
"&cos=" . $cos .
"&type=" . $type .
"&report=" . $description . 
   


" ><i class='fa fa-close'></i> print </a>";	
					
					














				}
			

	

		}
?>

















<div class="qequest_form">
        <form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">  
                        
            <input type="hidden" name="vaction"  value="<?php echo $vacancyno ?>" >
                                    <!-- Start Name Field -->
            <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">طلب  كتابيا للموافقه على  اجازه خاصه  </label>
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
                                        <label class="col-sm-9 control-label">مستند إثبات الزوجية ( قسيمة الزواج أو صورة معتمدة- إقرار بإستمرار العرقة الزوجية معتمد) </label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="marrige"
                                    />
                                        </div>
                                    </div>
                                    <!-- End Image Field -->
                 <div class="form-group form-group-lg">
                                        <label class="col-sm-9 control-label">صورة معتمدة من تأشيرة عمل الزوج المطلوب مرافقته مثبتة رسمياً بجواز السفر.</label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="visa"
                                    />
                                        </div>
                                    </div>
                 <div class="form-group form-group-lg">
                                        <label class="col-sm-9 control-label">صورة معتمدة معتمدة من تصريح عمل الزوج المطلوب مرافقته.  </label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="work_permit"
                                    />
                                        </div>
                                    </div>
            
                 <div class="form-group form-group-lg">
                                        <label class="col-sm-9 control-label"> نسخة موثقة من عقد عمل الزوج المطلوب مرافقته أو صورة معتمدة منها. </label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="product_image"
                                    />
                                        </div>
                                    </div>
            
                 <div class="form-group form-group-lg">
                                        <label class="col-sm-9 control-label">صورة طبق الأصل معتمدة من إقامة حديثة وسارية خاصة بالزوج المطلوب مرافقته وتتضمن أنه يعمل بالاضافة إلي المستنداب الواردة في البند</label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="residence"
                                    />
                                        </div>
                                    </div>
            
                 <div class="form-group form-group-lg">
                                        <label class="col-sm-9 control-label">تقديم ما يثبت أنه مقيم بذات الدولة التي يعمل بها الزوج/ الزوجة مع بيان طبيعة الاقامة.</label>
                                        <div class="col-sm-10 col-md-9">
                                           <input
                                            class="form-control"
                                            type="file"
                                            name="contract"
                                    />
                                        </div>
                                    </div>
            
     <div class="form-group form-group-lg">
                                        <div class="col-sm-offset-3 col-sm-9">
<a href="one.php?pdf=2" class="btn btn-primary btn-sm">قوانين الاجازه</a>

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
