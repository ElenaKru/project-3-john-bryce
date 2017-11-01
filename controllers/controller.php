<?php
require_once '../data/bl.php';
    class Controller {
        // checking for returning result from sql
        function checkSuccess($update) {
            $isGood = ($update == true ? true : false);
            return $isGood;
        }
    }
?>