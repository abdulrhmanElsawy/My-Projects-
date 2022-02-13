<?php

function lang( $phrase ){

        static $lang = array(

            'Message' => 'اهلا و سهلا',

            'Admin' => 'المنظم'
        );

        return $lang[$phrase];

}

