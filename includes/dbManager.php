<?php
//Include database connection details
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php');

class dbManager {
	private $link;
	private $db;
	private static $instance = NULL;
	/**
	 * Constructor of dbManager class.
	 * Private to ensure proper singleton architecture.
	 * Handles creation of db connection.
	 */
	private function __construct(){
		$this->link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		if (!$this->link) {
			die("Cannot access db.");
		}
		$this->db = mysql_select_db(DB_DATABASE, $this->link);
		if(!$this->db) {
			die("Unable to select database");
		}
	}
	
	/**
	 * returns instance of class dbManager, uses singleton architecture
	 * 
	 * @return dbManager
	 */
	public static function  getInstance(){
		if(dbManager::$instance === NULL){
			$instance = new dbManager();
		}
		return $instance;
	}
	
	/**
	 * Performs select query on the database.
	 * Returns false if $query is not select query or if the query returns no rows.
	 * Returns array of associative arrays if query is successful.
	 * @param String $query
	 * @return false:
	 * @return array;
	 */
	public function selectQuery($query){
		if (stripos($query,'select') === false) {
			return false;
		}
		$res = mysql_query($query, $this->link);
		
		if($res === false)
			return false;
		
		$result = array();
		while (($row = mysql_fetch_object($res)) !== false) {
			$result[] = $row;
		}
		
		return $result;
	}
		
	/**
	 * Performs insert, delete or update queries on the database.
	 * Returns false if $query is not insert, delete or update query or if the query failed.
	 * Returns true if query is successful.
	 * Returns the auto generated ID on successful insert query.
	 * @param String $query
	 * @return boolean
	 * @return int
	 */
	public function query($query){
		$query_ok = false;
		$insert = false;
		if (stripos($query,'insert') !== false) {
			$query_ok = true;
			$insert = true;
		}
		if (stripos($query,'delete') !== false) {
			$query_ok = true;
		}
		if (stripos($query,'update') !== false) {
			$query_ok = true;
		}
		
		if($query_ok === false)
			return false;
		
		if($insert){
			if(mysql_query($query, $this->link) !== false)
				return mysql_insert_id($this->link);
			return false;			
		}
		
		return mysql_query($query, $this->link);
	}
}

?>