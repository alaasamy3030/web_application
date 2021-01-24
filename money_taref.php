<?php
	ob_start();
	session_start();
	$pageTitle = 'Profile';
	include 'init.php';
    $nosidebar = '' ;
	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'];
    }
	
	
	
	
	 if(isset($_POST['print'])){
   
   
               $_SESSION["place"]   = $_POST['place'] ;

			  
			  
                         $_SESSION["FullName"] = $info['FullName'];
                         $_SESSION["Username"] = $info['Username'];

                		$_SESSION["file_no"] = $info['file_no'];
                		$_SESSION["job_place"] = $info['job_place'] ; 
						$_SESSION["hiring_date"] = $info['hiring_date'] ; 

                		$_SESSION["job"] = $info['job'];
                		$_SESSION["position"] =  $info['position'];
                		$_SESSION["salary"] =$info['salary'];
                		$_SESSION["IDe"] = $info['IDe'] ;
                		$_SESSION["nationalty"] = $info['nationalty'] ;
						
						
						
        	$_SESSION["phone"] = $info['phone'] ;
        	$_SESSION["	job"] = $info['	job'] ;

						
		////////////////////
$_SESSION["Social_status"] = $info['Social_status'] ;
        	$_SESSION["First_Appointment"] = $info['First_Appointment'] ;
$_SESSION["Date_recruitment"] = $info['Date_recruitment'] ;
        	$_SESSION["add"] = $info['add'] ;			
						
						
						

		header("location:pdfar/pdf/ar1.php");
			
          
          
          
          
          	exit();

          
      }
		  
	
	
	
	
	
	
	
	
	
	
	
	
?>





<div class="taref">
  <div class="container">
       <div class="taref-header">
        <h3 class="text-center">طلب بيان حاله </h3>
    
       </div>  
   <div class="taref-body">
       <table class="table table-bordered">
           <tbody>
             <tr><td>الأسم </td><td>  <?php echo $info['FullName'] ?> </td>
              <tr><td>جهه العــمل </td><td>   <?php echo $info['job_place'] ?></td></tr>
               <tr><td> تاريخ التعيين  </td><td> <?php echo $info['hiring_date'] ?>  </td></tr>
              <tr><td>الوظيفه</td><td> <?php echo $info['job'] ?> </td>
              <tr><td>رقم الهويه </td><td><?php echo $info['IDe'] ?></td>
			  <td>الجنسيه </td><td> <?php echo $info['nationalty'] ?>  </td>
			  </tr>
			  
			  
			  
			  
			    <tr><td>الحالة الاجتماعية</td><td><?php echo $info['Social_status'] ?></td>
			  <td>اول تعيين </td><td> <?php echo $info['First_Appointment'] ?>  </td>
			  </tr>
			  
			 <tr><td>تاريخ التجنيد</td><td><?php echo $info['Date_recruitment'] ?></td>
			  <td>العنوان</td><td> <?php echo $info['add'] ?>  </td>
			  </tr>  
			  
			  
              </tr>
          </tbody>
       </table>


          <p class="text-right"> </p>
      <p class="text-right">بناء هلى طلبه اعطى هذه الوثيقه لتقديمها الى  </p>
                         
                <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="form-horizontal form-material">
 <input name="place" type="text" value="المكان المقدم اليه "  class="form-control form-control-line">


						 <button type="submit" class="btn btn-primary" name="print">print </button>

                                </form>


   </div>
  </div>
</div>





    <?php


        ob_end_flush();
    ?>