<?php
abstract class Model {
	protected $id;
	protected $table;
	protected $id_field;
	protected $name_field;
	protected $order_by;
	
	var $values = '';
	var $field = '';
	var $logic = '';
	
	public $set = array();
	public $rows = array();
	public $row = array();

	function __construct($values=''){
	
		if ($values){
			if (is_array($values)){
				$this->values = $values;
			}
			else {
				$args = func_get_args();
				foreach ($args as $arg){
					$vals[] = $arg;
				}
				$this->values = $vals;
			}
			$this->load();
		}
	}
	
	function load($values = ''){
		if ($values){
			if (is_array($values)){
				$this->values = $values;
			}
			else {
				$args = func_get_args();
				foreach ($args as $arg){
					$args[] = $arg;
				}
				$this->values = $args;			
			}
		}

		$database = database::db();
		$query = $this->build();
		$q = $database->query($query);
		while ($row = mysql_fetch_assoc($q)){
			$row_id = $row[$this->id_field];
			$this->rows[$row_id] = $row;
		}
		$this->row = $row;
		
	}
	
	function build(){
		if (!$this->logic && is_array($this->values)){
			$this->logic = 'OR';
			while (list($fieldName,$fieldValue) = each($this->values)){
				if (!is_numeric($fieldName)){
					$this->logic = 'AND';
				}
				$oldField = $fieldName;
			}
		}
		
		$defaultField = $this->field ? $this->field : $this->id_field;
		if (is_array($this->values)){
			$coun = count($this->values) - 1;
			foreach ($this->values as $key => $value){
				$field = $this->esc(!is_numeric($key)?$key:$defaultField);
				$qe .= $this->esc($field)."='".$this->esc($value)."'";
				if ($coun>0) {
					$qe .= ' '.$this->esc($this->logic).' ';
				}
				$coun = $coun - 1;
			}
			$q = "SELECT * FROM ".$this->esc($this->table)." WHERE ".$qe;
		}
		else {
			$value = $this->esc($this->values);
			$field = $this->esc($defaultField);
			$q = "SELECT * FROM ".$this->table." WHERE ".$defaultField." = ".$value;
		}
		
		$q .= ' ORDER BY '.$this->esc($this->order_by);
		//echo $q;
		return $q;
	}	
	
	
	function save(){
		if ($this->set[$this->id_field]) {
			$this->update();
		}
		else {
			$this->insert();
		}
	}
	function insert() {
		$database = database::db();
		$insert = 'INSERT INTO '.$this->esc($this->table).' SET '.$this->_fields();
		$database->query($insert);
		return $ret;
	}
	function update() {
		$database = database::db();
		$update .= 'UPDATE `'.$this->table.'` SET '.$this->_fields();
		$update .= sprintf(' WHERE '.$this->esc($this->id_field).'=%s', $this->esc($this->set[$this->id_field]));
		$database->query($update);
		return $ret;
	}
	function _fields(){
		while (list ($fieldName, $fieldValue) = each($this->set)) {
			if (!is_numeric($fieldName)){
				if (!strcmp($fieldName, $this->id_field)) {
					continue;
				}
				if ($fields) {
					$fields .= ', ';
				}
				$fields .= sprintf('`'.$this->esc($fieldName).'`=\'%s\'', $this->esc($fieldValue));
			}
		}
		return $fields;
	}
	
	function esc($val) {
		return mysql_real_escape_string($val);
	}
	
	function delete($value='') {
		$database = database::db();
		$value = $value?$value:$this->set[$this->id_field];
		$q = sprintf('DELETE FROM '.$this->esc($this->table). 
		'WHERE `'.$this->esc($this->id_field).'`=%s',$this->esc($value));
		$database->query($q);
	}
	
	function getFields() {
		$database = database::db();
		$res = $database->query('SHOW COLUMNS FROM '.$this->table);
		$fields = array ();
		while ($row = @ mysql_fetch_object($res)) {
			$fields[$row->Field] = $row->Type;
		}
		mysql_free_result($res);
		return $fields;
	}
	
	function getAll(){
		$this->values = array('id','>0');
		$this->load();
		return $this->rows;
	}
	
	function scaffoldInfo($id) {
		$this->load($id);
		return $this->rows;
	}	
	
	
}
?>