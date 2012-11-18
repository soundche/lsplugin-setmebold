<?php

class PluginSetmebold_ModuleSetmebold_MapperSetmebold extends Mapper
{
	public function GetAllRows() {
		$sql = "SELECT * FROM  `".Config::Get('db.table.prefix')."setmebold`";
		$result=$this->oDb->select($sql);
		foreach ($result as $stirng) {
			$aString[] = Engine::GetEntity('PluginSetmebold_Setmebold_Setmebold',$stirng);
		}
		
		return @$aString;
	}
	
	public function AddRow($oSetmebold) {
		$sql = "INSERT INTO ".Config::Get('db.table.prefix')."setmebold 
			(
			string,
			variant,
			bold,
			reference,			
			number
			)
			VALUES(?,  ?,	?,	?, ?)
		";
		if ($this->oDb->query($sql,$oSetmebold->getString(),$oSetmebold->getVariant(),$oSetmebold->getBold(),$oSetmebold->getReference(),$oSetmebold->getNumber()))
		{
			return true;
		}
		return false;
	}
	
	public function EditRow($oSetmebold) {
		$sql = "UPDATE ".Config::Get('db.table.prefix')."setmebold SET
			
			`string` =  ?,
			`variant` =  ?,
			`bold` = ?,
			`reference` = ?,			
			`number` = ? 
			WHERE `id` = ?;
			
			
		";
		if ($this->oDb->query($sql,$oSetmebold->getString(),$oSetmebold->getVariant(),$oSetmebold->getBold(),$oSetmebold->getReference(),$oSetmebold->getNumber(), $oSetmebold->getId()))
		{
			return true;
		}
		return false;
	}
	
	public function deleteRow($id){
		$sql = "DELETE FROM `".Config::Get('db.table.prefix')."setmebold` WHERE `id` = ".$id;
		return $result=$this->oDb->query($sql);
	}
}

?>
