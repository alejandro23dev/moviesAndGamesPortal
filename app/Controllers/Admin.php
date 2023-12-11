<?php

namespace App\Controllers;

use App\Models\MainModel;

class Admin extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objEmail;
    protected $objMainModel;

    public function __construct()
    {
        # Session
        $this->objSession = session();

        $this->objRequest = \Config\Services::request();
        $this->objMainModel = new MainModel;

        helper('Site');
    }

    public function main() #VIEW
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('admin/logout');

        $data = array();
        $data['page'] = 'admin/main';
        $data['user'] = $this->objSession->get('user');

        return view('main/header', $data);
    }

    //MOVIES SECTION
    public function movies() #VIEW
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('admin/logout');

        $data = array();
        $data['page'] = 'admin/movies/main';
        $data['user'] = $this->objSession->get('user');
        $movie = $this->objMainModel->objData('movies');
        for ($i = 0; $i < count($movie); $i++) {
            $col['id'] = $movie[$i]->id;
            $col['image'] = $movie[$i]->image;
            $col['name'] = $movie[$i]->name;
            $col['description'] = $movie[$i]->description;
            $col['time'] = $movie[$i]->time;
            $col['downloads'] = $movie[$i]->downloads;
            $col['weight'] = $movie[$i]->weight;
            $col['price'] = $movie[$i]->price;
            $col['discountPrice'] = $movie[$i]->discountPrice;
            $col['status'] = $movie[$i]->status;

            $category = $this->objMainModel->objData('categories', 'id', $movie[$i]->categoryID);
            if (!empty($category)) {
                $col['categoryID'] = $category[0]->id;
                $col['categoryName'] = $category[0]->name;
            }
            $row[$i] =  $col;
        }
        $data['movies'] = $row;
        $data['movieCategories'] = $this->objMainModel->objData('categories', 'type', 'movie');

        return view('main/header', $data);
    }

    public function uploadMoviePhoto() #PROCESS
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('movies', $this->objRequest->getPost('id'), 'image', $_FILES['file']));
    }

    public function removeMoviePhoto() #PROCESS
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        $data = array();
        $data['image'] = '';

        return json_encode($this->objMainModel->objUpdate('movies', $data, $this->objRequest->getPost('id')));
    }

    public function showViewAddMovie() #VIEW
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            return view('admin/logout');
        }

        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/movies/form';
        $data['movies'] = $this->objMainModel->objData('movies');
        $data['categories'] = $this->objMainModel->objData('categories', 'type', 'movie');

        return view('main/header', $data);
    }

    public function createMovie() #PROCESS
    {
        # Verify Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));
        $data['price'] = str_replace("_", "", htmlspecialchars(trim($this->objRequest->getPost('price'))));
        $data['discountPrice'] = str_replace("_", "", htmlspecialchars(trim($this->objRequest->getPost('discountPrice'))));
        $data['status'] = htmlspecialchars(trim($this->objRequest->getPost('status')));
        $data['time'] = htmlspecialchars(trim($this->objRequest->getPost('time')));
        $data['categoryID'] = htmlspecialchars(trim($this->objRequest->getPost('category')));
        $data['uploadDate'] = date('Y-m-d');

        $countPrice = strlen(preg_replace('/[^0-9]/', '', $data['price']));
        $countDiscountPrice = strlen(preg_replace('/[^0-9]/', '', $data['discountPrice']));
        if ($countPrice < 3) {
            $response['error'] = 'INVALID_PRICE';
        } elseif ($countDiscountPrice < 3 && !empty(htmlspecialchars(trim($this->objRequest->getPost('discountPrice'))))) {
            $response['error'] = 'INVALID_DISCOUNT_PRICE';
        } else {
            $response = $this->objMainModel->objCreate('movies', $data);
        }

        return json_encode($response);
    }

    public function movieActions() #PROCESS
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        $id = htmlspecialchars(trim($this->objRequest->getPost('id')));
        $action = htmlspecialchars(trim($this->objRequest->getPost('action')));
        $data = array();
        if ($action == 'edit') { #EDIT
            $data['user'] = $this->objSession->get('user');
            $data['categories'] = $this->objMainModel->objData('categories', 'type', 'movie');
            $movie = $this->objMainModel->objData('movies', 'id', $id);
            $col['id'] = $movie[0]->id;
            $col['image'] = $movie[0]->image;
            $col['name'] = $movie[0]->name;
            $col['description'] = $movie[0]->description;
            $col['time'] = $movie[0]->time;
            $col['price'] = $movie[0]->price;
            $col['discountPrice'] = $movie[0]->discountPrice;
            $col['status'] = $movie[0]->status;
            $col['categoryID'] = $movie[0]->categoryID;
            $col['downloads'] = $movie[0]->downloads;

            $category = $this->objMainModel->objData('categories', 'id', $movie[0]->categoryID);
            if (!empty($category)) {
                $col['categoryID'] = $category[0]->id;
                $col['categoryName'] = $category[0]->name;
            }
            $data['movie'] = $col;
            $data['edit'] = 'yes';
            return view('admin/movies/form', $data);
        } elseif ($action == 'delete') { #DELETE
            $response = $this->objMainModel->objDelete('movies', $id);
            return json_encode($response);
        } elseif ($action == 'download') { #DOWNLOAD
            $movie = $this->objMainModel->objData('movies', 'id', $this->objRequest->getPost('id'));
            $data = array();
            $data['downloads'] = $movie[0]->downloads + 1;
            $response = $this->objMainModel->objUpdate('movies', $data, $movie[0]->id);
            return json_encode($response);
        } elseif ($action == 'update') { #UPDATE
            $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
            $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));
            $data['price'] = str_replace("_", "", htmlspecialchars(trim($this->objRequest->getPost('price'))));
            $data['discountPrice'] = str_replace("_", "", htmlspecialchars(trim($this->objRequest->getPost('discountPrice'))));
            $data['status'] = htmlspecialchars(trim($this->objRequest->getPost('status')));
            $data['time'] = htmlspecialchars(trim($this->objRequest->getPost('time')));
            $data['categoryID'] = htmlspecialchars(trim($this->objRequest->getPost('category')));

            $countPrice = strlen(preg_replace('/[^0-9]/', '', $data['price']));
            $countDiscountPrice = strlen(preg_replace('/[^0-9]/', '', $data['discountPrice']));
            if ($countPrice < 3)
                $response['error'] = 'INVALID_PRICE';

            elseif ($countDiscountPrice < 3 && !empty(htmlspecialchars(trim($this->objRequest->getPost('discountPrice')))))
                $response['error'] = 'INVALID_DISCOUNT_PRICE';

            else
                $response = $this->objMainModel->objUpdate('movies', $data, $id);

            return json_encode($response);
        }
    }

    public function showViewModalMovieCreateCategory() #VIEW
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        return view('admin/modals/createCategory');
    }

    public function createMovieCategory() #PROCESS
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['type'] = $this->objRequest->getPost('type');

        # Check Duplicate Category
        $checkName = $this->objMainModel->objCheckDuplicate('categories', 'name', $data['name'], '');
        if (!empty($checkName)) {
            $response['error'] = 1;
            $response['msg'] = "DUPLICATE";
            return json_encode($response);
        }

        $response = $this->objMainModel->objCreate('categories', $data);

        return json_encode($response);
    }

    //GAMES SECTION
    public function games() #VIEW
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('admin/logout');

        $data = array();
        $data['page'] = 'admin/games/main';
        $data['user'] = $this->objSession->get('user');
        $data['games'] = $this->objMainModel->objData('games');
        $data['gameCategories'] = $this->objMainModel->objData('categories', 'type', 'game');

        return view('main/header', $data);
    }

    public function showViewAddGame() #VIEW
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            return view('admin/logout');
        }

        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/games/products';
        $data['products'] = $this->objMainModel->objData('products');
        return view('main/header', $data);
    }
}
