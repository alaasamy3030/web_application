<?php
	ob_start();
	session_start();
	$pageTitle = 'Login';
	$nosidebar =" " ;
	if (isset($_SESSION['user'])) {
		header('Location: index.php');
	}
	include 'init.php';

	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['login'])) {

			$user = $_POST['username'];
			$pass = $_POST['password'];
		//	$hashedPass = sha1($pass);

			// Check If The User Exist In Database

			$stmt = $con->prepare("SELECT 
										UserID, Username, Password ,facultyid
									FROM 
										users 
									WHERE 
										Username = ? 
									AND 
										Password = ?");

			$stmt->execute(array($user, $pass));

			$get = $stmt->fetch();

			$count = $stmt->rowCount();

			// If Count > 0 This Mean The Database Contain Record About This Username

			if ($count > 0) {

				$_SESSION['user'] = $user; // Register Session Name

				$_SESSION['uid'] = $get['UserID']; // Register User ID in Session
				$_SESSION['facultyid'] = $get['facultyid']; // Register User ID in Session

				header('Location: index.php'); // Redirect To Dashboard Page

				exit();
			}

		} else {

			$formErrors = array();

			$username 	= $_POST['username'];
			$password 	= $_POST['password'];
			$password2 	= $_POST['password2'];
			$email 		= $_POST['email'];

			if (isset($username)) {

				$filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

				if (strlen($filterdUser) < 4) {

					$formErrors[] = 'Username Must Be Larger Than 4 Characters';

				}

			}

			if (isset($password) && isset($password2)) {

				if (empty($password)) {

					$formErrors[] = 'Sorry Password Cant Be Empty';

				}

				if (sha1($password) !== sha1($password2)) {

					$formErrors[] = 'Sorry Password Is Not Match';

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
											users(Username, Password, Email, RegStatus, Date)
										VALUES(:zuser, :zpass, :zmail, 0, now())");
					$stmt->execute(array(

						'zuser' => $username,
						'zpass' => sha1($password),
						'zmail' => $email

					));

					// Echo Success Message

					$succesMsg = 'Congrats You Are Now Registerd User';

				}

			}

		}

	}

?>

 <!--Start  Login form --> 
    <!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
          	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="login-form-head">
                        <h4>تسجيل  الدخول </h4>
                       
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                           
                            <input type="text" placeholder="البريد الالكترونى " id="exampleInputEmail1" name="username"  >
                            <i class="ti-email"></i>
                        </div>                   
                        
                        <div class="form-gp">
                          
                            <input type="password"placeholder ="ألرقم السرى " name="password"  id="exampleInputPassword1">
                            <i class="ti-lock"></i>
                        </div>
                       
                        <div class="submit-btn-area">
                                <input name="login" id="form_submit" type="submit" value="تسجيل الدخول "> 
                        </div>
                         <div class="form-footer text-center mt-5">
                            <p class="text-muted">طلب  الحصول  على  حساب ? <a href="register1.php">عمل حساب</a></p>
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

