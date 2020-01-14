<?php

class Connection1{

	private $link;


	public function __construct(){ 

		
		$conn_array = array (
    	"UID" => "cats",
    	"PWD" => "dogs",
    	"Database" => "eFactory",
		);

		$this->link = sqlsrv_connect('103.219.69.30', $conn_array);
	
	}

	public function open(){

		//mssql_select_db("MES");
		if(!$this->link) {
			echo'Could not connect';
			die('Could not connect: ' . sqlsrv_error());
		}

		
	}
	
	public function query($sql){
		return sqlsrv_query($this->link,$sql);

	}

	public function fetch_array($query){

		return sqlsrv_fetch_array($query);
	}
	
	public function close(){
		
		$success = true;
		
		try{

		sqlsrv_close($this->link);

		}catch(Exception $e){
			$success = false;
		}

		if(!$success){
		echo'Connection not closed!';
		}

	}

	public function has_rows($dataset){
		if (sqlsrv_has_rows($dataset) > 0){
			return true;
		}
		else{
			return false;

	} 
		}
	

}





?>
