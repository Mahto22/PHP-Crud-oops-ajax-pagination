<?php

class Database {
	private $dsn = "mysql:host=localhost;dbname=techspawn";
	private $user = "root";
	private $pass = "";
	public $conn;

	public function  __construct(){
		try{
			$this->conn = new PDO($this->dsn,$this->user,$this->pass);
			//echo "db connected";
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	// insert query
	public function insert($user_name,$address,$salary,$phone){
		 $sql = "INSERT INTO emp_tbl (user_name,address,salary,phone) VALUES (:user_name,:address,:salary,:phone)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['user_name'=>$user_name,'address'=>$address,'salary'=>$salary,'phone'=>$phone]);
		return true;
	}

	// display query
	public function read(){
		$data = array();
    $sql = "SELECT * FROM emp_tbl WHERE salary  BETWEEN 1000 AND 50000 ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
    	$data[] = $row;
    }
    return $data;
	}

	// display query by user id
   public function getUserById($id){
   	$sql = "SELECT * FROM emp_tbl WHERE id= :id";
   	$stmt = $this->conn->prepare($sql);
   	$stmt->execute(['id'=>$id]);
   	$result = $stmt->fetch(PDO::FETCH_ASSOC);
   	return $result;
   }

   // update query
   public function update($id,$user_name,$address,$salary,$phone){
      $sql = "UPDATE emp_tbl SET  user_name = :user_name,address = :address,salary = :salary,phone = :phone WHERE id = :id ";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(['user_name'=>$user_name,'address'=>$address,'salary'=>$salary,'phone'=>$phone,'id'=>$id]);
          return true;
   }

   // delete query
   public function delete($id){
   	$sql = "DELETE FROM emp_tbl WHERE id = :id";
   	$stmt = $this->conn->prepare($sql);
   	$stmt->execute(['id'=>$id]);
   	return true;
   }

//total row count query
   public function totalRowCount(){
   	$sql = "SELECT * FROM emp_tbl ";
   	$stmt = $this->conn->prepare($sql);
   	$stmt->execute();
   	$t_rows = $stmt->rowCount();

   	return $t_rows ;
   }
}

//$ob = new Database();
//print_r($ob->read());
//echo $ob->totalRowCount();

?>