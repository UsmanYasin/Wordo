<?php 
    if (!($_SERVER['REQUEST_METHOD'] === 'POST')) {
        header('Location: ./');
    }
    require_once('../includes/session.php');
    require_once('../includes/db.php');
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['Id'];
        
        $action = $_POST['mywlaction'];
        $user_word = $_POST['word'];
        
        if ($action === 'check') {
            
            $sql = "select 'favorite' as favorite from user_words where user_id = :user_id and user_word = :user_word";
            $query = $db->prepare( $sql );
            $query->execute( array( ':user_id'=>$user_id, ':user_word'=>$user_word));
            $row = $query->fetch();
            
            echo $row['favorite'];
            
        } elseif ($action === 'add') {
            
            $sql = "delete from user_words where user_id = :user_id and user_word = :user_word";
            $query = $db->prepare( $sql );
            $query->execute( array( ':user_id'=>$user_id, ':user_word'=>$user_word));
            $deleted_rows = $query->rowCount();
            if ($deleted_rows == 0) {
                $sql = "insert into user_words values (null, :user_id, :user_word)";
                $query = $db->prepare( $sql );
                $query->execute( array( ':user_id'=>$user_id, ':user_word'=>$user_word));
                echo 'word_added';
            } else {
                echo 'word_removed';    
            }
        }
    }
?>