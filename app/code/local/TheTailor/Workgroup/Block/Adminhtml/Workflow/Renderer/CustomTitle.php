<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomTitle
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
	
		return '<span class="grid-row-title">' . $row->getData($this->getColumn()->getIndex()) . '</span>';
	}
}
