<?php

namespace App\Models\Teacher;
use DateTime;
use CodeIgniter\Model;

class ApprovalDTR extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'teacher';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function ApprovedDTR($ID) {
        $query = "SELECT * FROM dtr WHERE AccID = $ID AND Status = 'Approved' ORDER BY ID DESC";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function DisapprovedDTR($ID) {
        $query = "SELECT * FROM dtr WHERE AccID = $ID AND Status = 'Not Approved' ORDER BY ID DESC";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function TotalPSTHours($ID) {
        $query = $this->db->query("SELECT Total FROM student WHERE ID = ?", [$ID]);
        $row = $query->getRow();
        $totalMinutes = ($row && isset($row->Total)) ? (int)$row->Total : 0; 
        return $this->formatOverallTime($totalMinutes);
    }

    private function formatOverallTime($totalMinutes) {
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        return "{$hours} hours and {$minutes} minutes";
    }

    public function ApproveTime($ID, $total, $studID){
        $totalMinutes = $this->convertToMinutes($total);
        $totalCurrentMinutes = $this->getCurrentTotal($studID);
        $newTotal = $totalCurrentMinutes + $totalMinutes;

        $this->updateTotalHours($studID, $newTotal);

        $sql = "UPDATE dtr SET Status = 'Approved' WHERE ID = ?";
        $this->db->query($sql, [$ID]);

        return ['status' => 'success', 'newTotal' => $newTotal];
    }

    private function updateTotalHours($ID, $newTotal) {
        $sql = "UPDATE student SET Total = ? WHERE ID = ?";
        $this->db->query($sql, [$newTotal, $ID]);
    }

    private function getCurrentTotal($ID) {
        $query = $this->db->query("SELECT Total FROM student WHERE ID = ?", [$ID]);
        $row = $query->getRow();
        return $row && isset($row->Total) ? (int)$row->Total : 0;
    }

    private function convertToMinutes($timeString) {
        preg_match('/(\d+)\s*hours?\s+and\s+(\d+)\s*minutes?/', $timeString, $matches);
        $hours = isset($matches[1]) ? (int)$matches[1] : 0;
        $minutes = isset($matches[2]) ? (int)$matches[2] : 0;
        return ($hours * 60) + $minutes;
    }

}
