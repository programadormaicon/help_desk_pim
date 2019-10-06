<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=localhost;dbname=db_ultimate_pim;charset=utf8",
				"root",
				"" 
			);

			return $conn;
			echo "conectado";


		} catch (\PDOException $e) {
			echo "Erro ao conectar com o banco de dados".$e->getMessage();
		}
	}
}

?>