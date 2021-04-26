<?php 

	require_once 'vendor/autoload.php';
	$idToken = $obj->{'idToken'};

	$client = new Google_Client(['client_id'=>"527130672200-i8m8kgeq9j125cv058r9sa48pvti1cb0.apps.googleusercontent.com"]);
	$payload = $client->verifyIdToken($idToken);
	$userValid = array();
	
	if($payload){
		$mail = $payload['email'];
	}

	$stmt = $con->prepare("CALL display_profile(?)");

	$stmt->bind_param('s',$mail);
	$stmt->execute();

	$result = $stmt->get_result();

	if($result->num_rows > 0){
		$profile_data = $result->fetch_assoc();
		$resp = $profile_data;
	}
	else{
		$resp = array("DATA_FETCH"=>"ERROR DATA FETCHING");
	}

?>
