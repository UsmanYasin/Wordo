<?php 
	require_once('../includes/session.php');
	require_once('../includes/db.php');
	
	require_once('../includes/TwitterOAuth/Common/Curl.php');
	require_once('../includes/TwitterOAuth/Auth/AuthAbstract.php');
	require_once('../includes/TwitterOAuth/Auth/SingleUserAuth.php');
	require_once('../includes/TwitterOAuth/Serializer/SerializerInterface.php');
	require_once('../includes/TwitterOAuth/Serializer/ArraySerializer.php');
	require_once('../includes/TwitterOAuth/Exception/TwitterException.php');
	
	use TwitterOAuth\Auth\SingleUserAuth;
	use TwitterOAuth\Serializer\ArraySerializer;

	$credentials = array(
    	'consumer_key' => 'fxy5RXmMPpvMyMlYWVMP0kqx3',
    	'consumer_secret' => 'LT29Fbr5OuVPs40OsyiOpFy7mpdqVUNo0zvEuFC59nk0VXRzJu',
    	'oauth_token' => $_COOKIE['oauth_token'],
    	'oauth_token_secret' => $_COOKIE['oauth_token_secret']
	);
	
	$serializer = new ArraySerializer();
	$auth = new SingleUserAuth($credentials, $serializer);
	
	
    if ($_COOKIE['oauth_token'] == $_GET['oauth_token'])
    {
        $params = array(
    	'oauth_verifier' => $_GET['oauth_verifier']
	    );
        $response = $auth->post('oauth/access_token', $params);
        
        $twitter_user_id = $response['user_id'];
        $screen_name = $response['screen_name'];
        
        $sql = "select count(Id) AS alreadyRegisteredUser from users where twitter_user_id = :twitter_user_id";
        $query = $db->prepare( $sql );
        $query->execute( array( ':twitter_user_id'=>$twitter_user_id));
        $row = $query->fetch();
        
        if ($row['alreadyRegisteredUser'] == 0) {
            $sql = "INSERT INTO users ( twitter_user_id, screen_name ) VALUES ( :twitter_user_id, :screen_name )";
            $query = $db->prepare( $sql );
            $query->execute( array( ':twitter_user_id'=>$twitter_user_id, ':screen_name'=>$screen_name ) );
        }

        $sql = "select Id from users where twitter_user_id = :twitter_user_id";
        $query = $db->prepare( $sql );
        $query->execute( array( ':twitter_user_id'=>$twitter_user_id));
        $row = $query->fetch();
        
        $_SESSION['Id'] = $row['Id'];
        
        header('Location: ./');
        
    } else {
        header('Location: ./login.php');
    }
?>