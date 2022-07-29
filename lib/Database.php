<?php 
	
	class Database{

		private $host 	= "localhost";
		private $user 	= "root";
		private $pass 	= "";
		private $db 	= "accountingsystem";

		public $link;

		public function __construct(){
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->db);
		}

		public function select($query){
			$result = $this->link->query($query) or die($this->link->error);
			if ($this->link->affected_rows > 0) {
				return $result;
			}else{
				return false;
			}
		}

		public function insert($query){
			$result = $this->link->query($query) or die($this->link->error);
			if ($this->link->affected_rows > 0) {
				return $this->link->insert_id;
			}else{
				return false;
			}
		}

		public function update($query){
			$result = $this->link->query($query) or die($this->link->error);
			if ($this->link->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

		public function delete($query){
			$result = $this->link->query($query) or die($this->link->error);
			if ($this->link->affected_rows > 0) {
				return true;
			}else{
				return false;
			}
		}

	}

?>