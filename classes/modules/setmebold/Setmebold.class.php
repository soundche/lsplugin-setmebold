<?php

class PluginSetmebold_ModuleSetmebold extends Module {
	
	/** * Объект маппера * * @var Mapper */
	protected $oMapper=null;
	
	public function Init() {
		/** * Получаем маппер по его имени */
		$this->oMapper=Engine::GetMapper('PluginSetmebold_ModuleSetmebold','Setmebold');
	}
	
	public function getAllString(){
		return $this->oMapper->GetAllRows();
	}
	
	public function deleteRow($id) {
		return $this->oMapper->deleteRow($id);
	}
	
	public function addRow($oSetmebold){
		return $this->oMapper->AddRow($oSetmebold);
	}
	
	public function editRow($oSetmebold){
		return $this->oMapper->EditRow($oSetmebold);
	}
	
	/**
	 * 
	 * Выделяет жирным строку в тексте $text только в том случае, если строка до этого не была жирной.
	 * @param string $oSetmebold
	 * @param string $text - текст в котором производится поиск строки и ее последующее выделение.
	 */
	public function setAsBold($oSetmebold, $text) {
		
		//Получаем массив из строки и ее вариантов, если таковые имеются
		$aString = $this->getArrFromObj($oSetmebold);
		
		foreach ($aString as $string){
			//Очищаем от пробелов
			$string = trim($string);
			//Разбиваем текстовку на массив для обработки
			$arrText = explode($string, $text);
			//И начнем все с чистого листа
			$text = '';
			if ($oSetmebold->getId() == 7){
				//var_dump($aString);
				//var_dump($text); echo "<br />";
			}
			for ($i = 0; isset($arrText[$i]); $i++) {
				if(isset($arrText[$i+1])){
					if (substr_count(end(explode('<strong>', $arrText[$i])),'</strong>') == 1 || substr_count($arrText[$i],'<strong>') ==0)
						$text .= $arrText[$i].'<strong>'.$string.'</strong>';
					else
						$text .= $arrText[$i].$string;
				}
				//Последнюю строку массива просто добавляем без искомой строки
				else 
					$text .= $arrText[$i];
			}
		}
		return $text;
	}
	
	/**
	 * 
	 * Находит строку $oSetmebold->getString в тексте $text, и делает ее ссылкой но только в том случае если $string не была ссылкой
	 * @param string $oSetmebold
	 * @param string $text
	 */
	public function setAsReference($oSetmebold, $text){
		
		//Получаем массив из строки и ее вариантов, если таковые имеются
		$aString = $this->getArrFromObj($oSetmebold);

		foreach ($aString as $string){
			//Очищаем от пробелов
			$string = trim($string);
			//Разбиваем текстовку на массив для обработки
			$arrText = explode($string, $text);
			//И начнем все с чистого листа
			$text = '';
			
			for ($i = 0; isset($arrText[$i]); $i++) {
				if(isset($arrText[$i+1])){
					if (substr_count(end(explode('<a', $arrText[$i])),'</a>') == 1 || substr_count($arrText[$i],'<a') ==0)
						$text .= $arrText[$i].'<a href="'.$oSetmebold->getReference().'">'.$string.'</a>';
					else
						$text .= $arrText[$i].$string;
				}
				//Последнюю строку массива просто добавляем без искомой строки
				else 
					$text .= $arrText[$i];
			}
		}
		return $text;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param object $oSetmebold
	 * return array
	 */
	private function getArrFromObj($oSetmebold){
		//Приводим список производных слов к массиву
		$aVariant = explode(',', $oSetmebold->getVariant());
		$aVariant['0'] != '' ? $aVariant[] = $oSetmebold->getString() : $aVariant = array('0' => $oSetmebold->getString());
		
		//Убираем повторения
		$aVariant = array_unique($aVariant);
		return $aVariant;
	}

}
?>
