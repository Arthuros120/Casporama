<?php

interface DAO {
    function getAllData($id,$table);
    function getData($id,$table,$filter);
    function addData($file, $table);
}

function ErrorFile($err, $table) {

    $time = date("Y-m-d-h:i",time());
    $errorFile = fopen("./DAO/error/$table._.$time.txt","w");
    if (gettype($err) == "array") {
        $msg = "DataBase Error : ";
        foreach ($err as $i) {
            $msg .= $i." ";
        }
    } else {
        $msg = $err;
    }
    fwrite($errorFile,$msg."\n");
    fclose($errorFile);

}

?>