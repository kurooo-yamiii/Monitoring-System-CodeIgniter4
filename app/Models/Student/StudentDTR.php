<?php

namespace App\Models\Student;
use DateTime;
use CodeIgniter\Model;

class StudentDTR extends Model
{
    protected $db;
    protected $CU_Model;
    protected $KeyBindings;
    protected $table            = 'student';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['Name', 'Resource', 'Program']; 

    public function GetAllDTR($ID) {
		$query = "SELECT * FROM dtr WHERE AccID = $ID ORDER BY ID DESC";
        $builder = $this->db->query($query);
        return $builder->getResult();
    }

    public function CreateNewDTR($ID, $date, $timeIn, $timeOut) {
        if (empty($timeIn) || empty($timeOut) || empty($date)) {
            return ['status' => 'error', 'message' => 'Please fill out all fields.'];
        }
    
        $timeInObject = new DateTime($timeIn);
        $formattedTimeIn = $timeInObject->format('h:i A');
        $timeOutObject = new DateTime($timeOut);
        $formattedTimeOut = $timeOutObject->format('h:i A');
    
        $timeInMinutes = $this->convertTimeToMinutes($formattedTimeIn);
        $timeOutMinutes = $this->convertTimeToMinutes($formattedTimeOut);
    
        $overallMinutes = max(0, $timeOutMinutes - $timeInMinutes);
    
        if ($overallMinutes > 360) {
            $overallMinutes = 360;
        }

        $formattedTotalTime = $this->formatMinutesToHoursAndMinutes($overallMinutes);
    
        $sql = "INSERT INTO dtr(AccID, Date, TimeIn, TimeOut, TotalHrs, Status) VALUES(?, ?, ?, ?, ?, 'Not Approved')";
        $this->db->query($sql, [$ID, $date, $formattedTimeIn, $formattedTimeOut, $formattedTotalTime]);
    
        return ['status' => 'success', 'message' => 'DTR recorded successfully.'];
    }
    
    private function convertTimeToMinutes($time) {
        list($hours, $minutes) = explode(':', $time);
        $am_pm = substr($minutes, -2);
        
        if ($am_pm == 'PM' && $hours != 12) {
            $hours += 12;
        }
    
        return ($hours * 60) + (int)$minutes;
    }
    
    public function getCurrentTotal($ID) {
        $query = $this->db->query("SELECT Total FROM student WHERE ID = ?", [$ID]);
        $row = $query->getRow();
        $totalMinutes = $row && isset($row->Total) ? $row->Total : 0;
        return $this->formatOverallTime($totalMinutes);
    }

    private function formatMinutesToHoursAndMinutes($totalMinutes) {
        if ($totalMinutes > 360) {
            $totalMinutes = 360;
        }
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        return "{$hours} hours and {$minutes} minutes";
    }

    private function formatOverallTime($totalMinutes) {
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        return "{$hours} hours and {$minutes} minutes";
    }
    
}
