<?php
	ob_start();
	session_start();
	$pageTitle = 'Profile';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'];
    }
?>





<div class="taref">
  <div class="container">
       <div class="taref-header">
        <h3 class="text-center">شهاده  تعــريف عام  </h3>
       </div>  
   <div class="taref-body">
       <table class="table table-bordered">
          <tbody>
             <tr><td>الأسم </td><td>  <?php echo $info['Username'] ?> </td>
			 <td>رقم الملف </td><td> <?php echo $info['file_no'] ?></td></tr> 
              <tr><td>جهه العــمل </td><td>   <?php echo $info['job_place'] ?></td></tr>
               <tr><td> تاريخ التعيين  </td><td> <?php echo $info['hiring_date'] ?>  </td></tr>
              <tr><td>الوظيفه</td><td> <?php echo $info['hiring_date'] ?> </td>
			  <td>المرتبه</td><td><?php echo $info['position'] ?></td>
              <tr><td>رقم الهويه </td><td><?php echo $info['IDe'] ?></td>
			  <td>الجنسيه </td><td> <?php echo $info['nationalty'] ?>  </td> </tr>
              </tr>
          </tbody>
       </table>
          <p class="text-right">تفيد عماده  أعضاء هيئه التدريس بجامعه  بنها  بأن الموضح أعلاه أحد منسوبى الجامعه </p>
      <p class="text-right">وبناءا على  طلبه أعطى  هذه الشهاده لتقديمها  الى  وزاره التعليم العالى </p>
 <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="form-horizontal form-material">


						 <button type="submit" class="btn btn-primary" name="print">print </button>

                                </form>
   
   </div>
  </div>
</div>





    <?php


        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>