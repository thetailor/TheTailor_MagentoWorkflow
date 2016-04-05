<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomCode
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

	/**
	  * Renders grid column
	  *
	  * @param   Varien_Object $row
	  * @return  string
	  */
	public function render(Varien_Object $row)
	{
		$columnKey = $this->getColumn()->getIndex();
		$columnValue = $row->getData($this->getColumn()->getIndex());
		
		$workflowSingleton = Mage::getSingleton('thetailor_workgroup/workflow');		
		
		switch ($columnKey) {
			case 'code':
				$optionsCode = $workflowSingleton->getOptionsCode();
				$optionsSelected = explode(',', $columnValue);
				
				if (is_array($optionsSelected)) {
					$keys = array_map(function($n) { return $n['value']; }, $optionsCode);
					$value = array_map(function($n) { return $n['label']; }, $optionsCode);
					$optionsCode = array_combine($keys, $value);
					$optionsSelected = array_flip($optionsSelected);
					
					$value = implode(', ', array_intersect_key($optionsCode, $optionsSelected));
				}
				break;
        }
		
		return $value;
    }
}