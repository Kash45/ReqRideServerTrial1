<?php
    session_start();
    include 'Connect.php';
    
    $json = file_get_contents('php://input');
    $obj  = json_decode($json);
    $function=$obj->{'function'};

    switch($function){
        case "Login":
            require_once 'Init/Login.php';
            break;
        
        case "Register":
            require_once 'Init/Register.php';
            break;

        case 'displayProfile':
            require_once 'userProfile/fetchUserDetails.php';
            break;
    
        case 'updateProfile':
            require_once 'userProfile/updateProfile.php';
            break;
        
        default:
            $resp = array("FUNCTION STATUS"=>"Invalid Request....Try again after some time");
    }
    
    echo json_encode($resp);

?>
