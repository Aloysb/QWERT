<?php

    class Controller 
    {
        public function model($model)
        {   
            if(file_exists('../app/models/'.$model.'.php')){
                require_once '../app/models/'.$model.'.php';
                return (new $model());  
            }else {
                redirectWithoutTag('pages/erreur');
                exit;
            }
            
        }

        public function view($view, $data = [])
        {
            if(file_exists('../app/views/'.$view.'.php'))
            {
                require_once '../app/views/'.$view.'.php';
            } 
            else 
            {
                redirectWithoutTag('pages/erreur');
                exit;
            }
        }
    }
