<?php
require_once '../include.php';
require_once '../model/ipsaModel.php';

if (isset($_POST['record'])) {
    trackEvent($_POST['record']);
}
?>
