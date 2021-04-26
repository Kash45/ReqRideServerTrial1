<?php
    include 'Connect.php';

    $sql = "SELECT DP FROM user WHERE user_id='1819010084'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    
    $byte_array = unpack('C*', $row['DP']);
    
?>