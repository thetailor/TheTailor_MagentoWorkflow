<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomSeverity
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
             case TheTailor_Workgroup_Model_Workflow::SEVERITY_CRITICAL:
                 $class = 'critical';
                 $value = '<span>critical</span>';
                 break;
             case TheTailor_Workgroup_Model_Workflow::SEVERITY_MAJOR:
                 $class = 'major';
                 $value = '<span>major</span>';
                 break;
             case TheTailor_Workgroup_Model_Workflow::SEVERITY_MINOR:
                 $class = 'minor';
                 $value = '<span>minor</span>';
                 break;
             case TheTailor_Workgroup_Model_Workflow::SEVERITY_NOTICE:
                 $class = 'notice';
                 $value = '<span>notice</span>';
                 break;
             case TheTailor_Workgroup_Model_Workflow::SEVERITY_COSMETIC:
                 $class = 'notice';
                 $value = '<span>cosmetic</span>';
                 break;
         }
		 
         return '<span class="grid-severity-' . $class . '">' . $value . '</span>';
    }
}