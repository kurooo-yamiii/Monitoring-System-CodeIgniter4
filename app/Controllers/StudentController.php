<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student\StudentModel;
use CodeIgniter\HTTP\ResponseInterface;

class StudentController extends BaseController
{
    private $session;
	private $postRequest;
    private $StudentModel;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->StudentModel = new StudentModel();
        helper('utility');
	}
    
    public function index()
    {
        $studentID = $this->session->get('ID');
        $data['images'] = $this->StudentModel->select('Profile')
        ->where('ID', $studentID)
        ->where('Profile !=', '')
        ->first();
        return view('Student/Student', $data);
    }
}
