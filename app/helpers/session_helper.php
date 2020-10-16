<?php

function isLoggedIn(){
    if(isset($_SESSION['data_user'])){
        return true;
    } else {
        return false;
    }
}

