<?php
//conexion base de datos
class Database{
	public static function connect(){
		$db = new mysqli('localhost', 'root', 'mysql', 'tienda_master');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}
}

