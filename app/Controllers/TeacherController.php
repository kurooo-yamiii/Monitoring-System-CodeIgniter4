<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Teacher\TeacherModel;
use App\Models\Teacher\TeacherDashboard;
use App\Models\Teacher\ApprovalDTR;

class TeacherController extends BaseController
{
    private $session;
	private $postRequest;
    private $TeacherModel;
    private $TeacherDashboard;
    private $ApprovalDTR;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->TeacherModel = new TeacherModel();
        $this->TeacherDashboard = new TeacherDashboard();
        $this->ApprovalDTR = new ApprovalDTR();
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

    public function PreviewApprovalDTR() {
        return view('Teacher/ApprovalDTR');
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

    public function GetApprovedDTR() {
        $ID = $this->request->getVar('ID');
        $data = $this->ApprovalDTR->ApprovedDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function GetDisapprovedDTR() {
        $ID = $this->request->getVar('ID');
        $data = $this->ApprovalDTR->DisapprovedDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function PSTTotalHours() {
        $ID = $this->request->getVar('ID');
        $data = $this->ApprovalDTR->TotalPSTHours($ID);
        return $this->response->setJSON(['totalTime' => $data]);
    }

    public function TimeApproved(){
        $ID = $this->request->getVar('ID');
        $total = $this->request->getVar('total');
        $studID = $this->request->getVar('studID');
        $data = $this->ApprovalDTR->ApproveTime($ID, $total, $studID);
        return $this->response->setJSON( $data);
    }

    public function logout() {
        $this->session->destroy();
        return view('Login');
    }
}
