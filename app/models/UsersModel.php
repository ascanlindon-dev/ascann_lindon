<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'Users';
    protected $primary_key = 'id';
    protected $allowed_fields = ['firstname', 'lastname', 'username', 'email', 'role', 'password', 'created_at'];
    protected $validation_rules = [
        'firstname' => 'required|min_length[2]|max_length[100]',
        'lastname' => 'required|min_length[2]|max_length[100]',
        'username' => 'required|min_length[2]|max_length[150]',
        'email' => 'required|valid_email|max_length[150]',
        'role' => 'required',
        'password' => 'required',
        'created_at' => 'valid_date'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            return [
                'total_rows' => $this->db->table($this->table)->count_all(),
                'records'    => $this->db->table($this->table)->get_all()
            ];
        } else {
            $query = $this->db->table($this->table);

            if (!empty($q)) {
                $term = '%'. $q .'%';
                $query->grouped(function($qb) use ($term) {
                    $qb->like('firstname', $term)
                       ->or_like('lastname', $term)
                       ->or_like('username', $term)
                       ->or_like('email', $term);
                });
            }

            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();
            return $data;
        }
    }
}