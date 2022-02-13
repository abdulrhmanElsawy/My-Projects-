<?php

function lang( $phrase ){

        static $lang = array(

            // nav bar words

            'Edit'          => ' تعديل',
            'Settings'      => 'الاعدادات',
            'LogOut'        => ' تسجيل الخروج',
            'Categories'    => 'الاقسام',
            'Admin'         => 'ادمن',
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


            'login'         =>  'تسجيل الدخول',
            'SignUp'        => 'مستخدم جديد',
            'HomePage'      => 'الصفحة الرئيسية',
            'Events'        => 'الحداث',
            'Shop'          => 'المتجر',
            'Programs'      => 'البرامج',
            'Subjects'      => 'المواد',
            'Contact_Us'    => 'تواصل معنا',
            'Our_Team'      => 'الفريق',
            'Rank'          => 'المرتبة',
            'Posts'          => 'المنشورات',


            'Special_head_1'=> 'لا تكن مشغولاً ، كن منتجاً',
            'Services'      => 'الخدمات',
            'Courses'       => 'الدورات التعليمية',
            'Courses_desc'  => 'نقدم لك الدورات الجديدة والرائعة المجانية تمامًا
                                من المواقع الإلكترونية كـ (udemy - دورات) وبعض النصائح الجيدة من اليوتيوب',
            'Lectures'      => ' المحاضرات',
            'Lectures_desc' => 'يتم تلخيص جميع المحاضرات لجميع المواد من جميع المستويات (1 - 4) و
                            قسم خاص سيأتي قريبا
                            ',
            'Events'         => 'الاحداث',
            'Events_desc'    => 'جميع الفعاليات لكلية علوم الحاسب والذكاء الاصطناعي
                                لجامعة حلوان سيتم تحميلها هنا بانتظام',
            'Educational_paths' => 'المسارات التعليمية',
            'Educational_paths_desc' => 'نوفر لفريقنا أحدث الأخبار والمقدمات في جميع أقسام علوم الكمبيوتر ، وكل ذلك من مصادر موثوقة ، وكذلك بعض الإرشادات لجميع المبتدئين في البرمجة ، وهذا  هو مكان للبدء ومعرفة طريقك للوصول إلى هدفك في أي وقت من الأوقات',
            'Views'          => 'المشاهدات',
            'Members'        => 'الاعضاء',
            'Summeries'      => 'الملخصات',
            'Admins'         => 'المشرفون',



            'About'          => 'حول',
            'About_desc_1'   => 'مرحبًا أنا عبد الرحمن الصاوي مؤسس مجموعة كود بايونيرز وجامعة كلية علوم الحاسب والذكاء الاصطناعي بجامعة حلوان.',
            'About_desc_2'   => 'تم إنشاء هذا الموقع لمساعدة جميع الطلاب في جامعتي وجميع الجامعات الأخرى في نفس الكلية.',
            'About_Special'  => 'الأقل هو المزيد من العمل',


            
            'Contact'        => 'تواصل معنا',
            'Contact_Special'=> 'نحن نولد لكي نصنع',
            'Find_US'        => 'تجدنا على شبكات التواصل الاجتماعي',
            'table'        => ' الجداول' ,
            'Helwan'       => 'حلوان',
            'knowyourdoctor' => 'اعرف دكتورك ',
            'Articles'       => 'المقالات'
            
            
            


        );

        return $lang[$phrase];

}