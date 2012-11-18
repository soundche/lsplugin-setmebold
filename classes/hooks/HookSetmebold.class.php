<?php

class PluginSetmebold_HookSetmebold extends Hook {

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook() {



        /*
         * Хук в начало функции AddTopic() в модуле Topic (файл /classes/modules/topic/Topic.class.php , если этот модуль не переопределен в других плагинах):
         *
         * $this->AddHook('module_topic_addtopic_before','func_topic_addtopic_before');
         *
         * Будет вызвана функция func_topic_addtopic_before($aVars) , где $aVars - НЕассоциативный массив аргументов, переданных этой функции.
         * Передача результата в функцию AddTopic() делается путем изменения аргументов по ссылке - например, &$aVars[0]
         */
		
    	$this->AddHook('module_topic_addtopic_before','func_topic_addtopic_before');
    	$this->AddHook('module_topic_updatetopic_before','func_topic_addtopic_before');

        /*
         * Хук в конец функции AddTopic() в модуле Topic (файл /classes/modules/topic/Topic.class.php , если этот модуль не переопределен в других плагинах):
         *
         * $this->AddHook('module_topic_addtopic_after','func_topic_addtopic_after');
         *
         * Будет вызвана функция func_topic_addtopic_after($Var) , где $Var - это то, что возвращает AddTopic() (т.е. или false или объект топика $oTopic)
         * Функция должна завершаться при помощи return $Var
         */


        /*
         * Хук в конкреное место движка
         *
         * $this->AddHook('init_action','func_init_action', __CLASS__, -5);
         *
         * Приоритет для вызова хука = -5. Этот приоритет так же можно указывать и в хуках на модели.
         * Будет вызвана функция func_init_action($Var) в том месте движка, где стоит данный хук
         */


        /*
         * Хук с делегированием
         *
         * $this->AddDelegateHook('module_topic_addtopic_before','func_topic_addtopic_new',__CLASS__);
         *
         * Полная подмена функции AddTopic() модуля Topic на свою.
         * Будет вызвана функция func_topic_addtopic_new($Var), где $aVars - НЕассоциативный массив аргументов.
         * Делегирование существует в движке только для обеспечения совместимости со старыми плагинами, рекомендуется вместо него использовать переопределение.
         */
    }
    
	public function func_topic_addtopic_before(&$aVars) {
		
		//Получаем масссив объектов для перебора
		$aSetmebold = $this->PluginSetmebold_Setmebold_getAllString();
		
		//Получаем объект топика, это первый параметр метода
		$oTopic = $aVars['0'];
		
		//Добываем текстовки для их обработки
		$text = $oTopic->getText();
		$textShort = $oTopic->getTextShort();
		$sponsors = $oTopic->getSponsors();
		$textversion = $oTopic->getTextversion();
		
		//обрабатываем каждую отдельную строку
		foreach ($aSetmebold as $oSetmebold) {
			
			//Если строка должна быть жирной
			if ($oSetmebold->getBold()=='1') {
				$text = $this->PluginSetmebold_Setmebold_setAsBold($oSetmebold, $text);
				$textShort = $this->PluginSetmebold_Setmebold_setAsBold($oSetmebold, $textShort);
				$sponsors = $this->PluginSetmebold_Setmebold_setAsBold($oSetmebold, $sponsors);
				$textversion = $this->PluginSetmebold_Setmebold_setAsBold($oSetmebold, $textversion);
			}
			
			//Если строка должна быть ссылкой
			if ($oSetmebold->getReference() != '') {
				$text = $this->PluginSetmebold_Setmebold_setAsReference($oSetmebold, $text);
				$textShort = $this->PluginSetmebold_Setmebold_setAsReference($oSetmebold, $textShort);
				$sponsors = $this->PluginSetmebold_Setmebold_setAsReference($oSetmebold, $sponsors);
				$textversion = $this->PluginSetmebold_Setmebold_setAsReference($oSetmebold, $textversion);
			}
		}
		//Отправляем обработанные данные обратно
    	$aVars['0']->setText($text); 
    	$aVars['0']->setTextShort($textShort);
    	$aVars['0']->setSponsors($sponsors);
    	$aVars['0']->setTextversion($textversion);
    }
}
?>
