<?php 
	require_once('includes/header.php');
	require_once('includes/db.php'); 
    
?>
<div id="profilepage">
<h3>The words you like:</h3>
<?php 

	$user_Id = $_SESSION['Id'];
	
	if(!$user_Id) {
		header('Location: ./');
	}
	
	$sql = "select user_word from user_words where user_Id = :user_Id";
    $query = $db->prepare( $sql );
    $query->execute( array( ':user_Id'=>$user_Id));
    
    
    if ($query->rowCount() > 0){
   		foreach ($query as $row)
        	echo "<a href='/" . $row['user_word'] . "'>" . $row['user_word'] . "</a><br/>";
	}
	else
	    echo "You don't like any words yet...";
	    
?>
</div>
<?php require_once('includes/footer.php'); ?>