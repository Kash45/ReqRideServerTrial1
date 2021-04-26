<?php

   // Splitting fullname in parts
   /*$firstName = explode(" ",$fullname)[0];
   $middleName = explode(" ",$fullname)[1];
   $lastName = explode(" ",$fullname)[2];*/
   
   require_once 'vendor/autoload.php';
	$idToken = $obj->{'idToken'};

	$client = new Google_Client(['client_id'=>"527130672200-i8m8kgeq9j125cv058r9sa48pvti1cb0.apps.googleusercontent.com"]);
	$payload = $client->verifyIdToken($idToken);
	$userValid = array();
	
	if($payload){
		$mail = $payload['email'];
	}

   $dp = $obj->{'Profile_Image'};
   $fullname =$obj->{'FullName'};
   $regId = $obj->{'RegistrationId'};
   $gender = $obj->{'Gender'};
   $mob = $obj->{'Mobile_Number'};
   $dept = $obj->{'Department'};
   $year = $obj->{'YearOfStudy'};
   $lat = $obj->{'latitude'};
   $long = $obj->{'longitude'};
   $type = $obj->{'Type'};
   $licNo=null;
   $licImg=null;
   $bikeNo=null;

   $sql = "select user_id FROM user where user_id=$regId";
   $result = $con->query($sql);

   if($result->num_rows>0){
      $resp=array("REGISTER_STATUS"=>"failed");
      return;
   }

   if($type == 'Driver'){
      $licNo = $obj->{'Licence_Number'};
      $licImg = $obj->{'Licence_Image'};
      $bikeNo = $obj->{'Bike_Number'};
   }

   // $count =sizeof($dataarray);
	
   // // Encryption varibles
   // $method ='AES-256-CBC';
   // $key=getenv('NAMESPACED_CRYPTO_KEY');
   // $length =openssl_cipher_iv_length($method);
   // $iv =openssl_random_pseudo_bytes($length);
   
   
   // for($i =0;$i<$count;$i++)
   // {
   // 	$ciphertext =openssl_encrypt( $dataarray[$i], $method, $key, OPENSSL_RAW_DATA, $iv);
   // 	$encode =base64_encode($ciphertext);
   // 	$decode =base64_decode($encode);
   // 	$plaintext =openssl_decrypt($decode,$method,$key,OPENSSL_RAW_DATA,$iv);
   // 	//array_push($resp,"plaintext"=>$p  laintext);
   // }

   $stmt = $con->prepare("CALL insert_user(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
   $stmt->bind_param('ssssssssssssssss',$dp,$fullname,$fullname,$fullname,$regId,$gender,$mob,
                                       $dept,$year,$lat,$long,$type,$bikeNo,$licNo,$licImg,$mail);

   $var = $stmt->execute();

   if(!$var) $resp = array("REGISTER_STATUS"=>"false");
   else $resp = array("REGISTER_STATUS"=>"success");
    
   $stmt->close();

?>