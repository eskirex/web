<?php

if (!function_exists('vdump')) {
    function vdump($input)
    {
        echo "<pre style='font-size:16px;'>";
        var_dump($input);
        echo '</pre>';
    }
}



if (!function_exists('pdump')) {
    function pdump($input)
    {
        echo '<pre>';
        print_r($input);
        echo '</pre>';
    }
}

