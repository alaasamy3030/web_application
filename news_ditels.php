
<?php
	ob_start();
	session_start();
	$pageTitle = ' ';
	include 'init.php';
    // Page Content


?>

<section >
<div class="container">
<div class="heading text-center">
<img class="dividerline" src="img/sep.png" alt="">
<h2><?php echo $_GET["title"]; ?></h2>
<img class="dividerline" src="img/sep.png" alt="">
</div><div class="row">
<div class="col-md-12">
<div class="papers text-center">
<img src="<?php echo 'admin_news\uploads\\vaction\\'.$_GET["img"]; ?>" alt="" alt=""><br/>

<a href="#"><?php echo $_GET["date"]; ?> </b></a>
<a href="#"><?php echo $_GET["name_college"]; ?> </b></a>

<br>
<p><?php echo $_GET["desc"] ?> </p></div></div>






<script>
  setTimeout(function(){
    document.getElementById('info-message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 5000);
</script>



    <?php
        include $tpl . 'footer.php'; 
        ob_end_flush();
    ?>
