<?php
    function text_preprocessing($text){
        $text = trim($text);
        $text = stripslashes($text);
        $text = htmlspecialchars($text);
        return $text;
    }
?>