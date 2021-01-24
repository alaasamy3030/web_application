
<?php
	ob_start();
	session_start();
	$pageTitle = 'Homepage';
	include 'init.php';
    // Page Content

$stmt2 = $con->prepare("SELECT * FROM news ORDER BY ID DESC");

			$stmt2->execute();

			$cats = $stmt2->fetchAll();

?>

            <div class="main-content-inner">
                <div class="row">
                    <div class="col-sm-9 .col-md-6 .col-lg-12">
                        <div class="card" >
                            <div class="card-body">
                                <div class="invoice-area">
                                    <div class="invoice-head">
                                        <div class="row">
                                            <div class="iv-left col-6">
                                                <span>اخبار من جامعه بنها  </span>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <div class="invoice-address">
                                              
                                               
                                            </div>
                                        </div>
                                        <div>
                                            
                                            <ul class="invoice-date">
                                           
                                        <?php 

                                 foreach($cats as $cat){
                                 ?>
								                 <div class="row">

                                   <li  style="width:200px%">
								   
								   <h4> <?php echo $cat['title'] ; ?> </h4>	
								   <p ><?php echo $cat['date']." " .      $cat['name_college']   ; ?> </p> 
<br>


                     <img src="<?php echo 'admin_news\uploads\\vaction\\'.$cat['img'] ; ?> " class="rounded float-right" alt="...">
<br>


                                <p ><?php echo $cat['summary_desc'] ; ?> </p> 

                              <div class="invoice-buttons text-right">
            
			
			
<a href="news_ditels.php?vactionid=<?php echo $cat['ID']; ?>
                            .& title=<?php echo $cat['title']; ?>
.& date=<?php echo $cat['date']; ?>
.& name_college=<?php echo $cat['name_college']; ?>
.& desc=<?php echo $cat['desc']; ?>
.& img=<?php echo $cat['img']; ?>
 " >
<input  class="btn btn-info activate" value="قرائه"> </a>





   

                                </div>                                 </div> 
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
