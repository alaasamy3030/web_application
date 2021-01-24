<?php
	ob_start();
	include 'init.php' ;
	// Check If User Coming From HTTP Post Request

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if (isset($_POST['taref'])) {

			$type = $_POST['inlineRadioOptions'];
		     if($type == 'money'){
               header('location:money_taref.php') ;
              }
            else{
               header('location:public_taref.php') ;
             }


		}

	}

?>

 <!--Start  Login form --> 
    <!-- login area start -->
    <div class="l-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
          	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="login-form-head">
                        <h4>طلب بيان حاله   </h4>
                        <p>بناءا على  طلب  عضو  هيئه التدريس </p>
                    </div>


<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="money">
  <label class="form-check-label" for="inlineRadio2"> عـــام </label>
</div>
                        
                        
              
                            
                        <div class="submit-btn-area">
                             <input name="taref" id="form_submit" type="submit" value="طلب "> 
                        </div>
                
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->
