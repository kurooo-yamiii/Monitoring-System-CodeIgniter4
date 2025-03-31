<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Maintenance\ListOfSchoolPasig;

class Maintenance extends BaseController
{
    private $session;
	private $postRequest;
    private $ListOfSchoolPasig;
    protected $helper;
    protected $db;

    public function __construct() {
        $this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->postRequest = \Config\Services::request();
        $this->ListOfSchoolPasig = new ListOfSchoolPasig();
        helper('utility');
	}

    public function PreviewListOfSchool() {
        return view('Maintenance/ListOfSchoolPasig');
    }

    public function GerAllSchoolPasig() {
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

}
