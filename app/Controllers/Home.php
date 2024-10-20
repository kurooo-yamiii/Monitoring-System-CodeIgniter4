<?php

namespace App\Controllers;

use App\Models\Login;

class Home extends BaseController
{
    private $session;
	private $postRequest;
	private $Login;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->Login = new Login();
        helper('utility');
	}

    public function index(): string
    {
        return view('Login');
    }

    public function getemployees() {
        $username = $this->request->getVar('user');
        $password = $this->request->getVar('pas');
        $data = $this->Login->CallStudent($username, $password);
        if ($data) {
            $this->session->set([
                'ID' => $data['ID'],
                'Name' => $data['Name'],
                'Username' => $data['Username'],
                'Password' => $data['Password']
            ]);
            return $this->response->setJSON(['status' => '200', 'data' => $data]);
        } else {
            return $this->response->setJSON(['status' => '401', 'message' => 'Invalid credentials']);
        }
    }
}
