<?php

namespace yassersoliman\phpmvc\db;
use yassersoliman\phpmvc\Model;
use yassersoliman\phpmvc\Application;

abstract class DbModel extends Model
{
	abstract public function tableName(): string;

	abstract public function attributes(): array;

	abstract public function primaryKey(): string;

	abstract public function getDisplayName(): string;

	public function save()
	{
		$tableName = $this->tableName();
		$attributes = $this->attributes();
		$params = array_map(fn($attr) => ":$attr", $attributes);

		$statement = self::prepare("INSERT INTO $tableName ("
			. implode(',', $attributes) .") VALUES ("
			. implode(',', $params) .");"); 
		foreach ($attributes as $attribute) {
			$statement->bindValue(":$attribute", $this->{$attribute});
		}

		$statement->execute();
		return true;
	}

	public function findOne($where)
	{
		$className = static::class;
		$tableName = (new $className())->tableName();
		$attributes = array_keys($where);
		// email = :email AND firstName = :firstName;
		$sql = "SELECT * FROM $tableName WHERE " . implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
		$statement = self::prepare($sql);
		foreach ($where as $key => $item) 
		{
			$statement->bindValue(":$key", $item);
		}

		$statement->execute();
		return $statement->fetchObject($className);
	}

	public static function prepare($sql)
	{
		return Application::$app->db->pdo->prepare($sql);
	}
	
}

?>
