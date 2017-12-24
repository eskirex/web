<?php

namespace Eskirex\Component\Web\Resources;

class Twig
{
    public static function functions()
    {
        return [
            'vdump' => function ($input) {
                echo '<pre>';
                var_dump($input);
                echo '</pre>';
            },
            'pdump' => function ($input) {
                echo '<pre>';
                print_r($input);
                echo '</pre>';
            },
        ];
    }


    public static function filters()
    {
        return [
            'vdump' => function ($input) {
                echo '<pre>';
                var_dump($input);
                echo '</pre>';
            },
            'pdump' => function ($input) {
                echo '<pre>';
                print_r($input);
                echo '</pre>';
            },

            'strtolower' => function ($input) {
                return strtolower($input);
            },
            'dot'        => function ($input) {
                return new Dotify($input);
            },
            'class'      => function ($input) {
                return new $input;
            },
        ];
    }
}