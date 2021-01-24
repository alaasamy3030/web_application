<?php
	ob_start();
	session_start();
$nosidebar = '' ;
	$pageTitle = 'Login';
	if (isset($_SESSION['user'])) {
		header('Location: index.php');
	}
	include 'init.php';

	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['login'])) {

			$user = $_POST['username'];
			$pass = $_POST['password'];
			$hashedPass = sha1($pass);

			// Check If The User Exist In Database

			$stmt = $con->prepare("SELECT 
										UserID, Username, Password 
									FROM 
										users 
									WHERE 
										Username = ? 
									AND 
										Password = ?");

			$stmt->execute(array($user, $hashedPass));

			$get = $stmt->fetch();

			$count = $stmt->rowCount();

			// If Count > 0 This Mean The Database Contain Record About This Username

			if ($count > 0) {

				$_SESSION['user'] = $user; // Register Session Name

				$_SESSION['uid'] = $get['UserID']; // Register User ID in Session

				header('Location: login.php'); // Redirect To Dashboard Page

				exit();
			}

		} else {

			$formErrors = array();

			$username 	= $_POST['username'];
			$email 		= $_POST['email'];
            $faculty =  $_POST['faculty'];
            $session  =  $_POST['session'];
            $specilization  = $_POST['specilization'] ; 
            $ide = $_POST['ide'] ; 
            $position  = $_POST['position'] ;

			if (isset($username)) {

				$filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

				if (strlen($filterdUser) < 4) {

					$formErrors[] = 'Username Must Be Larger Than 4 Characters';

				}

			}

		

			if (isset($email)) {

				$filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

				if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {

					$formErrors[] = 'This Email Is Not Valid';

				}

			}

			// Check If There's No Error Proceed The User Add

			if (empty($formErrors)) {

				// Check If User Exist in Database

				$check = checkItem("Username", "users", $username);

				if ($check == 1) {

					$formErrors[] = 'Sorry This User Is Exists';

				} else {

					// Insert Userinfo In Database

					$stmt = $con->prepare("INSERT INTO 
											users(Username, Email,facultyid , specialization , IDe , position, RegStatus, Date)
										VALUES(:zuser, :zmail,:zfac , :zspec , :zide , :zpos , 0, now())");
                    
					$stmt->execute(array(

						'zuser' => $username,
						'zmail' => $email ,
                        'zspec' => $specilization , 
                        'zide' => $ide , 
                        'zpos' => $position ,
                        'zfac' =>$faculty 
                        
                        
                        

					));

					// Echo Success Message

					$succesMsg = 'تم  طلب  الحساب  نجاح  من  اداره الجامعه انتظر  للرد من  الجامعه خلال  البريد الالكترونى ';

				}

			}

		}

	}

?>


	<!-- End Login Form -->
			<div class="container">
			<div class="register">
			   <h6 class="text-center">نموذج طلب إنشاء بريد إلكتروني لاول مرة</h6>
				<div class="main-login main-center">
					<form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">الاسم  باللغة العربية</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input 
						pattern=".{4,}"
						title="Username Must Be Between 4 Chars"
						class="form-control" 
						type="text" 
						name="username" 
						autocomplete="off"
					
					 />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">بريد الكترونى بديل  للارسال  اليوزر  والباص عليه </label>
							<div class="cols-sm-10">
								<div class="input-group">
						
								<input 
				class="form-control" 
				type="email" 
				name="email" 
				 />
								</div>
							</div>
						</div>

	<!-- Start Categories Field -->
					<div class="form-group form-group-lg">
						<label class="col-sm-2 control-label">الكليه </label>
						<div class="col-sm-10 col-md-6">
							<select class= "form-control" name="faculty">
								<option value="0">...</option>
								<?php
									$allCats = getAllFrom("*", "faculty", "", "", "F_ID");
									foreach ($allCats as $cat) {
										echo "<option value='" . $cat['F_ID'] . "'>" . $cat['Name'] . "</option>";

									}
								?>
							</select>
						</div>
					</div>
					<!-- End Categories Field -->

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">القسم </label>
							<div class="cols-sm-10">
								<div class="input-group">
					
								<input 
				minlength="4"
				class="form-control" 
				type="text" 
				name="session" 
				
				 />
								</div>
							</div>
						</div>
                        
                        
						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">التخصص </label>
							<div class="cols-sm-10">
								<div class="input-group">
								
								<input 
				minlength="4"
				class="form-control" 
				type="text" 
				name="specilization" 
			
				
				 />
								</div>
							</div>
						</div>
                            
						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">الرقم القومى   </label>
							<div class="cols-sm-10">
								<div class="input-group">
									
								<input 
				minlength="4"
				class="form-control" 
				type="text" 
				name="ide" 
		

				 />
								</div>
							</div>
						</div>    
                    	<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">الدرجه العلميه    </label>
							<div class="cols-sm-10">
								<div class="input-group">

								<input 
				minlength="4"
				class="form-control" 
				type="text" 
				name="position" 
	
		
				 />
								</div>
							</div>
						</div>    
                        
                        

						<div class="form-group ">
							<button type="submit" class="btn btn-primary btn-lg btn-block login-button">طلب  الحساب </button>
						</div>
					
					</form>
				</div>
			</div>
		</div>


	<div class="the-errors text-center">
		<?php 

			if (!empty($formErrors)) {

				foreach ($formErrors as $error) {

					echo '<div class="msg error">' . $error . '</div>';

				}

			}

			if (isset($succesMsg)) {

				echo '<div class="msg success">' . $succesMsg . '</div>';

			}

		?>
	</div>
</div>

<?php 
	include $tpl . 'footer.php';
	ob_end_flush();
?>