<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Teacher\TeacherModel;
use App\Models\Teacher\TeacherDashboard;
use App\Models\Teacher\ApprovalDTR;
use App\Models\Teacher\TeacherProfile;
use App\Models\Teacher\ToDoProf;
use App\Models\Teacher\ProfEvaluation;

class TeacherController extends BaseController
{
    private $session;
	private $postRequest;
    private $TeacherModel;
    private $TeacherDashboard;
    private $ApprovalDTR;
    private $TeacherProfile;
    private $ToDoProf;
    private $ProfEvaluation;
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
        $this->TeacherProfile = new TeacherProfile();
        $this->ToDoProf = new ToDoProf();
        $this->ProfEvaluation = new ProfEvaluation();
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

    public function PreviewProfile() {
        return view('Teacher/TeacherProfile');
    }

    public function PreviewToDoList() {
        return view('Teacher/ToDoProf');
    }

    public function PreviewEvaluation() {
        return view('Teacher/ProfEvaluation');
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

    public function TimeDisapproved(){
        $ID = $this->request->getVar('ID');
        $total = $this->request->getVar('total');
        $studID = $this->request->getVar('studID');
        $data = $this->ApprovalDTR->DisapproveTime($ID, $total, $studID);
        return $this->response->setJSON( $data);
    }

    public function DeleteDTR() {
        $ID = $this->request->getVar('ID');
        $total = $this->request->getVar('total');
        $studID = $this->request->getVar('studID');
        $status = $this->request->getVar('status');
        $data = $this->ApprovalDTR->DeleteSelectedDTR($ID, $total, $studID, $status);
        return $this->response->setJSON($data);
    }

    public function GetProfessorProfile() {
        $ID = $this->request->getVar('ID');
        $studID = $this->request->getVar('studID');
        $data = $this->TeacherProfile->GetAllProfessorInformation($ID, $studID);
        return $this->response->setJSON($data);
    }

    public function UpdateProfessorSignatory() {
		try {
			helper('url');
			$file = $this->request->getFile('img');
            $id = $this->request->getVar('ID');

			if ($file && $file->isValid()) {
				if ($file->getSize() > 2 * 1024 * 1024) {
					return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: The uploaded file is too large.']);
				}

				$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
				if (!in_array($file->getClientMimeType(), $allowedTypes)) {
					return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: Invalid file type.']);
				}

				$newName = uniqid('IMG-', true) . '.' . $file->getExtension();
				$file->move('./assets/signatory/', $newName); 

				$this->TeacherProfile->UpdateUserSignatory($newName, $id);
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
			}
		} catch (\Exception $e) {
			return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred: ' . $e->getMessage()]);
		}
	}

    public function UpdateUserProfile() {
		try {
			helper('url');

			$id = $this->request->getVar('ID');
			$name = $this->request->getVar('name');
			$password = $this->request->getVar('password');
            $school = $this->request->getVar('school');
            $division = $this->request->getVar('division');
            $grade = $this->request->getVar('grade');
            $coordinator = $this->request->getVar('coor');
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

				$this->TeacherProfile->UpdateUserProfile($id, $name, $password, $school, $division, $grade, $coordinator, $newName);
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

				$this->TeacherProfile->UpdateUserProfile($id, $name, $password, $school, $division, $grade, $coordinator, null); 
				return $this->response->setStatusCode(200)->setJSON(['message' => 'User profile updated without changing the image.']);
			}
		} catch (\Exception $e) {
			return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred: ' . $e->getMessage()]);
		}
	}

    public function FetchAllTodoList() {
        $ID = $this->request->getVar('ID');
        $data = $this->ToDoProf->GetAllTodoList($ID);
        return $this->response->setJSON($data);
    }

    public function AddNewToDo() {
        $ID = $this->request->getVar('ID');
        $Lesson = $this->request->getVar('Lesson');
        $Date = $this->request->getVar('Date');
        $result = $this->ToDoProf->CreateNewToDo($ID, $Lesson, $Date);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Success']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong']);
        }
    }

    public function PSTEvaluation() {
        $ID = $this->request->getVar('ID');
        $data = $this->ProfEvaluation->GetAllEvaluation($ID);
        return $this->response->setJSON($data);
    }

    public function FetchEvaluationTable() {
        $ID = $this->request->getVar('ID');
        $data = $this->ProfEvaluation->OrganizeTableEvaluation($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function FetchEvaluationRemarks() {
        $ID = $this->request->getVar('ID');
        $data = $this->ProfEvaluation->GetEvaluationRemarks($ID);
        return $this->response->setJSON($data);
    }

    public function CreateEvaluation() {
        $data = $this->request->getVar('data');
        $result = $this->ProfEvaluation->EvaluationCreation($data);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Evaluation Recorded Successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unknown Error Occure, Try Again']);
        }
    }

    public function UpdateEvaluation() {
        $data = $this->request->getVar('data');
        $result = $this->ProfEvaluation->UpdatingEvaluation($data);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Evaluation Updated Successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unknown Error Occure, Try Again']);
        }
    }

    public function logout() {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}
