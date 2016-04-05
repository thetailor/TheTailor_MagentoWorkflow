<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {  
        parent::__construct();
     
        $this->setId('thetailor_workgroup_workflow_form');
        $this->setTitle($this->__('Workflow Information'));
    }  
     
    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {  
        $model = Mage::registry('thetailor_workgroup');
		
		$workflowSingleton = Mage::getSingleton('thetailor_workgroup/workflow');
		
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post',
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->__('Workflow Details'),
        ));
		
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name'	=> 'id',
            ));
        }
		
        $fieldset->addField('type', 'select', array(
            'name'		=> 'type',
            'label'		=> $this->__('Type'),
            'required'	=> true,
			'value'		=> 4,
            'values'	=> $workflowSingleton->getOptionsType(),
        ));
        
        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => $this->__('Title'),
            'title'     => $this->__('Title'),
            'required'  => true,
            'after_element_html' => '
			<p class="note">
            ' . $this->__('Organize prepending to the title a prefix (e.g. [Module] Your title)') . '
			</p>',
        ));
        
        $fieldset->addField('description', 'textarea', array(
            'name'      => 'description',
            'label'     => $this->__('Description'),
            'title'     => $this->__('Description'),
            'required'  => true,
        ));
        
        $fieldset->addField('snippet', 'editor', array(
            'name'      => 'snippet',
            'label'     => $this->__('Snippet'),
            'title'     => $this->__('Snippet'),
            'style'     => 'height:15em',
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'wysiwyg'   => true,
            'required'  => false,
        ));
        
        $fieldset->addField('url', 'text', array(
            'name'      => 'url',
            'label'     => $this->__('URL'),
            'title'     => $this->__('URL'),
            'required'  => false,
        ));

        $fieldset->addField('code', 'multiselect', array(
            'name'		=> 'code',
            'label'		=> $this->__('Code'),
            'required'	=> false,
            'value'		=> -1,
            'values'	=> $workflowSingleton->getOptionsCode(),
        ));

        $fieldset->addField('priority', 'select', array(
            'name'		=> 'priority',
            'label'		=> $this->__('Priority'),
            'required'	=> false,
			'value'		=> -1,
            'values'	=> $workflowSingleton->getOptionsPriority(),
            'after_element_html' => '
			<p class="note">
            ' . $this->__('Priority can be of following types:') . '
				<br/>' . $this->__('<b>Low:</b> The defect is an irritant which should be repaired, but repair can be deferred until after more serious defect have been fixed.') . '
				<br/>' . $this->__('<b>Medium:</b> The defect should be resolved in the normal course of development activities. It can wait until a new build or version is created.') . '
				<br/>' . $this->__('<b>High:</b> The defect must be resolved as soon as possible because the defect is affecting the application or the product severely. The system cannot be used until the  repair has been done.') . '
			</p>',
        ));
        
        $fieldset->addField('severity', 'select', array(
            'name'		=> 'severity',
            'label'		=> $this->__('Severity'),
            'required'	=> false,
			'value'		=> -1,
            'values'	=> $workflowSingleton->getOptionsSeverity(),
            'after_element_html' => '<br/>
            <p class="note">
			' . $this->__('Severity can be of following types:') . '
				<br/>' . $this->__('<b>Critical:</b> The defect that results in the termination of the complete system or one or more component of the system and causes extensive corruption of the data. The failed function is unusable and there is no acceptable alternative method to achieve the required results then the severity will be stated as critical.') . '
				<br/>' . $this->__('<b>Major:</b> The defect that results in the termination of the complete system or one or more component of the system and causes extensive corruption of the data. The failed function is unusable but there exists an acceptable alternative method to achieve the required results then the severity will be stated as major.') . '
				<br/>' . $this->__('<b>Moderate:</b> The defect that does not result in the termination, but causes the system to produce incorrect, incomplete or inconsistent results then the severity will be stated as moderate.') . '
				<br/>' . $this->__('<b>Minor:</b> The defect that does not result in the termination and does not damage the usability of the system and the desired results can be easily obtained by working around the defects then the severity is stated as minor.') . '
				<br/>' . $this->__('<b>Cosmetic:</b> The defect that is related to the enhancement of the system where the changes are related to the look and field of the application then the severity is stated as cosmetic.') . '
			</p>',
        ));
        
        /*
        $fieldset->addField('note', 'note', array(
            'text'      => $this->__('Note'),
        ));
        */
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
     
        return parent::_prepareForm();
    }  
}
