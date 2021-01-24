<?php
	ob_start();
	session_start();
	$pageTitle = 'Homepage';
	include 'init.php';
    // Page Content

	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'] ;
		 $_SESSION["UserID"] = $info['UserID'] ;

		$facultyid = $info['facultyid'] ;



///////////////////////////////////////

$getweb = $con->prepare("SELECT * FROM faculty WHERE F_ID = ?");
		$getweb->execute(array($facultyid));
		$info2 = $getweb->fetch();
		$web = $info2['web'] ;


////////////////////////////////////////

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
       






   















	   if(isset($_POST['edit'])){
    
				$user 	    = $_POST['user'];
				$email  	= $_POST['email']; 
					$email_ac = $_POST['email_ac']; 
$FullName = $_POST['FullName'] ;
				$phoneno 	= $_POST['phoneno'];
                $ide     	=     $_POST['ide'];
                $position  = $_POST['position'];
                $jobplace  = $_POST['job_place'] ;
                
                
                $formErrors = array();
				if (strlen($user) < 4) {
					$formErrors[] = 'Username Cant Be Less Than <strong>4 Characters</strong>';
				}

			
          
          
          
          
          	foreach($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}

          
      }else{
		  
		  if(isset($_POST['print'])){
    /*
				$user 	    = $_POST['user'];
				$email  	= $_POST['email']; 
				$phoneno 	= $_POST['phoneno'];
                $ide     	=     $_POST['ide'];
                $position  = $_POST['position'];
                $jobplace  = $_POST['job_place'] ;*/
                         $_SESSION["id"] = $_POST['job_number'];

                		$_SESSION["user1"] = $_POST['user'];
                		$_SESSION["email1"] = $_POST['email']; 
						$_SESSION["email_ac"] = $_POST['email_ac']; 
$_SESSION["FullName"] = $_POST['FullName'] ;
                		$_SESSION["phoneno1"] = $_POST['phoneno'];
                		$_SESSION["ide1"] =  $_POST['ide'];
                		$_SESSION["position1"] =$_POST['position'];
                		$_SESSION["jobplace1"] = $_POST['job_place'] ;
                		$_SESSION["job"] = $_POST['job'] ;
                		$_SESSION["date"] = $_POST['date'] ;
                		

		header("location:pdfar/pdf/ar5.php");
			
          
          
          
          
          	exit();

          
      }
		  
		  
		  
		  
	  }
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  

if (empty($formErrors)) {

					$stmt2 = $con->prepare("SELECT 
												*
											FROM 
												users
											WHERE
												Username = ?
											AND 
												UserID != ?");

					$stmt2->execute(array($user, $userid));

					$count = $stmt2->rowCount();

					if ($count == 1) {

						$theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';

						redirectHome($theMsg, 'back');

					} else { 

						// Update The Database With This Info

						$stmt = $con->prepare("UPDATE users SET FullName = ?  , Email = ?, email_ac = ?, phone = ?, position = ? ,job_place = ? WHERE UserID = ?");

						$stmt->execute(array($FullName , $email,$email_ac,  $phoneno , $position ,$jobplace ,   $userid));

						// Echo Success Message

						$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

						redirectHome($theMsg, 'back');

					}

				}

			 else {

				$theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

				redirectHome($theMsg);

			}
	

			
				// Check If There's No Error Proceed The Update Operation

				

	echo "</div>";
      
      
      }
    
