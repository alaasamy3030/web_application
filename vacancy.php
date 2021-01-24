
<?php
	ob_start();
	session_start();
	$pageTitle = 'Homepage';
	include 'init.php';
    // Page Content

$stmt2 = $con->prepare("SELECT * FROM vacation  ORDER BY V_ID");

			$stmt2->execute();

			$cats = $stmt2->fetchAll();

?>

            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-area">
                                    <div class="invoice-head">
                                        <div class="row">
                                            <div class="iv-left col-6">
                                                <span>طلب  الحصول  على  اجازه   </span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="invoice-address">
                                              
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            
                                            <ul class="invoice-date">
                                           
                                        <?php 

                                 foreach($cats as $cat){
                                 ?>
                                   <li><span> <?php echo $cat['Name'] ; ?> </span>
                                <p><?php echo $cat['Description'] ; ?> </p> 
                              <div class="invoice-buttons text-right">
                                  <?php
            echo "<a href='vacancy_form". $cat['V_ID'].".php?vactionid=". $cat['V_ID'] ."'
													class='btn btn-info activate'>
													<i class='fa fa-check'></i> تقديم الطلب </a>";
                                  
?>
                                </div> 
                                               </li>
                                                <?php
                                 }
                                      
                                      ?>
                                
                                                
                                            </ul>
                                        </div>
                                    </div>
                                  
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           <!-- End Page Content  --> 
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2019. All right reserved. For Bfci Team .</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>

    <?php
        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>
