<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student\StudentModel;
use App\Models\Student\PSTDashboard;
use App\Models\Student\StudentDTR;
use App\Models\Student\StudentEvaluation;
use CodeIgniter\HTTP\ResponseInterface;

class StudentController extends BaseController
{
    private $session;
	private $postRequest;
    private $StudentModel;
    private $PSTDashboard;
    private $StudentDTR;
    private $StudentEvaluation;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->StudentModel = new StudentModel();
        $this->PSTDashboard = new PSTDashboard();
        $this->StudentDTR = new StudentDTR();
        $this->StudentEvaluation = new StudentEvaluation();
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

    public function PreviewDTR() {
        return view('Student/StudentDTR');
    }

    public function PreviewEvaluation() {
        return view('Student/StudentEvaluation');
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

    public function GetAllPSTDTR() {
        $ID = $this->request->getVar('ID');
        $data = $this->StudentDTR->GetAllDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function PublishDTR() {
        $ID = $this->request->getVar('ID');
        $Date = $this->request->getVar('Date');
        $Timein = $this->request->getVar('TimeIn');
        $Timeout = $this->request->getVar('TimeOut');
        $data = $this->StudentDTR->CreateNewDTR($ID, $Date, $Timein, $Timeout);
        return $this->response->setJSON($data);
    }

    public function TotalHourNMinutes() {
        $ID = $this->request->getVar('ID');
        $data = $this->StudentDTR->getCurrentTotal($ID);
        return $this->response->setJSON(['totalTime' => $data]);
    }

    public function PSTEvaluation() {
        $ID = $this->request->getVar('ID');
        $data = $this->StudentEvaluation->GetAllEvaluation($ID);
        return $this->response->setJSON($data);
    }

    public function logout() {
        $this->session->destroy();
        return view('Login');
    }

}
