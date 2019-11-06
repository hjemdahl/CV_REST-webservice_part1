<?php
// Projekt - Webbutveckling III - Moa Hjemdahl 2019

class Portfolio {
    private $db;
    private $title;
    private $url;
    private $img;
    private $info;

    // Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if ($this->db->connect_errno > 0) {
        die ("Fel vid anslutning till databas: " . $this->db->connect_error);
        }
    }

    // Get portfolio
    public function getPortfolio() {
        $sql = "SELECT id, title, url, img, info FROM portfolio";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Add row to portfolio
    public function addPortfolio($title, $url, $img, $info) {
        //If arguments are set
        if(!$this->setTitle($title)) {
            return false;
        }
        if(!$this->setUrl($url)) {
            return false;
        }
        if(!$this->setImg($img)) {
            return false;
        }
        if(!$this->setInfo($info)) {
            return false;
        }

        $sql = "INSERT INTO portfolio (title, url, img, info) VALUES ('$title', '$url', '$img', '$info')";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Delete row from portfolio
    public function deletePortfolio($id) {
        $id = intval($id);

		$sql = "DELETE FROM portfolio WHERE id=$id";
        $result = $this->db->query($sql);
        return $result;
    }

    // Update row in portfolio
    public function updatePortfolio($id, $title, $url, $img, $info) {
        //If arguments are set
        if(!$this->setTitle($title)) {
            return false;
        }
        if(!$this->setUrl($url)) {
            return false;
        }
        if(!$this->setImg($img)) {
            return false;
        }
        if(!$this->setInfo($info)) {
            return false;
        }

        $id = intval($id);

        $sql = "UPDATE portfolio SET title='" . $this->title . "', url='" . $this->url . "', img='" . $this->img . "', info='" . $this->info . "' WHERE id=$id";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Set title
    public function setTitle($title) {
		if($title != "") {
			$this->title = $this->db->real_escape_string(strip_tags($title));
			return true;
		} else {
			return false;
		}
    }
    
    // Set url
    public function setUrl($url) {
		if($url != "") {
			$this->url = $this->db->real_escape_string(strip_tags($url));
			return true;
		} else {
			return false;
        }
    }

    // Set img
    public function setImg($img) {
		if($img != "") {
			$this->img = $this->db->real_escape_string(strip_tags($img));
			return true;
		} else {
			return false;
		}
    }

    // Set info
    public function setInfo($info) {
		if($info != "") {
			$this->info = $this->db->real_escape_string(strip_tags($info));
			return true;
		} else {
			return false;
        }
    }
}