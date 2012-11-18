<?php

class PluginSetmebold_ActionSetmebold extends ActionPlugin {
	/**
	 * Текущий юзер
	 *
	 * @var ModuleUser_EntityUser
	 */
	protected $oUserCurrent=null;
	
    /**
     * Инициализация экшена
     */
    public function Init() {
    	/**
		 * Проверяем авторизован ли юзер
		 */
		if (!$this->User_IsAuthorization()) {
			$this->Message_AddErrorSingle($this->Lang_Get('not_access'));
			return Router::Action('error');
		}
		/**
		 * Получаем текущего юзера
		 */
		$this->oUserCurrent=$this->User_GetUserCurrent();
		/**
		 * Проверяем является ли юзер администратором
		 */
		if (!$this->oUserCurrent->isAdministrator()) {
			$this->Message_AddErrorSingle($this->Lang_Get('not_access'));
			return Router::Action('error');
		}
        $this->SetDefaultEvent('settings');
    }

    /**
     * Регистрируем евенты
     */
    protected function RegisterEvent() {
        $this->AddEvent('settings','EventSettings');
        $this->AddEvent('deleterow','EventDeleteRow');
        $this->AddEvent('add','EventAddRow');

    }

	protected function EventSettings() {
		$aSetmebold = $this->PluginSetmebold_Setmebold_getAllString(); 
		$this->Viewer_Assign('aSetmebold', $aSetmebold);
	}
	
	protected function EventDeleteRow(){
		/**
		 * Устанавливаем формат Ajax ответа
		 */
		$this->Viewer_SetResponseAjax('json');
		
		if(!$this->PluginSetmebold_Setmebold_deleteRow(getRequest('id'))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'));
			return;
		}
		
		$this->Viewer_AssignAjax('id',getRequest('id'));
	}
	
	protected function EventAddRow(){
		if (isPost('add_new_setmebold')) {
			$this->Security_ValidateSendForm();
			//Создаем объект Setmebold
			$oSetmebold = Engine::GetEntity('PluginSetmebold_Setmebold_Setmebold');
			//Наполняем сущность смыслом жизни
			$oSetmebold->setString(getRequest('string'));
			$oSetmebold->setVariant(getRequest('variant'));
			getRequest('bold')== 'on' ? $oSetmebold->setBold('1') : $oSetmebold->setBold('0');
			$oSetmebold->setReference(getRequest('reference'));
			getRequest('number') ? $oSetmebold->setNumber(getRequest('number')) : $oSetmebold->setNumber('0');
			
			if (getRequest('id')) {
				$oSetmebold->setId(getRequest('id'));
				$this->PluginSetmebold_Setmebold_editRow($oSetmebold);
					return Router::Action('setmebold', 'settings');
			}
			else {
				//Посылаем ее в базу данных
				$this->PluginSetmebold_Setmebold_addRow($oSetmebold);
					return Router::Action('setmebold', 'settings');
			}
		}
	}

    /**
     * Завершение работы экшена
     */
    public function EventShutdown() {

    }
}
?>
