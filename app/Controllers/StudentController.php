<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student\StudentModel;
use App\Models\Student\PSTDashboard;
use CodeIgniter\HTTP\ResponseInterface;

class StudentController extends BaseController
{
    private $session;
	private $postRequest;
    private $StudentModel;
    private $PSTDashboard;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->StudentModel = new StudentModel();
        $this->PSTDashboard = new PSTDashboard();
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

    public function PreviewDashboard() {
        return view('Student/PSTDashboard');
    }

    public function PSTInfoChart() {
        $ID = $this->request->getVar('ID');
        $scores = $this->PSTDashboard->PSTRecentScores($ID);
		return $this->response->setJSON([
			'scores' => $scores,
			'labels' => range(1, count($scores))
		]);
    }
	
	public function PSTBarChart() {
		 $ID = $this->request->getVar('ID');
		$scores = $this->PSTDashboard->PSTBarScores($ID);

		$labels = array_map(function($value) {
			return 'Evaluation ' . $value;
		}, range(1, count($scores['aT'])));

		echo json_encode([
			'labels' => $labels,
			'aT' => $scores['aT'],
			'bT' => $scores['bT'],
			'cT' => $scores['cT'],
			'dT' => $scores['dT']
		]);
	}
	
	public function PSTTableDTR() {
		$ID = $this->request->getVar('ID');
        $data = $this->PSTDashboard->PSTRecentDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function logout() {
        $this->session->destroy();
        return view('Login');
    }

}
