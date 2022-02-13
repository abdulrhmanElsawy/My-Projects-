<?php

function lang( $phrase ){

        static $lang = array(

            // nav bar words

            'Edit'          => ' Edit Page',
            'Settings'      => 'settings',
            'LogOut'        => ' LogOut',
            'Categories'    => 'Categories',
            'Admin'         => 'Home',
            'items'         => 'items',
            'Members'       => 'Members',
            'statistics'    => 'statistics',
            'Logs'          => 'Logs',
            'UserName'      => 'UserName',
            'password'      => 'Password',
            'Email'         => 'E-mail',
            'FullName'      => 'Full Name',
            'Save'          => 'Save',
            'EditMember'    => 'Edit Member',
            'Add_new_member'=> 'Add new Member',
            'Add_member'    => 'Add member',
            'Comments'      => 'Commnets',
            'login'         =>  'Login',
            'SignUp'        => 'SignUp',
            'HomePage'      => 'HomePage',
            'Events'        => 'Events',
            'Shop'          => 'Shop',
            'Programs'      => 'Programs',
            'Subjects'      => 'Subjects',
            'Contact_Us'    => 'Contact Us',
            'Our_Team'      => 'Our Team',
            'Rank'          => 'Rank',
            'Posts'         => 'Posts',
            'Special_head_1'=> 'Dont be busy, be productive',
            'Services'      => 'Services',
            'Courses'       => 'Courses',
            'Courses_desc'  => 'We Apply for you the new and Awesome courses that are completely free 
                                from websites As (udemy - courses) And Some Good tibs From Youtube',
            'Lectures'      => ' Lectures',
            'Lectures_desc' => 'All Lectures For All Subjects are summarised from all levels (1 - 4) and the 
                                Private  Department Will Come Soon',
            'Events'         => 'Events',
            'Events_desc'    => 'All Events For The Faculty of Computer Science & Artificial Intelligence
                                For Helwan University  Will be uploaded here regularly',
            'Educational_paths' => 'Educational paths',
            'Educational_paths_desc' => 'we provide our team with the leatest news and introductions in all departments of CS, all from reliable sources, aslo some instructions for all begginers in programing ,code pioneeres is a place to begin and know your path Path To Get your goal in no Time',
            'Views'          => 'Views',
            'Members'        => 'Members',
            'Summeries'      => 'Summeries',
            'Admins'         => 'Admins',



            'About'          => 'About',
            'About_desc_1'   => 'Hey iam Abdelrhman Elsawy The Founder Of Code Pioneers Group & A sudent in the faculty of computer Science And Artificial intelligence in Helwan University.',
            'Admins_desc_2'  => 'This website made for help all students in my University and all other Universities with the the same Faculty.',
            'About_Special'  => 'Less is More Work',

            'Contact'        => 'Contact',
            'Contact_Special'=> 'We Are Born To Create',
            'Find_US'        => 'Find Us On Social Networks',
            'table'        => 'Tables',
            'Helwan'       => 'Helwan',
            'knowyourdoctor' => 'Know Your Doctor',
            'Articles'     => 'Articles'

            
            
            


        );

        return $lang[$phrase];

}