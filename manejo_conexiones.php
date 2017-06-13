<?php
class gestor {
	function __construct(){
		$this->conn = new mysqli("localhost:3306", "root", "toor", "bedelia");
		if ($this->conn->connect_errno) {
		    echo "Fallo al conectar a MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error;
		}	
	}
	function __destruct(){
		
		$thread_id = $this->conn->thread_id;
		$this->conn->kill($thread_id);
		$this->conn->close();
	}
		/**
	* select
	*
	* @param String $attr Atributo a seleccionar de la tabla
	* @param String $table Tabla de la que se selecciona
	* @param String $where condicion de la seleccion (opcional)
	*
	* @return Array<String> $response / Error
	*/
	function select($attr,$table,$where = ''){

		$where = ($where != '' ||  $where != null) ? "WHERE ".$where : '';
		$stmt = "SELECT ".$attr." FROM ".$table." ".$where.";";
		$result = $this->CONN->query($stmt) or die($this->CONN->error.__LINE__);
		if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $response[] = $row;
                    }
                    return $response;
		}

	}

	/**
	* insert
	*
	* @param String $table Tabla en la que se insertarán los datos
	* @param Array $values Arreglo de datos a insertar cuyo indice corresponde
	*					   al atributo en la base de datos.
	* @param String $where condicional (opcional) de la selección
	* @param Boolean $sanear Condicional que determina si debe ser saneada la cadena
	*
	* @return Integer $response id/false
	*/
	function insert($table,$values,$where = '',$sanear = false){
		
		$columnas = null;
		$valores = null;

		foreach ($values as $key => $value) {
			$columnas.=$key.',';
			$value = str_replace("\"","\\\"", $value );
			if( $sanear == true){
				$valores.='"'.ucwords(strtolower($value)).'",';
			}else{
				$valores.='"'.$value.'",';
			}
		}
		$columnas = substr($columnas, 0, -1);
		$valores = substr($valores, 0, -1);

		$stmt = "INSERT INTO ".$table." (".$columnas.") VALUES(".$valores.") ".$where.";";
		$result = $this->CONN->query($stmt) or die($this->CONN->error);
		$response = $this->CONN->insert_id;

		return $response;

	}

	/**
	* update
	*
	* @param String $table Tabla de la base de datos
	* @param Array<String> $values Valores ordenados en formato [attr] = value
	* @param String $where Sentencia where
	*
	* @return Boolean $response
	*/
	function update($table,$values,$where){

		foreach ($values as $key => $value) {
			$valores .= $key.'="'.$value.'",';
		}
		$valores = substr($valores,0,strlen($valores)-1);
		$stmt = "UPDATE $table SET $valores WHERE $where";

		$result = $this->CONN->query($stmt) or die($this->CONN->error.__LINE__);
		if($result->num_rows > 0) {
			$response = false;
		}
		else {
			$response = true;
		}

		return $response;
	}

	/**
	* delete
	*
	* @param String $table Tabla de la base de datos
	* @param Array<String>/String $values Valores ordenados en formato [attr] = value
	*								      o en otro caso sentencia
	* @param Boolean $complex Indica si se usará $values como string o como arreglo
	*
	* @return Boolean $response
	*/

	function delete($table,$values,$complex = false){

		if($complex){ $where = $values; }else{
			foreach ($values as $key => $value) {
				$where = $key.'="'.$value.'"';
			}
		}

		$stmt = 'DELETE FROM '.$table.' WHERE '.$where;
		$result = $this->CONN->query($stmt) or die($this->CONN->error.__LINE__);
		if($result->num_rows > 0) {
			$response = false;
		}
		else {
			$response = true;
		}

		return $response;

	}
	function 

}

?>