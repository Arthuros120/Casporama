<?php

interface DaoInterface {
    function getData($id,$table,$filter);
    function addData($file, $table);
}

function errorFile($err, $table) {

    $files = glob( "./DaoFile/error/" ."*" );
    if ($files && count($files) >= 6) {
        array_map('unlink', glob("./DaoFile/error/*.txt"));
    }

    $time = date("Y-m-d-G:i:s",time());
    $timeName = substr($time,0,-3);
    $errorFile = fopen("./DaoFile/error/$table" . "_" ."$timeName.txt","a");
    if (gettype($err) == "array") {
        $msg = "DataBase Error : ";
        foreach ($err as $i) {
            $msg .= $i." ";
        }
    } else {
        $msg = $err;
    }
    fwrite($errorFile,$time." : ".$msg."\n");
    fclose($errorFile);

}

?>