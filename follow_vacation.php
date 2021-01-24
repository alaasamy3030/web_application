
<?php
        ob_start();
        session_start();
        $pageTitle = 'اجازه لرعايه طفل ';
        include 'init.php';

/*Strat Delete*/


         $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('RequestID', 'vaction_requests', $comid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM vaction_requests WHERE RequestID = :zid");

					$stmt->bindParam(":zid", $comid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

					redirectHome($theMsg, 'back');

				} 

			echo '</div>';


/*End Delete */


		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$_SESSION["sessionUser"] = $sessionUser;

		$info = $getUser->fetch();
		$userid = $info['UserID'] ; 
		$GLOBALS['FullName'] = $info['FullName'] ;
$GLOBALS['job']= $info['job'] ;
		$_SESSION["job"] = $info['job'] ;



			 $stmt= $con->prepare("SELECT 
										vaction_requests.*, 
										vacation.Name AS vaction_name, 
										users.Username 
									FROM 
										vaction_requests
									INNER JOIN 
										vacation 
									ON 
										vacation.V_ID = vaction_requests.vaction_ID 
									INNER JOIN 
										users 
									ON 
										users.UserID = vaction_requests.Doctor_ID
                                        WHERE users.UserID = $userid
									ORDER BY 
										RequestID DESC");


        $stmt->execute();

			// Assign To Variable 

			$myItems = $stmt->fetchAll();







  
		



				if (! empty($myItems)) {
			?>
                    
                    <div id="page-wrapper">
                <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                       
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                           
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                          	<tr>
							<th>الكود </th>
							<th>الاسم </th>
                            <th>تاريخ الارسال   </th>
							<th>حاله الاجازه </th>
						<th></th>	<th></th>
					
							
							

						</tr>
                                        </thead>
                                        <tbody>
<?php
                        
                   
							foreach($myItems as $comment) {
								echo "<tr>";
                                   echo "<td>" . $comment['RequestID'] . "</td>"; 
									echo "<td>" . $comment['vaction_name'] . "</td>";
                                	echo "<td>" . $comment['Add_Date'] . "</td>";
									echo "<td>";
                                        
    if($comment['approve1'] == 0 && $comment['approve2'] == 0 && $comment['approve3'] == 0 &&   $comment['approve4'] == 0){
                           echo 'أنتظار  موافقه  مجلس  القسم   و مجلس  الكليه  وشئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;
                                     	echo "<td>
									
  <a href='follow_vacation.php?comid=" . $comment['RequestID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
                                     }
   elseif($comment['approve1'] == 1 && $comment['approve2'] == 0 && $comment['approve3'] == 0 &&   $comment['approve4'] == 0){
       
 echo 'تم موافقه  مجلس  القسم   و انتظار  مجلس  الكليه  وشئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;

                            	echo "<td>
									
  <a href='follow_vacation.php?comid=" . $comment['RequestID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";    
                                }
elseif($comment['approve1'] == 1 && $comment['approve2'] == 1 && $comment['approve3'] == 0 &&   $comment['approve4'] == 0){
       
 echo 'تم موافقه  مجلس  القسم   و  مجلس  الكليه  انتظار  شئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;

                                	echo "<td>
									
  <a href='follow_vacation.php?comid=" . $comment['RequestID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
                                }
elseif($comment['approve1'] == 1 && $comment['approve2'] == 1 && $comment['approve3'] == 1 &&   $comment['approve4'] == 0){
       
 echo 'تم موافقه  مجلس  القسم   و  مجلس  الكليه  و  شئون  أعضاء هيئه التدريس  انتظار الرد من اداره الجامعه ' ;

                               	echo "<td>
									
  <a href='follow_vacation.php?comid=" . $comment['RequestID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>"; 
                                }
elseif($comment['approve1'] == 1 && $comment['approve2'] == 1 && $comment['approve3'] == 1 &&   $comment['approve4'] == 1){
       
 echo 'تم  قبول  طلب  الاجازه   ' ;


 	echo "<td>
									
  <a href='follow_vacation.php?comid=" . $comment['RequestID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>"; 





	//			<a href='pdfar/pdf/ar2.php'class='btn btn-danger print'><i class='fa fa-close'></i> print </a>";

 echo "<td>
									
   <a href='pdfar/pdf/ar2.php?do=Delete&RequestID=" . $comment['RequestID'] .
"&vaction_name=" . $comment['vaction_name'] .
"&Add_Date=" . $comment['Add_Date'] .
"&FullName=" . $FullName .
"&job=" . $job .
  
   


" ><i class='fa fa-close'></i> print </a>";
				
				
				
				
				
				
				
				
				
	echo "</td>";	
                                }
                                            
							
							
									
									
									
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
      <form>
         <input type = "button" value = "Print" onclick = "window.print()" />
      </form>  
</div>
</div>
         
                    
                    
                    
                    
                    
                    
                    
                    
                    
                <?php    
				
					echo '</div>';
				} else {
					echo 'لا يوجد  اى  اجازات  قمت  بها   <a href="vacancy.php">تقديم  طلب  اجازه  </a>';
				}
			?>

   <?php
        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>
