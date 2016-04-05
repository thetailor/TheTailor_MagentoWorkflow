<?php
class TheTailor_Workgroup_Model_Mysql4_Workflow
    extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {  
        $this->_init('thetailor_workgroup/workflow', 'id');
    }  
}