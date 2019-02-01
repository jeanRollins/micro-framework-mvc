<?php

class Pages extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        
        $dates = [
            'title' => 'Welcome to MVC'
        ];
        $this->view('pages/start', $dates);
    }


}