
<?php
        ob_start();
        session_start();
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
		$info = $getUser->fetch();
		$userid = $info['UserID'] ; 

			 $stmt= $con->prepare("SELECT 
										taraf.*, 
										taraf.Description AS tarf_name, 
										users.Username 
									FROM 
										taraf
									INNER JOIN 
										users 
									ON 
										users.UserID = taraf.Doctorid
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
							<th>صيغه اخلاء الطرف </th>
							<th>حاله أخلاء الطرف </th>
							<th>التحكم</th>
						</tr>
                                        </thead>
                                        <tbody>
<?php
                        
                   
							foreach($myItems as $comment) {
								echo "<tr>";
                                  echo "<td>" . $comment['ID'] . "</td>"; 
									echo "<td>" . $comment['tarf_name'] . "</td>";
									echo "<td>";
                                        
    if($comment['approve'] == 0){
                           echo 'أنتظار  موافقه  شئون  أعضاء هيئه التدريس  والرد من اداره الجامعه ' ;
                                     
                               }          
									echo "<td>
									
  <a href='follow_taraf.php?comid=" . $comment['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'></i> Delete </a>";
										
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
