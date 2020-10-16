<?php

    function redirect($page, $urlTags = null)
    {   
        header('Location:'.URLROOT.'/'.$page.
            ((isset($urlTags))?'/'.$urlTags:''));
        exit;
    }

    function redirectWithoutTag($page)
    {
        header('Location:/'.$page);
        exit;
    }

    function redirectToHome()
    {
        header('Location:'.'/home');
        exit;
    }