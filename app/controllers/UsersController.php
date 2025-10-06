<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        $this->call->library('Auth');
        $this->call->library('pagination'); // ✅ make sure pagination library is loaded
    }

    public function index()
    {
        // Require login
        $this->Auth->require_login();
        $data['current_user'] = $this->Auth->current_user();

        // --- Get current page ---
        $page = (int) $this->io->get('page', 1);
        if ($page < 1) $page = 1;

        // --- Search query ---
        $q = trim($this->io->get('q', ''));

        // --- Records per page ---
        $records_per_page = 5;

        // --- Fetch paginated results ---
        $all = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // --- Pagination setup ---
        if (!empty($q)) {
            // Example: /users?q=john&page=2
            $page_url = '?q=' . urlencode($q) . '&page=';
        } else {
            // Example: /users?page=2
            $page_url = '?page=';
        }

        $this->pagination->set_options([
            'first_link' => '⏮ First',
            'last_link'  => 'Last ⏭',
            'next_link'  => 'Next →',
            'prev_link'  => '← Prev',
            'full_tag_open'  => '<div class="pagination">', // optional styling
            'full_tag_close' => '</div>'
        ]);

        $this->pagination->set_theme('default');

        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            $page_url
        );

        $data['page_links'] = $this->pagination->paginate(); // renamed for clarity

        // --- Load view ---
        $this->call->view('users/index', $data);
    }

    public function create()
    {
        $this->Auth->require_login();
        $this->Auth->require_role('admin');

        if ($this->io->method() == 'post') {
            $data = [
                'firstname'  => $this->io->post('firstname'),
                'lastname'   => $this->io->post('lastname'),
                'username'   => $this->io->post('username'),
                'email'      => $this->io->post('email'),
                'role'       => 'user',
                'password'   => password_hash($this->io->post('password'), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect(site_url('users')); // ✅ redirect to /users
            } else {
                echo "Error in creating user.";
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        $this->Auth->require_login();
        $this->Auth->require_role('admin');

        $user = $this->UsersModel->find($id);
        if (!$user) {
            echo "User not found.";
            return;
        }

        if ($this->io->method() == 'post') {
            $data = [
                'firstname'  => $this->io->post('firstname'),
                'lastname'   => $this->io->post('lastname'),
                'username'   => $this->io->post('username'),
                'email'      => $this->io->post('email'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->update($id, $data)) {
                redirect(site_url('users'));
            } else {
                echo "Error in updating user.";
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        $this->Auth->require_login();
        $this->Auth->require_role('admin');

        if ($this->UsersModel->delete($id)) {
            redirect(site_url('users'));
        } else {
            echo "Error in deleting user.";
        }
    }
}
