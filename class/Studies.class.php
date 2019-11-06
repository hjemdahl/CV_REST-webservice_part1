<?php
// Projekt - Webbutveckling III - Moa Hjemdahl 2019

class Studies {
    private $db;
    private $school;
    private $program;
    private $course;
    private $startDate;
    private $endDate;

    // Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if ($this->db->connect_errno > 0) {
        die ("Fel vid anslutning till databas: " . $this->db->connect_error);
        }
    }
    // Get studies
    public function getStudies() {
        $sql = "SELECT id, school, program, course, startDate, endDate FROM studies";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add row to studies
    public function addStudies($school, $program, $course, $startDate, $endDate) {
        //If arguments are set
        if(!$this->setSchool($school)) {
            return false;
        }
        if(!$this->setProgram($program)) {
            return false;
        }
        if(!$this->setCourse($course)) {
            return false;
        }
        if(!$this->setStartDate($startDate)) {
            return false;
        }
        if(!$this->setEndDate($endDate)) {
            return false;
        }

        $sql = "INSERT INTO studies (school, program, course, startDate, endDate) VALUES ('$school', '$program', '$course', '$startDate', '$endDate')";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Delete row from studies
    public function deleteStudies($id) {
        $id = intval($id);

		$sql = "DELETE FROM studies WHERE id=$id";
        $result = $this->db->query($sql);
        return $result;
    }

    // Update one row in studies
    public function updateStudies($id, $school, $program, $course, $startDate, $endDate) {
        //If arguments are set
        if(!$this->setSchool($school)) {
            return false;
        }
        if(!$this->setProgram($program)) {
            return false;
        }
        if(!$this->setCourse($course)) {
            return false;
        }
        if(!$this->setStartDate($startDate)) {
            return false;
        }
        if(!$this->setEndDate($endDate)) {
            return false;
        }

        $id = intval($id);

        $sql = "UPDATE studies SET school='" . $this->school . "', program='" . $this->program . "', course='" . $this->course. "', startDate='" . $this->startDate . "', endDate='" . $this->endDate . "' WHERE id=$id";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Set school
    public function setSchool($school) {
		if($school != "") {
			$this->school = $this->db->real_escape_string(strip_tags($school));
			return true;
		} else {
			return false;
		}
    }
    
    // Set program
    public function setProgram($program) {
		if($program != "") {
			$this->program = $this->db->real_escape_string(strip_tags($program));
			return true;
		} else {
			return false;
        }
    }

    // Set course
    public function setCourse($course) {
		if($course != "") {
			$this->course = $this->db->real_escape_string(strip_tags($course));
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