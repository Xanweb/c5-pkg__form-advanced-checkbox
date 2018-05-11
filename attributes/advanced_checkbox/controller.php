<?php
namespace Concrete\Package\FormAdvancedCheckbox\Attribute\AdvancedCheckbox;

use Concrete\Core\Attribute\DefaultController;
use Concrete\Core\Attribute\FontAwesomeIconFormatter;
use Database;
use Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Key\Settings\AdvancedCheckboxSettings;
use Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Value\Value\AdvancedCheckboxValue;
class Controller extends DefaultController
{

    protected $akContent;
    protected $akShowTitle;
    public $helpers = array('form');
    public function createDefaultAttributeValue()
    {
        $this->load();

        return $this->createAttributeValue($this->akShowTitle ? true : false);
    }
    public function saveKey($data)
    {
        /**
         * @var $type AdvancedCheckboxSettings
         */
        $type = $this->getAttributeKeySettings();

        $akContent = $data['akContent'];
        $akShowTitle = false;
        if (isset($data['akShowTitle']) && $data['akShowTitle']) {
            $akShowTitle = true;
        }
        $type->setContent($akContent);
        $type->setShowTitle($akShowTitle);

        return $type;
    }
    public function getAttributeValueClass()
    {
        return AdvancedCheckboxValue::class;
    }

    public function getAttributeKeySettingsClass()
    {
        return AdvancedCheckboxSettings::class;
    }
    public function getDisplayValue()
    {
        return h($this->getAttributeValue()->getValue());
    }

    public function createAttributeValue($value)
    {
        $av = new AdvancedCheckboxValue();
        $av->setValue($value);

        return $av;
    }

    public function createAttributeValueFromRequest()
    {
        $data = $this->post();

        return $this->createAttributeValue(isset($data['value']) ? $data['value'] : false);
    }

    // if this gets run we assume we need it to be validated/checked
    public function validateForm($data)
    {
        return isset($data['value']) && $data['value'] == 1;
    }

    public function form()
    {
        $this->load();
        $value = null;
        if (is_object($this->attributeValue)) {
            $value = $this->app->make('helper/text')->entities($this->getAttributeValue()->getValue());
        }
        $this->set('value', $value);

        $this->load();
    }


    public function type_form()
    {
        $this->load();
        $this->set('editor',$this->app->make('editor'));
    }

    protected function load()
    {
        $ak = $this->getAttributeKey();
        if (!is_object($ak)) {
            return false;
        }
        /**
         * @var $settings AdvancedCheckboxSettings
         */
        $settings = $ak->getAttributeKeySettings();

        $this->akContent = $settings->getContent();
        $this->akShowTitle = $settings->getShowTitle();

        $this->set('akContent', $this->akContent);
        $this->set('akShowTitle', $this->akShowTitle);
    }

    public function exportKey($akey)
    {
        $this->load();
        $akey->addChild('type')->addAttribute('akContent', $this->akContent);
        $akey->addChild('type')->addAttribute('akShowTitle', $this->akShowTitle ? true : false);

        return $akey;
    }

    public function importKey(\SimpleXMLElement $akey)
    {
        /**
         * @var $type AdvancedCheckboxSettings
         */
        $type = $this->getAttributeKeySettings();
        if (isset($akey->type)) {
            $data['akContent'] = $akey->type['akContent'];
            $type->setContent((string) $akey->type['akContent']);

            $data['akShowTitle'] = $akey->type['akShowTitle'];
            $type->setShowTitle(isset($akey->type['akShowTitle']) ? true : false);
        }

        return $type;
    }


}
