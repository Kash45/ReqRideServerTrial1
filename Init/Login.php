<?php
    require_once 'vendor/autoload.php';
    
    $id_token = $obj->{'id_token'};
    $client = new Google_Client(['client_id'=>"527130672200-i8m8kgeq9j125cv058r9sa48pvti1cb0.apps.googleusercontent.com"]);
    $payload = $client->verifyIdToken($id_token);
    $userValid = array();
    if($payload){
        $userid = $payload['sub'];
        $sql = "select mail FROM user_mail where mail='".$payload['email']."';";
        $result = $con->query($sql);

        if($result->num_rows>0){
            $resp=array("Login"=>"User Already Present");
            return;
        }
        else{
            $resp=array("Login"=>"New User");
            return;   
        }
        array_push($userValid,"Valid");
        $resp = array("email"=>$payload['email']);
    }
    else{
        $resp = array("Login"=>"Something Wrong.");
    }
?>