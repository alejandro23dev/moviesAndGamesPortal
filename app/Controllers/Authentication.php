<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\AuthenticationModel;

class Authentication extends BaseController
{
    protected $objRequest;
    protected $objSession;
    protected $objEmail;
    protected $objMainModel;
    protected $objAuthenticationModel;

    public function __construct()
    {
        $this->objRequest = \Config\Services::request();
        $this->objMainModel = new MainModel;
        $this->objAuthenticationModel = new AuthenticationModel;
        $this->objSession = session();

        # DESTROY SESSION
        $sessionArray['id'] = '';
        $sessionArray['user'] = '';
        $sessionArray['email'] = '';
        $sessionArray['role'] = '';

        $this->objSession->set('user', $sessionArray);

        $emailConfig = array();
        $emailConfig['protocol'] = EMAIL_PROTOCOL;
        $emailConfig['SMTPHost'] = EMAIL_SMTP_HOST;
        $emailConfig['SMTPUser'] = EMAIL_SMTP_USER;
        $emailConfig['SMTPPass'] = EMAIL_SMTP_PASSWORD;
        $emailConfig['SMTPPort'] = EMAIL_SMTP_PORT;
        $emailConfig['SMTPCrypto'] = EMAIL_SMTP_CRYPTO;
        $emailConfig['mailType'] = EMAIL_MAIL_TYPE;

        $this->objEmail = \Config\Services::email($emailConfig);
    }

    public function signIn()
    {
        $data = array();
        $data['uniqid'] = uniqid();
        return view('signIn/mainSignIn', $data);
    }

    public function signInAdmin()
    {
        $data = array();
        $data['uniqid'] = uniqid();
        $data['page'] = 'admin/login';

        return view('main/header', $data);
    }

    public function signInProcess()
    {
        $user = $this->request->getPost('user');
        $password = $this->request->getPost('password');

        $result = $this->objAuthenticationModel->loginAdmin($user, $password);

        if ($result['error'] == 1)
            return json_encode($result);

        # CREATE SESSION
        $sessionArray = array();
        $sessionArray['id'] = $result['data']->id;
        $sessionArray['user'] = $result['data']->user;
        $sessionArray['email'] = @$result['data']->email;
        $sessionArray['role'] = $result['data']->role;

        $this->objSession->set('user', $sessionArray);

        return json_encode($result);
    }
}
