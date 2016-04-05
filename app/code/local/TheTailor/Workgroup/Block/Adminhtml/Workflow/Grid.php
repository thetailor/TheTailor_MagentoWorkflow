<?php
class TheTailor_Workgroup_Block_Adminhtml_Workflow_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        // Set some defaults for our grid
        $this->setId('thetailor_workgroup_workflow_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
     
    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'thetailor_workgroup/workflow_collection';
    }
     
    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }
     
    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        /*
        $this->addColumn('id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'id'
            )
        );
        */
        
        $workflowSingleton = Mage::getSingleton('thetailor_workgroup/workflow');
		
        $this->addColumn('type', array(
            'header' => $this->__('Type'),
            'index' => 'type',
            'type' => 'options',
            'options' => array_slice($workflowSingleton->getOptionsType(), 1, null, true),
			'width' => '80px',
        ));
        
        $this->addColumn('title', array(
            'header'=> $this->__('Title'),
            'index' => 'title',
			'renderer' => 'TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomTitle',
            'type' => 'text',
        ));
        
        $this->addColumn('description', array(
            'header'=> $this->__('Description'),
            'index' => 'description',
            'type' => 'text',
        ));
        
        $this->addColumn('code', array(
            'header' => $this->__('Code'),
            'index' => 'code',
			'renderer' => 'TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomCode',
			'filter' => false,
			'width' => '200px',
        ));
		
        $this->addColumn('priority', array(
            'header' => $this->__('Priority'),
            'index' => 'priority',
			'renderer' => 'TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomPriority',
            'type' => 'options',
            'options' => array_slice($workflowSingleton->getOptionsPriority(), 1, null, true),
			'width' => '100px',
        ));
        
        $this->addColumn('severity', array(
            'header' => $this->__('Severity'),
            'index' => 'severity',
			'renderer' => 'TheTailor_Workgroup_Block_Adminhtml_Workflow_Renderer_CustomSeverity',
            'type' => 'options',
            'options' => array_slice($workflowSingleton->getOptionsSeverity(), 1, null, true),
			'width' => '100px',
        ));
            
        $this->addColumn('created_at', array(
            'header'=> $this->__('Created at'),
            'index' => 'created_at',
            'type' => 'datetime',
			'width' => '160px',
        ));
        
        $this->addColumn('updated_at', array(
            'header'=> $this->__('Updated at'),
            'index' => 'updated_at',
            'type' => 'datetime',
			'width' => '160px',
        ));
        
        $this->addExportType('*/*/exportCsv', $this->__('CSV'));
        $this->addExportType('*/*/exportXml', $this->__('XML'));
        
        return parent::_prepareColumns();
    }
     
    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}