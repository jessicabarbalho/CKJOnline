<?php
class Server
{
	public static $Address = "localhost";
	
	//BD MySQL
	public static $ServerBD = "mysql.cin.ufpe.br";
	public static $InstanceBD = "g121if692_eq04";
	public static $UserNameBD = "g121if692_eq04";
	public static $PasswordBD = "KjCEb9ZT6ZXYU82D";
	public static $connection;
	
	public static function conect()
	{
		if($this->connection == null)
		{
			$this->connection = mysql_connect($this->ServerBD, $this->UserNameBD, $this->PasswordBD);
			mysql_select_db($this->InstanceBD, $connection);
		}
		return $this->$connection;
	}
}
?>