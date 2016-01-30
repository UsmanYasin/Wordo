<?php 
	require_once('includes/header.php');
	require_once('includes/functions.php');
?>
<form id="foo" action="./">
	<img src="./assets/images/sfd.png" class="sfdpng"/>
	<input class="search" name="search" type="text" placeholder="Search for definitions" autofocus autocomplete="off" autocapitalize="off" value="" />
	<br/>
</form>
<div id="result"><?php echo wordo_get_result();?></div>
<div id="log"></div>

<?php 
	require_once('includes/footer.php');
?>