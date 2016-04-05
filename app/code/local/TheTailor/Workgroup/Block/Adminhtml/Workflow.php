<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. thetailor_workgroup/adminhtml_workflow
        $this->_controller = 'adminhtml_workflow';
        $this->_blockGroup = 'thetailor_workgroup';
        $this->_headerText = $this->__('Workflow');
         
        parent::__construct();
    }
}