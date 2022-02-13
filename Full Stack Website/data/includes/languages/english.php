<?php

function lang( $phrase ){

        static $lang = array(

            // nav bar words

            'Edit'      => ' Edit Page',
            'Settings'  => 'settings',
            'LogOut'    => ' LogOut',
            'Categories'=> 'Categories',
            'Admin'     => 'Home',
            'items'     => 'items',
            'Members'   => 'Members',
            'statistics'=> 'statistics',
            'Logs'      => 'Logs',
            'UserName'      => 'UserName',
            'password'      => 'Password',
            'Email'      => 'E-mail',
            'FullName'      => 'Full Name',
            'Save'      => 'Save',
            'EditMember'      => 'Edit Member',
            'Add_new_member' => 'Add new Member',
            'Add_member' => 'Add member',
            'Comments' => 'Commnets'


        );

        return $lang[$phrase];

}

