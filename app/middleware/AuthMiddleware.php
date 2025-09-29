<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware {
    public function handle() {
        session_start();

        if (!isset($_SESSION['user'])) {
            redirect('auth/login');
            exit;
        }
    }
}
