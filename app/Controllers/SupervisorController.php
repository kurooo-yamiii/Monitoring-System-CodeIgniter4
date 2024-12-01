<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Supervisor\SupervisorModel;
use App\Models\Supervisor\SVDashboard;
use App\Models\Supervisor\PSTAccount;
use App\Models\Supervisor\RTAccount;
use App\Models\Supervisor\Deployment;
use App\Models\Supervisor\Announcement;
use App\Models\Supervisor\Profile;
use App\Models\Supervisor\Statistic;
use App\Models\Supervisor\SupervisorLP;
use App\Models\Supervisor\SPRequirements;
use CodeIgniter\HTTP\ResponseInterface;

class SupervisorController extends BaseController
{
    private $session;
	private $postRequest;
	private $SupervisorModel;
    private $SVDashboard;
    private $PSTAccount;
    private $RTAccount;
    private $Deployment;
    private $Announcement;
    private $Profile;
    private $Statistic;
    private $SupervisorLP;
    private $SPRequirements;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->SupervisorModel = new SupervisorModel();
        $this->SVDashboard = new SVDashboard();
        $this->PSTAccount = new PSTAccount();
        $this->RTAccount = new RTAccount();
        $this->Deployment = new Deployment();
        $this->Announcement = new Announcement();
        $this->Profile = new Profile();
        $this->Statistic = new Statistic();
        $this->SupervisorLP = new SupervisorLP();
        $this->SPRequirements = new SPRequirements();
        helper('utility');
	}

    public function PreviewDashboard() {
        return view('Supervisor/Dashboard');
    }

    public function PreviewPST() {
        return view('Supervisor/PSTAccount');
    }

    public function PreviewRT() {
        return view('Supervisor/RTAccount');
    }

    public function PreviewDeployment() {
        return view('Supervisor/Deployment');
    }

    public function PreviewAnnouncement() {
        return view('Supervisor/Announcement');
    }

    public function PreviewProfile() {
        return view('Supervisor/Profile');
    }

    public function PreviewStatistic() {
        return view('Supervisor/Statistic');
    }

    public function PreviewSupervisorLP() {
        return view('Supervisor/SupervisorLP');
    }

    public function PreviewRequirements() {
        return view('Supervisor/SPRequirements');
    }


    public function index()
    {
        $supervisorID = $this->session->get('ID');
        $data['images'] = $this->SupervisorModel->select('Profile')
        ->where('ID', $supervisorID)
        ->where('Profile !=', '')
        ->first();
        return view('Supervisor/Supervisor', $data);
    }

    public function Dashboard()
    {   
        $data = $this->SVDashboard->getAllStudentTeacher();
        return $this->response->setJSON([
            'data' => $data
        ]);
    }

    public function Program() {
        $data = $this->SVDashboard->getStudentProgram();
        return $this->response->setJSON($data);
    }

    public function SchoolManda() {
        $data = $this->SVDashboard->getMandaCoop();
        return $this->response->setJSON($data);
    }

    public function SchoolPasig() {
        $data = $this->SVDashboard->getPasigCoop();
        return $this->response->setJSON($data);
    }

    public function DeployStandBy(){
        $data = $this->SVDashboard->standByDeploy();
        return $this->response->setJSON($data);
    }

    public function RecentDeploy(){
        $data = $this->SVDashboard->fetchRecentDep();
        return $this->response->setJSON(['data' => $data]);
    }

    public function AllStudentAcc() {
        $data = $this->PSTAccount->getPSTAccount();
        return $this->response->setJSON(['data' => $data]);
    }

    public function CreatePST() {
        $supervisor = $this->request->getVar('Supervisor');
        $email = $this->request->getVar('Email');
        $name = $this->request->getVar('Name');
        $contact = $this->request->getVar('Contact');
        $program = $this->request->getVar('Program');
        $section = $this->request->getVar('Section');

        if (empty($email) || empty($name) || empty($supervisor) || empty($contact) || empty($program) || empty($section)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up All the Missing Field']);
        }

        $data = [ $supervisor, $email . "@rtu.ced.com", $name, $contact, $program, $section ];

        $mergedEmail = $email . "@rtu.ced.com";
        $emailExisting = $this->PSTAccount->CheckExistingPST($mergedEmail);

        if($emailExisting){
            return $this->response->setStatusCode(200)->setJSON(['invalid' => 'This Institutional Email is Already Used']);
        }

        $result = $this->PSTAccount->insertStudent($data);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'PST successfully generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid credentials or error inserting data.']);
        }
    }

    public function DeletePST() {
        $ID = $this->request->getVar('ID');
        $result = $this->PSTAccount->deleteStudent($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'PST Deleted.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function ResetPST() {
        $ID = $this->request->getVar('ID');
        $result = $this->PSTAccount->resetPassword($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Succesfully Reset']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function AllProfessorAcc() {
        $data = $this->RTAccount->getTeacherAcc();
        return $this->response->setJSON(['data' => $data]);
    }

    public function CreateProf() {
        $email = $this->request->getVar('Email');
        $name = $this->request->getVar('Name');
        $coordinator = $this->request->getVar('Coordinator');
        $school = $this->request->getVar('School');
        $division = $this->request->getVar('Division');
        $grade = $this->request->getVar('Grade');

        if (empty($email) || empty($name) || empty($coordinator) || empty($school) || empty($division) || empty($grade)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up All the Missing Field']);
        }

        $data = [ $grade, $email . "@rtu.ced.com", $name, $coordinator, $school, $division ];
        
        $mergedEmail = $email . "@rtu.ced.com";
        $emailExisting = $this->RTAccount->CheckExistingRT($mergedEmail);

        if($emailExisting){
            return $this->response->setStatusCode(200)->setJSON(['invalid' => 'This Institutional Email is Already Used']);
        }

        $result = $this->RTAccount->insertProfessor($data);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'RT Successfully Generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Invalid credentials or error inserting data.']);
        }
    }

    public function DeleteProf(){
        $ID = $this->request->getVar('ID');
        $result = $this->RTAccount->deleteProfessor($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'RT Deleted']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function ResetRT() {
        $ID = $this->request->getVar('ID');
        $result = $this->RTAccount->resetPassword($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Succesfully Reset']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function FetchAllofPST() {
        $data = $this->Deployment->GetPSTStudents();
        return $this->response->setJSON($data);
    }

    public function FetchAllofCoop() {
        $data = $this->Deployment->GetCoopTeacher();
        return $this->response->setJSON($data);
    }

    public function SearchPSTStudents() {
        $term = $this->request->getVar('searchTerm');
        $data = $this->Deployment->SearchPST($term);
        return $this->response->setJSON($data);
    }

    public function SearchCooperatingTeach() {
        $term = $this->request->getVar('searchTerm');
        $data = $this->Deployment->searchCOOP($term);
        return $this->response->setJSON($data);
    }
    
    public function DeployPSTnCoop(){
        $idpst = $this->request->getVar('idpst');
        $idcoop = $this->request->getVar('idcoop');
        $name = $this->request->getVar('name');
        $school = $this->request->getVar('school');
        $division = $this->request->getVar('division');
        $grade = $this->request->getVar('grade');
        $coor = $this->request->getVar('coor');
        $result = $this->Deployment->DeployStudentnProfessor($idpst, $idcoop, $name, $school, $division, $grade, $coor);
       
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['status' => 200, 'message' => 'Successfully Deployed']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['status' => 400, 'message' => 'Something Went Wrong Try Again']);
        }
    }

    public function FetchAnnouncement() {
        $data = $this->Announcement->GetAllAnnouncement();
        return $this->response->setJSON($data);
    }

    public function AddPostAnnouncement() {
        try {
            helper('url');
    
            $name = $this->request->getVar('name');
            $title = $this->request->getVar('title');
            $post = $this->request->getVar('post');
            $date = $this->request->getVar('date');
            $file = $this->request->getFile('img');
    
            if ($file && $file->isValid()) {
                $newName = uniqid('IMG-', true) . '.' . $file->getExtension();
                $file->move('./assets/uploads/', $newName); 
    
           
                $this->Announcement->InsertAnnouncement($name, $newName, $title, $post, $date);
    
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Announcement posted successfully']);
            } elseif ($file && !$file->isValid()) {
                switch ($file->getError()) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: The uploaded file is too large.']);
                    case UPLOAD_ERR_NO_FILE:
                        return $this->response->setStatusCode(400)->setJSON(['message' => 'No file was uploaded.']);
                    default:
                        return $this->response->setStatusCode(400)->setJSON(['message' => 'File upload failed: ' . $file->getErrorString()]);
                }
            } else {
                $this->Announcement->InsertAnnouncement($name, null, $title, $post, $date); 
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Announcement posted without an image.']);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function DeleteAnnouncement(){
        $ID = $this->request->getVar('delID');
        $result = $this->Announcement->deleteAnnouncement($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Announcement Deleted']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function UpdateAnnouncement() {
        try {
            helper('url');
    
            $id = $this->request->getVar('ID');
            $title = $this->request->getVar('title');
            $post = $this->request->getVar('post');
            $file = $this->request->getFile('img');

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

                $this->Announcement->UpdateAnnouncement($id, $title, $post, $newName);
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Announcement updated successfully']);
            
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
    
                $this->Announcement->UpdateAnnouncement($id, $title, $post, null); 
                return $this->response->setStatusCode(200)->setJSON(['message' => 'Announcement updated without changing the image.']);
            }
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }    
    public function GetUserProfile() {
        $ID = $this->request->getVar('ID');
        $data = $this->Profile->GetSupervisorUser($ID);
        return $this->response->setJSON($data);
    }
	
	public function UpdateUserProfile() {
		try {
			helper('url');

			$id = $this->request->getVar('ID');
			$name = $this->request->getVar('name');
			$password = $this->request->getVar('password');
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

				$this->Profile->UpdateUserProfile($id, $name, $password, $newName);
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

				$this->Profile->UpdateUserProfile($id, $name, $password, null); 
				return $this->response->setStatusCode(200)->setJSON(['message' => 'User profile updated without changing the image.']);
			}
		} catch (\Exception $e) {
			return $this->response->setStatusCode(500)->setJSON(['message' => 'An error occurred: ' . $e->getMessage()]);
		}
	}
	
	 public function LoadAllPST() {
        $data = $this->Statistic->GetAllPST();
        return $this->response->setJSON($data);
    }
	
	 public function GetInfoChart() {
        $ID = $this->request->getVar('ID');
        $scores = $this->Statistic->getRecentScores($ID);
		return $this->response->setJSON([
			'scores' => $scores,
			'labels' => range(1, count($scores))
		]);
    }
	
	public function GetBarChart() {
		 $ID = $this->request->getVar('ID');
		$scores = $this->Statistic->getBarScores($ID);

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
	
	public function GetTableDTR() {
		$ID = $this->request->getVar('ID');
        $data = $this->Statistic->GetThreeDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function GetPSTEvaluation() {
		$ID = $this->request->getVar('ID');
        $data = $this->Statistic->GetAllPSTEvaluation($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function GetPSTDTR() {
        $ID = $this->request->getVar(index: 'ID');
        $data = $this->Statistic->GetAllDTR($ID);
        return $this->response->setJSON(['data' => $data]);
    }

    public function SearchDeployedPST() {
        $search = $this->request->getVar(index: 'search');
        $data = $this->Statistic->GetSearchData($search);
        return $this->response->setJSON($data);
    }

    public function SearchByMajor() {
        $major = $this->request->getVar(index: 'major');
        $data = $this->Statistic->FetchByMajor($major);
        return $this->response->setJSON($data);
    }

    public function GetAllStudentLP() {
        $data = $this->SupervisorLP->FetchAllLessonLP();
        return $this->response->setJSON(['data' => $data]);
    }

    public function SpecificStudentLP() {
        $ID = $this->request->getVar('ID');
        $data = $this->SupervisorLP->SelectedStudentLP($ID);
        return $this->response->setJSON($data);
    }

    public function LPTotalAverage() {
        $ID = $this->request->getPost('ID'); 
        if (!$ID) {
            return $this->response->setJSON(['error' => 'Invalid Student ID']);
        }
        
        $data = $this->SupervisorLP->LPFinalEvaluation($ID);
        
        if ($data) {
            return $this->response->setJSON(['grade' => $data]);
        } else {
            return $this->response->setJSON(['grade' => null]);
        }
    }

    public function RequirementsStatus() {
        $data = $this->SPRequirements->FetchAllRequirementsGrade();
        return $this->response->setJSON(['data' => $data]);
    }

    public function UpdateRequirements() {
        $ID = $this->request->getPost('ID'); 
        $Grade = $this->request->getPost('Grade'); 

        if($Grade > 100 || $Grade < 60){
            return $this->response->setStatusCode(200)->setJSON(['invalid' => 'This is an Invalid Grade']);
        }else{
            $this->SPRequirements->UpdateStudentGrade($ID, $Grade); 
			return $this->response->setStatusCode(200)->setJSON(['message' => 'Requirements Graded Successfully']);
        }
    }

    public function PSTGetAllRequirements() {
        $ID = $this->request->getVar('ID');
        $data = $this->SPRequirements->RequirementsOfPST($ID);
        return $this->response->setJSON($data);
    }
    
    public function logout() {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}
