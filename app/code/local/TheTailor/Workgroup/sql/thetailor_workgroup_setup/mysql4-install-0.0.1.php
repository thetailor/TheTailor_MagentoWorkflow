<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
 
/**
 * Create table 'thetailor_workgroup_workflow'
 */
$table = $installer->getConnection()
    // The following call to getTable('thetailor_workgroup/workflow') will lookup the resource for thetailor_workgroup (thetailor_workgroup_mysql4), and look
    // for a corresponding entity called workflow. The table name in the XML is thetailor_workgroup_workflow, so ths is what is created.
    ->newTable($installer->getTable('thetailor_workgroup/workflow'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'ID')
    ->addColumn('type', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
        'nullable'  => false,
        ), 'Type')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Title')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Description')
    ->addColumn('snippet', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Snippet')
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'URL')
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Code')
    ->addColumn('priority', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
        'nullable'  => false,
        ), 'Priority')
    ->addColumn('severity', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
        'nullable'  => false,
        ), 'Severity')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
        ), 'Created at')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null,	array(
        'nullable' => false,
        ), 'Updated at');

$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');

$installer->getConnection()->createTable($table);
 
$installer->endSetup();