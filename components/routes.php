<?php
return array(
    '' => 'main/view',
    'login' => 'users/login',
    'register' => 'users/register',
    'edit' => 'users/edit',
    'logout' => 'users/logout',
    'user-page' => 'main/user',
    'add' => 'pictures/add',
    'activation/(.*)' => 'users/activation/$1',
    'reset' => 'users/reset',
    'reset-password/(.*)' => 'users/resetPassword/$1',
    'take-photo' => 'pictures/takePhoto',
);