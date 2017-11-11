<?php
header("Content-type: text/html; charset=utf-8");


function trackEvent($mes) {
    $record = Array ();
    $record['message'] = $mes;
    insert('record', $record);

}

?>