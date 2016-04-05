<?php
class TheTailor_Workgroup_Model_Workflow
    extends Mage_Core_Model_Abstract
{
    const SELECT            = -1;
    
    const TYPE_TASK         = 1;
    const TYPE_MEMO         = 2;

    const CODE_XML          = 1;
    const CODE_PHTML        = 2;
    const CODE_CSS          = 3;
    const CODE_JS           = 4;
    const CODE_CSV          = 5;
    
    const PRIORITY_LOW      = 1;
    const PRIORITY_MEDIUM   = 2;
    const PRIORITY_HIGH     = 3;
    
    const SEVERITY_CRITICAL = 1;
    const SEVERITY_MAJOR    = 2;
    const SEVERITY_MODERATE = 3;
    const SEVERITY_MINOR    = 4;
    const SEVERITY_COSMETIC = 5;
    
    protected function _construct()
    {
        /**
         * This tells Magento where the related resource model can be found.
         *
         * For a resource model, Magento will use the standard model alias -
         * in this case 'thetailor_workgroup' - and look in
         * config.xml for a child node <resourceModel/>. This will be the
         * location that Magento will look for a model when
         * Mage::getResourceModel() is called - in our case,
         * TheTailor_Workgroup_Model_Mysql4.
         */
        $this->_init('thetailor_workgroup/workflow');
    }

    /**
     * This method is used in the grid and form for populating the dropdown.
     */
    public function getOptionsType($type = null)
    {
        $optionsType = array(
            self::SELECT         => Mage::helper('thetailor_workgroup')->__('-- Please select --'),
            self::TYPE_TASK      => Mage::helper('thetailor_workgroup')->__('Task'),
            self::TYPE_MEMO      => Mage::helper('thetailor_workgroup')->__('Memo'),
        );

        if (!is_null($type)) {
            if (isset($optionsType[$type])) {
                return $optionsType[$type];
            }
            return null;
        }

        return $optionsType;
    }
    
    public function getOptionsCode($code = null)
    {
        $optionsCode = array(
            array('value' => self::CODE_XML, 'label' => Mage::helper('thetailor_workgroup')->__('XML')),
            array('value' => self::CODE_PHTML, 'label' => Mage::helper('thetailor_workgroup')->__('PHTML')),
            array('value' => self::CODE_CSS, 'label' => Mage::helper('thetailor_workgroup')->__('CSS')),
            array('value' => self::CODE_JS, 'label' => Mage::helper('thetailor_workgroup')->__('JS')),
            array('value' => self::CODE_CSV, 'label' => Mage::helper('thetailor_workgroup')->__('CSV')),
        );

        return $optionsCode;
    }
    
    public function getOptionsPriority($priority = null)
    {
        $optionsPriority = array(
            self::SELECT            => Mage::helper('thetailor_workgroup')->__('-- Please select --'),
            self::PRIORITY_LOW      => Mage::helper('thetailor_workgroup')->__('Low'),
            self::PRIORITY_MEDIUM   => Mage::helper('thetailor_workgroup')->__('Medium'),
            self::PRIORITY_HIGH     => Mage::helper('thetailor_workgroup')->__('High'),
        );

        if (!is_null($priority)) {
            if (isset($optionsPriority[$priority])) {
                return $optionsPriority[$priority];
            }
            return null;
        }

        return $optionsPriority;
    }
    
    public function getOptionsSeverity($severity = null)
    {
        $optionsSeverity = array(
            self::SELECT            => Mage::helper('thetailor_workgroup')->__('-- Please select --'),
            self::SEVERITY_CRITICAL => Mage::helper('thetailor_workgroup')->__('Critical'),
            self::SEVERITY_MAJOR    => Mage::helper('thetailor_workgroup')->__('Major'),
            self::SEVERITY_MODERATE => Mage::helper('thetailor_workgroup')->__('Moderate'),
            self::SEVERITY_MINOR    => Mage::helper('thetailor_workgroup')->__('Minor'),
            self::SEVERITY_COSMETIC => Mage::helper('thetailor_workgroup')->__('Cosmetic'),
        );

        if (!is_null($severity)) {
            if (isset($optionsSeverity[$severity])) {
                return $optionsSeverity[$severity];
            }
            return null;
        }

        return $optionsSeverity;
    }
    
    protected function _beforeSave()
    {
        parent::_beforeSave();

        /**
         * Perform some actions just before a workflow is saved.
         */
        $this->_implodeListCoding();
        $this->_updateTimestamps();
        $this->_prepareUrlKey();
        
        return $this;
    }

    protected function _implodeListCoding()
    {
        /**
         * Convert multiselect to comma separated value
         */
        $code = $this->getCode() ? implode(',', $this->getCode()) : '';
                
        $this->setCode($code);

        return $this;
    }
    
    protected function _updateTimestamps()
    {
        $timestamp = now();

        /**
         * Set the last updated timestamp.
         */
        $this->setUpdatedAt($timestamp);

        /**
         * If we have a workflow new object, set the created timestamp.
         */
        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }

    protected function _prepareUrlKey()
    {
        /**
         * In this method, you might consider ensuring
         * that the URL Key entered is unique and
         * contains only alphanumeric characters.
         */

        return $this;
    }
}