
<?php
	ob_start();
	session_start();
	$pageTitle = 'اجازه لرعايه طفل ';
	include 'init.php';
    // Page Content
 
	
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	          $name = $_POST['name'] ; 
              $location = $_POST['location'] ; 
              $time  = $_POST['time'] ; 
              $description  = $_POST['description'] ; 
        
             
				// Insert Userinfo In Database

				$stmt = $con->prepare("INSERT INTO 
          
          conferance(facultyid,Name, description,date , location,userid)

              VALUES(:facultyid,:zname, :zdes, now() ,:zlocation ,:zdoc)");

				$stmt->execute(array(	
				'facultyid' 	=> $_SESSION['facultyid']	,
					'zname' 	=> $name ,
                    'zdes' 	=> $description ,
                    'zlocation' 	=> $location  ,
					'zdoc' 	=> $_SESSION['uid'],

				));

				// Echo Success Message

				if ($stmt) {

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
       <label class="col-sm-6 control-label">الموتمر  بعنوان </label>
                                        <div class="col-sm-10 col-md-9">
                                            <input  
                                                name="name" 
                                                class="form-control live"  
                                                 >
                                        </div>
                                    </div>
                                    <!-- End Name Field -->
            
            <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">نبذه عن المؤتمر </label>
                                        <div class="col-sm-10 col-md-9">
                                            <textarea  
                                                
                                                name="description" 
                                                class="form-control live"  
                                                      ></textarea>
                                        </div>
                                    </div>
                                    <!-- End Name Field -->
            
            
            
            <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">مكان  أنعقاد المؤتمر </label>
                                        <div class="col-sm-10 col-md-9">
                                            <input  
                                                name="location" 
                                                class="form-control live"  
                                                 >
                                        </div>
                                    </div>
                                    <!-- End Name Field -->
              <!-- Start Name Field -->
        <div class="form-group form-group-lg">
       <label class="col-sm-6 control-label">معاد  أنعقاد المؤتمر </label>
                                        <div class="col-sm-10 col-md-9">
                                            <input 
                                                type="date"
                                                name="time" 
                                                class="form-control live"  
                                                 >
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
