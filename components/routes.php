<?php
return array(
     /**
     * Ajax routes
     */
    'save-photo' => 'pictures/savePhoto',
    'like-post' => 'pictures/likePost',
    'add-comment' => 'pictures/addComment',
 
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
    'post/([0-9]+)' => 'pictures/post/$1',
    'user-page/post/([0-9]+)' => 'pictures/postRegisterUser/$1',
);