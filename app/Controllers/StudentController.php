<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Student\StudentModel;
use App\Models\Student\PSTDashboard;
use App\Models\Student\StudentDTR;
use App\Models\Student\StudentEvaluation;
use App\Models\Student\StudentAnnouncement;
use App\Models\Student\ToDoList;
use App\Models\Student\StudentProfile;
use CodeIgniter\HTTP\ResponseInterface;

class StudentController extends BaseController
{
    private $session;
	private $postRequest;
    private $StudentModel;
    private $PSTDashboard;
    private $StudentDTR;
    private $StudentEvaluation;
    private $StudentAnnouncement;
    private $ToDoList;
    private $StudentProfile;
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
        $this->StudentAnnouncement = new StudentAnnouncement();
        $this->ToDoList = new ToDoList();
        $this->StudentProfile = new StudentProfile();
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

    public function PreviewAnnouncment() {
        return view('Student/StudentAnnouncement');
    }

    public function PreviewToDoList() {
        return view('Student/ToDoList');
    }

    public function PreviewProfile() {
        return view('Student/StudentProfile');
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

    public function FetchEvaluationTable() {
        $ID = $this->request->getVar('ID');
        $data = $this->StudentEvaluation->OrganizeTableEvaluation($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function FetchEvaluationRemarks() {
        $ID = $this->request->getVar('ID');
        $data = $this->StudentEvaluation->GetEvaluationRemarks($ID);
        return $this->response->setJSON($data);
    }

    public function FetchAnnouncement() {
        $id = $this->request->getVar('userId'); 
        $announcements = $this->StudentAnnouncement->GetAllAnnouncement();
        foreach ($announcements as &$announcement) {
            $announcement->likesArray = !empty($announcement->LikeID) ? explode(',', $announcement->LikeID) : [];
            $announcement->liked = in_array($id, $announcement->likesArray);

            $announcement->heartsArray = !empty($announcement->HeartID) ? explode(',', $announcement->HeartID) : [];
            $announcement->hearted = in_array($id, $announcement->heartsArray);
        }
        return $this->response->setJSON($announcements);
    }

    public function UpdateLikeStatus() {
        $id = $this->request->getVar('id'); 
        $userId = $this->request->getVar('userid');
        $newLikeCount = $this->StudentAnnouncement->LikeStatusManipulate($id, $userId);
        return $this->response->setJSON(['status' => 'success', 'likes' => $newLikeCount]);
    }

    public function UpdateHeartStatus() {
        $id = $this->request->getVar('id'); 
        $userId = $this->request->getVar('userid');
        $newHeartCount = $this->StudentAnnouncement->HeartStatusManipulate($id, $userId);
        return $this->response->setJSON(['status' => 'success', 'hearts' => $newHeartCount]);
    }    

    public function FetchAllTodoList() {
        $ID = $this->request->getVar('ID');
        $data = $this->ToDoList->GetAllTodoList($ID);
        return $this->response->setJSON($data);
    }

    public function UpdateToDoStatus(){
        $ID = $this->request->getVar('ID');
        $ItemID = $this->request->getVar('ItemID');
        $result = $this->ToDoList->UpdateStatusTodoList($ID, $ItemID);

        if ($result === "Success") {
            return $this->response->setJSON(['status' => 'success', 'message' => 'To-do item updated successfully.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update to-do item.']);
        }
    }

    public function UpdateUserProfile() {
		try {
			helper('url');

			$id = $this->request->getVar('ID');
			$name = $this->request->getVar('name');
			$password = $this->request->getVar('password');
            $program = $this->request->getVar('program');
            $section = $this->request->getVar('section');
            $contact = $this->request->getVar('contact');
			$file = $this->request->getFile('img');

			if (empty($id) || empty($name) || empty($password)) {
				return $this->response->setStatusCode(400)->setJSON(['message' => 'Name, ID, and password are required.']);
			}

			if ($file && $file->isValid()) {
				if ($file->getSize() > 2 * 1024 * 1024) {
					return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: The uploaded file is too large.']);
				}

				$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
				if (!in_array($file->getClientMimeType(), $allowedTypes)) {
					return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: Invalid file type.']);
				}

				$newName = uniqid('IMG-', true) . '.' . $file->getExtension();
				$file->move('./assets/uploads/', $newName); 

				$this->StudentProfile->UpdateUserProfile($id, $name, $password, $program, $section, $contact, $newName);
				return $this->response->setStatusCode(200)->setJSON(['message' => 'User profile updated successfully']);
			
			} else {
				if ($file && !$file->isValid()) {
					switch ($file->getError()) {
						case UPLOAD_ERR_INI_SIZE:
						case UPLOAD_ERR_FORM_SIZE:
							return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: The uploaded file is too large.']);
						case UPLOAD_ERR_NO_FILE:
							return $this->response->setStatusCode(400)->setJSON(['message' => 'No file was uploaded.']);
						default:
							return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: ' . $file->getErrorString()]);
					}
				}

				$this->StudentProfile->UpdateUserProfile($id, $name, $password, $program, $section, $contact, null); 
				return $this->response->setStatusCode(200)->setJSON(['message' => 'User profile updated without changing the image.']);
			}
		} catch (\Exception $e) {
			return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred: ' . $e->getMessage()]);
		}
	}

    public function GetStudentProfile() {
        $ID = $this->request->getVar('ID');
        $data = $this->StudentProfile->GetAllStudentInformation($ID);
        return $this->response->setJSON($data);
    }

    public function logout() {
        $this->session->destroy();
        return view('Login');
    }

}