?>

                <!-- sales report area start -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <center class="m-t-30">
					<img src="<?php echo 'admin\uploads\\vaction\\'.$info['Image'] ;?>" class="img-circle" width="220" />
                   <h4 class="card-title m-t-10"><?php echo $info['Username'] ?> </h4>
                   <h6 class="card-subtitle"><?php echo $info['specialization'] ?> </h6>                                    <div class="row text-center justify-content-md-center">
                   <a href=<?php echo $info2['web'] ?>>الدخول الى موقع الكليه</a><hr>
                




								 
                                    </div>    <a href="edit_img.php">تعديل الصوره الشخصيه</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="form-horizontal form-material">
                   
                                    <div class="form-group">
                                        <label class="col-md-12">الاسم بالكامل  </label>
                                        <div class="col-md-12">
      <input readonly type="text" name="FullName" value="<?php echo $info['FullName'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
									
									
									
				 <div class="form-group">
                                        <label class="col-md-12">ايميل الجامعه</label>
                                        <div class="col-md-12">
      <input readonly type="text" name="email_ac" value="<?php echo $info['email_ac'] ?>" class="form-control form-control-line">
                                        </div>
                                    </div>					
									
									
									
									
									
                                    
                                    <div class="form-group">
                                        <label class="col-md-12"> هاتف  العمل  </label>
                                        <div class="col-md-12">
 <input type="text" name="phoneno" value="<?php echo $info['phone'] ?>"  class="form-control form-control-line">
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="col-md-12">البريد الشخصى   </label>
                                        <div class="col-md-12">
     <input name="email"  value="<?php echo $info['Email'] ?>"  type="text"  class="form-control form-control-line">
                                        </div>
                                    </div>

                                      <div class="form-group">
                                        <label class="col-md-12">رقم البطاقه     </label>
                                        <div class="col-md-12">
 <input name="ide" type="text" value="<?php echo $info['IDe'] ?>" readonly  class="form-control form-control-line">
                                        </div>
                                    </div>
                    
                    
          
                    
                     <div class="form-group">
                                        <label class="col-md-12">الدرجه العلميه   </label>
                                        <div class="col-md-12">
 <input name="position" type="text" value="<?php echo $info['position'] ?>"  class="form-control form-control-line">
                                        </div>
                                    </div>
        
                    
                    
                     <div class="form-group">
                                        <label class="col-md-12"> الكليه   </label>
                                        <div class="col-md-12">
 <input name="job_place" type="text" value="<?php echo $info['job_place'] ?>"  class="form-control form-control-line">
                                   









 <input name="job" type="text" value="<?php echo $info['job'] ?>"  style="width:0px;height:0px;">

 <input name="date" type="text" value="<?php echo $info['hiring_date'] ?>"  style="width:0px;height:0px;">
 <input name="user" type="text" value="<?php echo $info['user'] ?>"  style="width:0px;height:0px;">




								   </div>
                                    </div>
                    
                    
                    

    <div class="form-group">
                                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-success" name="edit">تعديل  البيانات   </button>
                                     
                           <button type="submit" class="btn btn-success" name="print">print </button>




									 </div>
                                   
								   </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
          
            </div>
   
            </div>
        <footer>
            <div class="footer-area">
                <p>© Copyright 2019 right reserved For Bfci Team .<a>.</p>
            </div>
        </footer>
     
   
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Added</h4>
                            <span class="time"><i class="ti-time"></i>7 Minutes Ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You missed you Password!</h4>
                            <span class="time"><i class="ti-time"></i>09:20 Am</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Member waiting for you Attention</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>You Added Kaji Patha few minutes ago</h4>
                            <span class="time"><i class="ti-time"></i>01 minutes ago</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg1">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Ratul Hamba sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Hello sir , where are you, i am egerly waiting for you.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg2">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="fa fa-bomb"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                    <div class="timeline-task">
                        <div class="icon bg3">
                            <i class="ti-signal"></i>
                        </div>
                        <div class="tm-title">
                            <h4>Rashed sent you an email</h4>
                            <span class="time"><i class="ti-time"></i>09:35</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse distinctio itaque at.
                        </p>
                    </div>
                </div>
            </div>
            <div id="settings" class="tab-pane fade">
                <div class="offset-settings">
                    <h4>General Settings</h4>
                    <div class="settings-list">
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch1" />
                                    <label for="switch1">Toggle</label>
                                </div>
                            </div>
                            <p>Keep it 'On' When you want to get all the notification.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show recent activity</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch2" />
                                    <label for="switch2">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show your emails</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch3" />
                                    <label for="switch3">Toggle</label>
                                </div>
                            </div>
                            <p>Show email so that easily find you.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Show Task statistics</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch4" />
                                    <label for="switch4">Toggle</label>
                                </div>
                            </div>
                            <p>The for attribute is necessary to bind our custom checkbox with the input.</p>
                        </div>
                        <div class="s-settings">
                            <div class="s-sw-title">
                                <h5>Notifications</h5>
                                <div class="s-swtich">
                                    <input type="checkbox" id="switch5" />
                                    <label for="switch5">Toggle</label>
                                </div>
                            </div>
                            <p>Use checkboxes when looking for yes or no answers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offset area end -->

    <?php
    }else {
       header('location:login.php') ; 
    }

        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>