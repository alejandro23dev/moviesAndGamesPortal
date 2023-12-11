<?php

namespace App\Controllers;

use App\Models\MainModel;

class Home extends BaseController
{
    protected $objRequest;
    protected $objEmail;
    protected $objMainModel;

    public function __construct()
    {
        $this->objRequest = \Config\Services::request();
        $this->objMainModel = new MainModel;

        helper('Site');
    }
    public function index() #VIEW
    {
        $data = array();
        $data['page'] = 'main/index';
        $data['movies'] = $this->objMainModel->objData('movies');
        $data['games'] = $this->objMainModel->objData('games');
        $data['gameCategories'] = $this->objMainModel->objData('categories', 'type', 'game');
        $data['movieCategories'] = $this->objMainModel->objData('categories', 'type', 'movie');

        return view('main/header', $data);
    }

    public function movie() #VIEW
    {
        $data = array();
        $data['page'] = 'main/movie';
        $data['movie'] = $this->objMainModel->objData('movies', 'id', $this->objRequest->getPostGet('movieID'));
        $data['movies'] = $this->objMainModel->objData('movies');
        $data['games'] = $this->objMainModel->objData('games');
        $data['gameCategories'] = $this->objMainModel->objData('categories', 'type', 'game');
        $data['movieCategories'] = $this->objMainModel->objData('categories', 'type', 'movie');

        return view('main/header', $data);
    }
}
