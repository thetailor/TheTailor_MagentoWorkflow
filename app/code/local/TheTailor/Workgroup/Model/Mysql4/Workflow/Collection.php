<?php
class TheTailor_Workgroup_Model_Mysql4_Workflow_Collection
    extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {  
        $this->_init('thetailor_workgroup/workflow');
    }  
}