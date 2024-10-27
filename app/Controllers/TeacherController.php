<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Teacher\TeacherModel;
use App\Models\Teacher\TeacherDashboard;

class TeacherController extends BaseController
{
    private $session;
	private $postRequest;
    private $TeacherModel;
    private $TeacherDashboard;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->TeacherModel = new TeacherModel();
        $this->TeacherDashboard = new TeacherDashboard();
        helper('utility');
	}
    public function index()
    {
        $teacherID = $this->session->get('ID');
        $data['images'] = $this->TeacherModel->select('Profile')
        ->where('ID', $teacherID)
        ->where('Profile !=', '')
        ->first();
        return view('Teacher/Teacher', $data);
    }

    public function PreviewDashboard() {
        return view('Teacher/TeacherDashboard');
    }

    public function StudentInfoChart() {
        $ID = $this->request->getVar('ID');
        $scores = $this->TeacherDashboard->StudentRecentScores($ID);
		return $this->response->setJSON([
			'scores' => $scores,
			'labels' => range(1, count($scores))
		]);
    }
	
	public function StudentBarChart() {
		 $ID = $this->request->getVar('ID');
		$scores = $this->TeacherDashboard->StudentBarScores($ID);

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
	
	public function StudentTableDTR() {
		$ID = $this->request->getVar('ID');
        $data = $this->TeacherDashboard->StudentRecentDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }
    public function logout() {
        $this->session->destroy();
        return view('Login');
    }
}
