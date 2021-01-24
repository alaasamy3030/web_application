
<?php
        ob_start();
        session_start();
        $pageTitle = 'اجازه لرعايه طفل ';
        include 'init.php';
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($sessionUser));
		$info = $getUser->fetch();
		$userid = $info['UserID'] ;

$GLOBALS['FullName'] = $info['FullName'] ;
$GLOBALS['job']= $info['job'] ;

		
/*Strat Delete*/


         $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

				// Select All Data Depend On This ID

				$check = checkItem('ID', 'conferance', $comid);

				// If There's Such ID Show The Form

				if ($check > 0) {

					$stmt = $con->prepare("DELETE FROM conferance WHERE ID = :zid");

					$stmt->bindParam(":zid", $comid);

					$stmt->execute();

					$theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

					redirectHome($theMsg, 'back');

				} 

			echo '</div>';


/*End Delete */





			 $stmt= $con->prepare("SELECT 
										conferance.*, 
										conferance.Name AS conferance_name, 
										users.Username 
									FROM 
										conferance
								
									INNER JOIN 
										users 
									ON 
										users.UserID = conferance.userid
                                            WHERE users.UserID = $userid
									ORDER BY 
										ID DESC");


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
                            <th>وصف  المؤتمر  </th>
							<th>حاله الاجازه </th>
						
							<th>التحكم </th>
							<th>طباعه </th>

						</tr>
                                        </thead>
                                        <tbody>
<?php
                        
                   
							foreach($myItems as $comment) {
								echo "<tr>";
                                echo "<td>" . $comment['ID'] . "</td>"; 
								echo "<td>" . $comment['conferance_name'] . "</td>";
                                echo "<td>" . $comment['description'] . "</td>";

									echo "<td>";
                                        
    if($comment['approve1'] == 0 && $comment['approve2'] == 0 && $comment['approve3'] == 0 &&   $comment['approve4'] == 0){
                           echo 'أنتظار  موافقه  مجلس  القسم   و مجلس  الكليه  وشئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;
                                     
									 
									 
									 
									 
									 
									echo "<td>
									
   <a href='follow_conferance.php?do=Delete&comid=" . $comment['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
								echo "</tr>"; 
									 
									 
									 
                                     }
   elseif($comment['approve1'] == 1 && $comment['approve2'] == 0 && $comment['approve3'] == 0 &&   $comment['approve4'] == 0){
       
 echo 'تم موافقه  مجلس  القسم   و انتظار  مجلس  الكليه  وشئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;

                                
								
								
								
								echo "<td>
									
   <a href='follow_conferance.php?do=Delete&comid=" . $comment['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
								echo "</tr>";
								
								
								
								
								
                                }
elseif($comment['approve1'] == 1 && $comment['approve2'] == 1 && $comment['approve3'] == 0 &&   $comment['approve4'] == 0){
       
 echo 'تم موافقه  مجلس  القسم   و  مجلس  الكليه  انتظار  شئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;








echo "<td>
									
   <a href='follow_conferance.php?do=Delete&comid=" . $comment['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
								echo "</tr>";
                                
                                }
elseif($comment['approve1'] == 1 && $comment['approve2'] == 1 && $comment['approve3'] == 1 &&   $comment['approve4'] == 0){
       
 echo 'تم موافقه  مجلس  القسم   و  مجلس  الكليه  و  شئون  أعضاء هيئه التدريس  انتظار الرد من اداره الجامعه ' ;

                                
								
								
								echo "<td>
									
   <a href='follow_conferance.php?do=Delete&comid=" . $comment['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
								echo "</tr>";
								
								
								
                                }
elseif($comment['approve1'] == 1 && $comment['approve2'] == 1 && $comment['approve3'] == 1 &&   $comment['approve4'] == 1){
       
 echo 'تم  قبول  طلب  حضور  المؤتمر     ' ;

                                
								
								echo "<td>
									
   <a href='follow_conferance.php?do=Delete&comid=" . $comment['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
									echo "</td>";
									
									
							
						
									
						
								echo "<td>
									
   <a href='pdfar/pdf/ar3.php?do=Delete&ID2=" . $comment['ID'] .
"&conferance_name2=" . $comment['conferance_name'] .
"&description2=" . $comment['description'] .
"&date2=" . $comment['date'] .
"&location2=" . $comment['location'] .
"&FullName=" . $FullName .
"&job=" . $job .
  
   



 " ><i class='fa fa-close'></i> print </a>";
										
									echo "</td>";	
									
									
									
									
								echo "</tr>";
								
								
                                }
                                            
								
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
