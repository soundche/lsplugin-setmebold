<?php

class PluginSetmebold_ModuleSetmebold_EntitySetmebold extends Entity
{
	public function getCountVariant() {
		if ($this->getVariant() != '')
			return count(explode(',', $this->getVariant()));
	}
}

?>
