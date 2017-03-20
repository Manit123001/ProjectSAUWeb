<?php 

	$host = 'localhost';
	$user = 'root';
	$pwd = '';
	$db = 'db_comsci';

	$conn = mysql_connect($host, $user, $pwd) or die(mysql_errno());

	if($conn){
		$selectDB = mysql_select_db($db);
		
		if($selectDB){
			// mysql_query("SET NAMES UTF8");
			// echo "Connect Success";

		}else{
			// echo "Can't connect";
		}
	}


	class db {

		var $host;
		var $user;
		var $pass;
		var $db_name;
		var $charset;

		var $sql;

		// when new object then will define variable properties
		function __construct() {
			$this->host = 'localhost';
			$this->user = 'root';
			$this->pass = '';
			$this->db_name ='db_comsci';
			$this->charset = 'utf-8';
		}

		function connect() {
			$conn = mysql_connect($this->host, $this->user, $this->pass);

			if($conn){
				mysql_select_db($this->db_name);
				mysql_query('SET NAMES'.$this->charset);
			}
			return $conn;
		}


		//การดึงข้อมูลมาแสดง
		function findAll($tableName){
			$conn = $this->connect();

			if(!empty($conn)){
				$this->sql = 'SELECT * FROM '.$tableName;
				return $this;
			}
			return null;
		}

		function execute(){
			$conn = $this->connect();

			if(!empty($conn)){
				return mysql_query($this->sql);
			}
			return null;
		}


		//การสร้าง method เพื่อค้นด้วย PK
		function findByPk($table, $column, $value){
			$this->sql = "SELECT * FROM $table WHERE $column = $value";
			return $this;
		}

		function executeRow(){
			$conn = $this->connect();

			if(!empty($conn)){
				$rs = mysql_query($this->sql);

				if(!empty($rs)){
					$row = mysql_fetch_array($rs);
					return $row;
				}
			}
			return null;
		}

		//การสร้าง method เพื่อค้นด้วย attributes
		function findByAttributes($table, $attributes){
			$this->sql = "SELECT * FROM $table WHERE";
			$count = 0;

			foreach ($attributes as $k => $v){
				if($count == 0){
					$this->sql .= " $k '$v'";
				} else{
					$this->sql .= "AND $k '$v'";
				}
				$count++;
			}
			return $this;
		}

				//การสร้าง method เพื่อใช้ IN
		function in($table, $field, $value){
			$_value = "";
			$count = 0;

			foreach($value as $v){
				$_value .= "$v";
				if(count($value) != $count + 1){
					$_value .= ",";
				}

				$count++;
			}
			$this->sql = "SELECT * FROM $table WHERE $field IN ($_value)";
			return $this;
		}

		// การสร้าง method เพื่อใช้ BETWEEN
		function between($table, $field, $from, $to){
			$this->sql = "SELECT * FROM $table WHERE $field BETWEEN $from AND $to";
			return $this;
		}

		// การสร้าง method เพื่อใช้ compare
		function compare($table, $field, $value){
			$this->sql = "SELECT * FROM $table WHERE $field $value";
			return $this;
		}

		// การสร้าง method เพื่อใช้ Multiple Condition
		function conditions($table, $condition){
			$this->sql = "SELECT * FROM $table WHERE $condition";
			return $this;
		}

		// การสร้าง method เพื่อใช้ ORDER BY
		function order_by($table, $order){
			$this->sql = "SELECT * FROM $table ORDER BY $order";
			return $this;
		}

		// การสร้าง method INSERT
		function insert($table, $data){
			$field = "";
			$val = "";
			$i = 0;

			foreach ($data as $k => $v){
				$field .= $k;
				$val .= "'$v'";

				if($i < count($data) - 1){
					$field .=',';
					$val .=',';
				}
				$i++;
			}
			$this->sql = "INSERT INTO $table($field) VALUES ($val)";
			return mysql_query($this->sql);
		}

		// การสร้าง method DELETE
		function delete($table, $field, $value){
			$this->sql = "DELETE FROM $table WHERE $field = $value";
			return mysql_query($this->sql);
		}

		// การสร้าง method UPDATE
		function update($table, $data, $field, $value){
			$rows = "";
			$i = 0;

			foreach($data as $k => $v){
				// ถ้าไม่ใช้ารหัส PK
				if($k!=$field){
					// update ทีละแถว
					$rows .= "$k = '$v'";

					// ถ้าไม่ใช่ค่าสุดท้ายให้ต่ออกษร , เข้าไปอีก 
					// -2 เพราะตัด pk ออกด้วย
					if($i < count($data) - 2){
						$rows .= ',';
					}
					$i++;
				}
			}
			// ประมวลผลคำสั่ง SQL
			$this->sql = "UPDATE $table SET $rows WHERE $field = $value";
			return mysql_query($this->sql);
		}

	} //end class
 ?>