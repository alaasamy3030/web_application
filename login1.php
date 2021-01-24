<?php
	ob_start();
	session_start();
	$pageTitle = 'Login';
	if (isset($_SESSION['user'])) {
		header('Location: index.php');
	}
	include 'init.php';

	// Check If User Coming From HTTP Post Request
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	echo "hello world" ;
		if (isset($_POST['login'])) {

			$user = $_POST['username'];
			$pass = $_POST['password'];
			$hashedPass = sha1($pass);
			echo "<h1>".$user."</h1>";

		}

	}

?>


<!--New Login -->

<div class="wrapper">
  <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <p class="title">Log in</p>
    <input type="text" name="username" placeholder="Username" autofocus/>
    <i class="fa fa-user"></i>
    <input type="password" name="password" placeholder="Password" />
    <i class="fa fa-key"></i>
    <a href="#">Forgot your password?</a>
    <button>
      <i class="spinner"></i>
 
    </button>`

         <input type="submit" class="state" value="login" name="login">
  </form>

  </p>
</div>

<!--End Login --> 






	<!-- End Login Form -->
	
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