<?php 
    
    date_default_timezone_set('Asia/Jakarta');
    $username = "attendance_app";
    $password = "4tt3ndance!";
    $database = "macscanner";
    $mysqli = new mysqli("34.82.192.248", $username, $password, $database);
    $query = "SELECT user_id, case when last_minute is null then 0 when last_minute > 10 then 0 else 1 end as status  FROM vw_dosen_status";
    $result = $mysqli->query($query);

    $data = [];
    $data['status'] = true;
    $data['last_update'] = date('Y-m-d H:i:s');
    while ($row = $result->fetch_object()) { 
        $data['detail'][] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
?>