<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomPriority
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
		$columnValue = $row->getData($this->getColumn()->getIndex());
		
		switch ($columnValue) {
             case TheTailor_Workgroup_Model_Workflow::PRIORITY_LOW:
                 $class = 'notice';
                 $value = '<span>low</span>';
                 break;
             case TheTailor_Workgroup_Model_Workflow::PRIORITY_MEDIUM:
                 $class = 'major';
                 $value = '<span>medium</span>';
                 break;
             case TheTailor_Workgroup_Model_Workflow::PRIORITY_HIGH:
                 $class = 'critical';
                 $value = '<span>high</span>';
                 break;
         }
		 
         return '<span class="grid-severity-' . $class . '">' . $value . '</span>';
    }
}