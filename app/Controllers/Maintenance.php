<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Maintenance\ListOfSchoolPasig;
use App\Models\Maintenance\ListOfSchoolManda;
use App\Models\Maintenance\ListOfDivision;
use App\Models\Maintenance\ListOfLevel;
use App\Models\Maintenance\ListOfBlock;

class Maintenance extends BaseController
{
    private $session;
	private $postRequest;
    private $ListOfSchoolPasig;
    private $ListOfSchoolManda;
    private $ListOfDivision;
    private $ListOfLevel;
    private $ListOfBlock;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->ListOfSchoolPasig = new ListOfSchoolPasig();
        $this->ListOfSchoolManda = new ListOfSchoolManda();
        $this->ListOfDivision = new ListOfDivision();
        $this->ListOfLevel = new ListOfLevel();
        $this->ListOfBlock = new ListOfBlock();
        helper('utility');
	}

    public function PreviewListOfSchool() {
        return view('Maintenance/ListOfSchoolPasig');
    }

    public function PreviewListOfSchoolManda() {
        return view('Maintenance/ListOfSchoolManda');
    }

    public function PreviewListOfDivision() {
        return view('Maintenance/ListOfDivision');
    }

    public function PreviewListOfGrade() {
        return view('Maintenance/ListOfLevel');
    }

    public function PreviewListOfBlock() {
        return view('Maintenance/ListOfBlock');
    }


    public function GetAllSchoolPasig() {
        $data = $this->ListOfSchoolPasig->GetListOfSchoolPasig();
        return $this->response->setJSON(['data' => $data]);
    }

    public function FetchDeployedSchoolAbbreviation() {
        $data = $this->ListOfSchoolPasig->FetchDeployedAbbreviationPasig();
        return $this->response->setJSON($data);
    }

    public function CraetePasigSchool() {
        $school = strtoupper($this->request->getVar('School'));
        $abbreviation = strtoupper($this->request->getVar('Abbreviation'));

        if (empty($school) || empty($abbreviation)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Input Deploying School']);
        }


        $result = $this->ListOfSchoolPasig->GenerateDeployingSchoolPasig($school, $abbreviation);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Pasig Deploying School Succesfully Generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function UpdatePasigSchool() {
        $school = strtoupper($this->request->getVar('School'));
        $abbreviation = strtoupper($this->request->getVar('Abbreviation'));
        $ID = strtoupper($this->request->getVar('ID'));

        if (empty($school) || empty($abbreviation)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Input Deploying School']);
        }


        $result = $this->ListOfSchoolPasig->UpdateDeployingSchoolPasig($ID, $school, $abbreviation);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Pasig Deploying School Succesfully Updated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function DeletePasigDeployingSchool() {
        $ID = $this->request->getVar('ID');
        $result = $this->ListOfSchoolPasig->DeleteDeployingSchoolPasig($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Pasig Deploying School Successfully Deleted.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function GetAllSchoolManda() {
        $data = $this->ListOfSchoolManda->GetListOfSchoolManda();
        return $this->response->setJSON(['data' => $data]);
    }

    public function FetchMandaDeployedSchool() {
        $data = $this->ListOfSchoolManda->FetchMandaSchool();
        return $this->response->setJSON($data);
    }

    public function CreateMandaSchool() {
        $school = strtoupper($this->request->getVar('School'));
        $abbreviation = strtoupper($this->request->getVar('Abbreviation'));

        if (empty($school) || empty($abbreviation)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Input Deploying School']);
        }


        $result = $this->ListOfSchoolManda->GenerateDeployingSchoolManda($school, $abbreviation);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Manda Deploying School Succesfully Generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function UpdateMandaSchool() {
        $school = strtoupper($this->request->getVar('School'));
        $abbreviation = strtoupper($this->request->getVar('Abbreviation'));
        $ID = strtoupper($this->request->getVar('ID'));

        if (empty($school) || empty($abbreviation)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Input Deploying School']);
        }


        $result = $this->ListOfSchoolManda->UpdateDeployingSchoolManda($ID, $school, $abbreviation);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Pasig Deploying School Succesfully Updated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function DeleteMandaDeployingSchool() {
        $ID = $this->request->getVar('ID');
        $result = $this->ListOfSchoolManda->DeleteDeployingSchoolManda($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Pasig Deploying School Successfully Deleted.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function GetAllDivision() {
        $data = $this->ListOfDivision->GetListofDivision();
        return $this->response->setJSON(['data' => $data]);
    }

    public function CreateDivision() {
        $division = strtoupper($this->request->getVar('Division'));
        $type = strtoupper($this->request->getVar('Type'));

        $validation = $this->ListOfDivision->CheckExistingDivision($division);

        if (empty($type) || empty($division)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up all the Fields']);
        } else if ($validation) {
            return $this->response->setStatusCode(200)->setJSON(['existing' => 'This Division is Currently Existing']);
        }

        $result = $this->ListOfDivision->GenerateNewDivision($division, $type);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'New Division Succesfully Generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function UpdateSchoolDivision() {
        $division = strtoupper($this->request->getVar('Division'));
        $type = strtoupper($this->request->getVar('Type'));
        $ID = strtoupper($this->request->getVar('ID'));

        $validation = $this->ListOfDivision->CheckExistingDivision($division);

        if (empty($division) || empty($type)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up all the Fields']);
        } else if ($validation) {
            return $this->response->setStatusCode(200)->setJSON(['existing' => 'This Division is Currently Existing']);
        }

        $result = $this->ListOfDivision->UpdateSchoolDivision($ID, $division, $type);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Division Succesfully Updated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function DeleteSchoolDivision() {
        $ID = $this->request->getVar('ID');
        $result = $this->ListOfDivision->DeleteDivision($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'School Division Successfully Deleted.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function GetAllGrade() {
        $data = $this->ListOfLevel->GetListOfGrade();
        return $this->response->setJSON(['data' => $data]);
    }

    public function CreateGrade() {
        $grade = strtoupper($this->request->getVar('Grade'));
        $level = strtoupper($this->request->getVar('Level'));

        $validation = $this->ListOfLevel->CheckExistingGrade($grade);

        if (empty($level) || empty($grade)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up all the Fields']);
        } else if ($validation) {
            return $this->response->setStatusCode(200)->setJSON(['existing' => 'This Grade is Currently Existing']);
        }

        $result = $this->ListOfLevel->GenerateNewGrade($grade, $level);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'New Grade Succesfully Generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function UpdateSchoolGrade() {
        $grade = strtoupper($this->request->getVar('Grade'));
        $level = strtoupper($this->request->getVar('Level'));
        $ID = strtoupper($this->request->getVar('ID'));

        $validation = $this->ListOfLevel->CheckExistingGrade($grade);

        if (empty($grade) || empty($level)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up all the Fields']);
        } else if ($validation) {
            return $this->response->setStatusCode(200)->setJSON(['existing' => 'This Grade is Currently Existing']);
        }

        $result = $this->ListOfLevel->UpdateGradeLevel($ID, $grade, $level);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Grade Succesfully Updated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    } 

    public function DeleteSchoolGrade() {
        $ID = $this->request->getVar('ID');
        $result = $this->ListOfLevel->DeleteGrade($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'School Grade Level Successfully Deleted.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

    public function GetAllSection() {
        $data = $this->ListOfBlock->GetListofBlock();
        return $this->response->setJSON(['data' => $data]);
    }

    public function CreateSection() {
        $section = strtoupper($this->request->getVar('Section'));
        $branch = strtoupper($this->request->getVar('Branch'));

        $validation = $this->ListOfBlock->CheckExistingSection($section);

        if (empty($branch) || empty($section)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up all the Fields']);
        } else if ($validation) {
            return $this->response->setStatusCode(200)->setJSON(['existing' => 'This Section is Currently Existing']);
        }

        $result = $this->ListOfBlock->GenerateNewSection($section, $branch);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'New Section Succesfully Generated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function UpdateSchoolSection() {
        $section = strtoupper($this->request->getVar('Section'));
        $branch = strtoupper($this->request->getVar('Branch'));
        $ID = strtoupper($this->request->getVar('ID'));

        $validation = $this->ListOfBlock->CheckExistingSection($section);

        if (empty($branch) || empty($section)) {
            return $this->response->setStatusCode(200)->setJSON(['missing' => 'Please Fill Up all the Fields']);
        } else if ($validation) {
            return $this->response->setStatusCode(200)->setJSON(['existing' => 'This Section is Currently Existing']);
        }

        $result = $this->ListOfBlock->UpdateSchoolGrade($ID, $section, $branch);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'New Section Succesfully Updated.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong, Try Again']);
        }
    }

    public function DeleteSchoolSection() {
        $ID = $this->request->getVar('ID');
        $result = $this->ListOfBlock->DeleteSection($ID);
        if ($result) {
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Section Successfully Deleted.']);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Something Went Wrong Try Again']);
        }
    }

}
