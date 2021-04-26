<?php
    $userId = $obj->{'userId'};
    $data_name = $obj->{'data_name'};
    $data_value1=$obj->{'data_value1'};
    $data_value2=null;
    $data_value3=null;

    if($data_name=='Name' || $data_name=='Location'){
        $data_value2=$obj->{'data_value2'};
        $data_value3=$obj->{'data_value3'};
    }

    $stmt = $con->prepare("CALL update_profile(?,?,?,?,?)");
    $stmt->bind_param('sssss',$userId,$data_name,$data_value1,$data_value2,$data_value3);
    $val = $stmt->execute();
    
    if($val) $resp=array("UPDATE_STATUS"=>"SUCCESS");
    else $resp=array("UPDATE_STATUS"=>"FAILED");

    $stmt->close();
?>