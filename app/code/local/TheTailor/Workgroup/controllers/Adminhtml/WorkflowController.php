<?php
class TheTailor_Workgroup_Adminhtml_WorkflowController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('system/thetailor_workgroup_workflow')
            ->_title($this->__('System'))->_title($this->__('Workflow'))
            ->_addBreadcrumb($this->__('System'), $this->__('System'))
            ->_addBreadcrumb($this->__('Workflow'), $this->__('Workflow'));
         
        return $this;
    }
    
    public function indexAction()
    {  
        // Let's call our initAction method which will set some basic params for each action
        $this->_initAction()
            ->renderLayout();
    }  
     
    public function newAction()
    {  
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }  
     
    public function editAction()
    {  
        $this->_initAction();
     
        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('thetailor_workgroup/workflow');
     
        if ($id) {
            // Load record
            $model->load($id);
     
            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This workflow no longer exists.'));
                $this->_redirect('*/*/');
     
                return;
            }  
        }  
     
        $this->_title($model->getId() ? $model->getName() : $this->__('New Workflow'));
     
        $data = Mage::getSingleton('adminhtml/session')->getWorkflowData(true);
        if (!empty($data)) {
            $model->setData($data);
        } 
     
        Mage::register('thetailor_workgroup', $model);
     
        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Workflow') : $this->__('New Workflow'), $id ? $this->__('Edit Workflow') : $this->__('New Workflow'))
            ->_addContent($this->getLayout()->createBlock('thetailor_workgroup/adminhtml_workflow_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }
    
    public function deleteAction()
    {
        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('thetailor_workgroup/workflow');
        
        if ($id) {
            // Load record
            $model->load($id);
     
            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This workflow no longer exists.'));
                $this->_redirect('*/*/');
     
                return;
            } else {
                try {                  
                    $model->setId($id)->delete();
                      
                    Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The workflow was successfully deleted.'));
                    $this->_redirect('*/*/');
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $id));
                }
            }
        }
    }	
    
    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('thetailor_workgroup/workflow');
            $model->setData($postData);
 
            try {
                $model->save();
 
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The workflow has been saved.'));
                $this->_redirect('*/*/');
 
                return;
            }  
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this workflow.'));
            }
 
            Mage::getSingleton('adminhtml/session')->setWorkflowData($postData);
            $this->_redirectReferer();
        }
    }
     
    public function messageAction()
    {
        $data = Mage::getModel('thetailor_workgroup/workflow')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }
    
    public function exportCsvAction()
    {
        $fileName   = 'workflow.csv';
        $content    = $this->getLayout()->createBlock('thetailor_workgroup/adminhtml_workflow_grid');
 
        $this->_prepareDownloadResponse($fileName, $content->getCsv());
    }
 
    public function exportXmlAction()
    {
        $fileName   = 'workflow.xml';
        $content    = $this->getLayout()->createBlock('thetailor_workgroup/adminhtml_workflow_grid');
        
        $this->_prepareDownloadResponse($fileName, $content->getXml());
    }
     
    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/thetailor_workgroup_workflow');
    }
}