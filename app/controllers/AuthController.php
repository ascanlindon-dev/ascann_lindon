<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
        // load auth library
        $this->call->library('Auth');
    }

    public function login()
    {
        // show login form or process POST
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($this->Auth->login($username, $password)) {
                // redirect to dashboard
                redirect(site_url('users'));
            } else {
                $data['error'] = 'Invalid username or password';
                $this->call->view('auth/login', $data);
            }
        } else {
            $this->call->view('auth/login');
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        redirect(site_url());
    }
    public function signup()
    {
        if ($this->io->method() === 'post') {
            $firstname = $this->io->post('firstname');
            $lastname = $this->io->post('lastname');
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $role = 'user';
            $lava =& lava_instance();
            $lava->call->model('AccountsModel');
            $id = $lava->AccountsModel->create_user($firstname, $lastname, $username, $email, $password, $role);
            if ($id) {
                redirect(site_url('login'));
            } else {
                $data['error'] = 'Unable to sign up (maybe username exists)';
                $this->call->view('auth/signup', $data);
            }
        } else {
            $this->call->view('auth/signup');
        }
    }
}
