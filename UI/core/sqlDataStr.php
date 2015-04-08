<?php
    function sqlDataStr($value) {
        if (!is_null($value)) {
            return "'$value'";
        } else {
            return "NULL";
        }
    }
?>