<?php
// Projekt - Webbutveckling III - Moa Hjemdahl 2019

class Work {
    private $db;
    private $role;
    private $employee;
    private $startDate;
    private $endDate;

    // Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if ($this->db->connect_errno > 0) {
        die ("Fel vid anslutning till databas: " . $this->db->connect_error);
        }
    }

    // Get work
    public function getWork() {
        $sql = "SELECT id, role, employee, startDate, endDate FROM work";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add work
    public function addWork($role, $employee, $startDate, $endDate) {
        //If arguments are set
        if(!$this->setRole($role)) {
            return false;
        }
        if(!$this->setEmployee($employee)) {
            return false;
        }
        if(!$this->setStartDate($startDate)) {
            return false;
        }
        if(!$this->setEndDate($endDate)) {
            return false;
        }

        $sql = "INSERT INTO work (role, employee, startDate, endDate) VALUES ('$role', '$employee', '$startDate', '$endDate')";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Delete work
    public function deleteWork($id) {
        $id = intval($id);

		$sql = "DELETE FROM work WHERE id=$id";
        $result = $this->db->query($sql);
        return $result;
    }

    // Update work
    public function updateWork($id, $role, $employee, $startDate, $endDate) {
        //If arguments are set
        if(!$this->setRole($role)) {
            return false;
        }
        if(!$this->setEmployee($employee)) {
            return false;
        }
        if(!$this->setStartDate($startDate)) {
            return false;
        }
        if(!$this->setEndDate($endDate)) {
            return false;
        }

        $id = intval($id);

        $sql = "UPDATE work SET role='" . $this->role . "', employee='" . $this->employee . "', startDate='" . $this->startDate . "', endDate='" . $this->endDate . "' WHERE id=$id";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Set role
    public function setRole($role) {
		if($role != "") {
			$this->role = $this->db->real_escape_string(strip_tags($role));
			return true;
		} else {
			return false;
		}
    }
    
    // Set employee
    public function setEmployee($employee) {
		if($employee != "") {
			$this->employee = $this->db->real_escape_string(strip_tags($employee));
			return true;
		} else {
			return false;
        }
    }

    // Set start date
    public function setStartDate($startDate) {
		if($startDate != "") {
			$this->startDate = $this->db->real_escape_string(strip_tags($startDate));
			return true;
		} else {
			return false;
		}
    }

    // Set end date
    public function setEndDate($endDate) {
		if($endDate != "") {
			$this->endDate = $this->db->real_escape_string(strip_tags($endDate));
			return true;
		} else {
			return false;
        }
    }
}