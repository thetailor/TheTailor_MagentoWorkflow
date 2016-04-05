<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {  
        $this->_blockGroup = 'thetailor_workgroup';
        $this->_controller = 'adminhtml_workflow';
     
        parent::__construct();
     
        $this->_updateButton('save', 'label', $this->__('Save Workflow'));
        $this->_updateButton('delete', 'label', $this->__('Delete Workflow'));
    }  
    
    /**
     * Including TincyMCE in Head
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
    
    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {  
        if (Mage::registry('thetailor_workgroup')->getId()) {
            return $this->__('Edit Workflow');
        }  
        else {
            return $this->__('New Workflow');
        }  
    }  
}