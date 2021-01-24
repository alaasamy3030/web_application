<?php

	/*
	================================================
	== Items Page
	================================================
	*/

	ob_start(); // Output Buffering Start

	session_start();

	$pageTitle = 'vactions';
  
  
 
	if (isset($_SESSION['Username'])) {

		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
  
		if ($do == 'Manage') {


			$stmt = $con->prepare("SELECT 
										conferance.*, 
										conferance.Name AS conferance_name, 
										users.Username  AS username
									FROM 
										conferance
								
									INNER JOIN 
										users 

									ON 
										users.UserID = conferance.userid
                                        
                                        WHERE conferance.approve1 = 1  AND 
                                              conferance.approve2 = 0 AND 
                                              conferance.approve3 = 0  AND 
                                              conferance.approve4 = 0  
                                            
									ORDER BY 
										ID DESC");

			// Execute The Statement

			$stmt->execute();

			// Assign To Variable 

			$items = $stmt->fetchAll();

			if (! empty($items)) {

			?>

   <!--Strat Tabels -->
<div id="page-wrapper">
                <div class="row">
   
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> طلبات حضور المؤتمرات  أعضاء هيئه التدريس</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                يوضح طلبات  الاجازه الخاصه  من  الساده اعضاء هيئه التدريس  
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                                  <tr>          
                                       
                                                <th>عنوان المؤتمر   </th>
                                                <th>وصف  المؤتمر </th>
                                                <th>موعد  انعقاد  المؤتمر </th>
                                                <th>مكان  انعقاد المؤتمر . </th>
                                                <th>لتحكم</th>
                                                </tr>
                                           
                                        </thead>
                                        <tbody>
                                            
                                         <?php
							foreach($items as $item) {
								echo "<tr'>";
									echo "<td>" . $item['Name'] . "</td>";
                          echo "<td>" . $item['description'] . "</td>";
                                echo "<td>" . $item['date'] . "</td>";
                                echo "<td>" . $item['location'] . "</td>";
                                
                                
									echo "<td>
								
										<a href='Section_Council.php?do=Delete&itemid=" . $item['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> رفض  الاجازه </a>";
										if ($item['approve4'] == 0) {
											echo "<a 
													href='admin_vactions.php?do=Approve&itemid=" . $item['ID'] . "' 
													class='btn btn-info activate'>
													<i class='fa fa-check'></i> الموافقه </a>";
										}
									echo "</td>";
								echo "</tr>";
							}
						?>
			
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                               
                            </div>
                           
                            <!-- /.panel-body -->
                        
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                
        
           
        </div>
    

</div>
</div>   
    <!--End Ttabels  -->

				
				
		

			<?php } else {

				echo '<div class="container">';
					echo '<div class="nice-message">لا يوجد اى  طلب  للاجازات الخاصه من اعضاء هيئه التدريس </div>';
					
				echo '</div>';

			} ?>

		<?php 

		} elseif ($do == 'Approve') {

			echo "<h1 class='text-center'>الموافقه على  الاجازه</h1>";
			echo "<div class='container'>";

				// Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

				$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('RequestID', 'vaction_requests', $itemid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("UPDATE vaction_requests SET Approve4 = 1 WHERE RequestID = ?");

					$stmt->execute(array($itemid));

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		}
        elseif ($do == 'reject') {

			echo "<h1 class='text-center'> رفض  الاجازه </h1>";
			echo "<div class='container'>";

				// Check If Get Request Item ID Is Numeric & Get The Integer Value Of It

				$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('RequestID', 'vaction_requests', $itemid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("UPDATE vaction_requests SET Approve1 = 2 WHERE RequestID = ?");

					$stmt->execute(array($itemid));

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

					redirectHome($theMsg, 'back');

				} else {

					$theMsg = '<div class="alert alert-danger">This ID is Not Exist</div>';

					redirectHome($theMsg);

				}

			echo '</div>';

		}
        
        
        ?>
      

        <?php



		include $tpl . 'footer.php';



	} else {

		header('Location: index.php');

		exit();
	}

	ob_end_flush(); // Release The Output

?>

