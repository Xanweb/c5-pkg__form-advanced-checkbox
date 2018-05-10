<?php
namespace Concrete\Package\FormAdvancedCheckbox\Attribute\AdvancedCheckbox;

use Concrete\Core\Attribute\DefaultController;
use Concrete\Core\Attribute\FontAwesomeIconFormatter;
use Core;
use Database;
use Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Key\Settings\AdvancedCheckboxSettings;
use Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Value\Value\AdvancedCheckboxValue;

class Controller extends DefaultController
{

    protected $akContent;
    public $helpers = array('form');

    public function saveKey($data)
    {
        /**
         * @var $type AdvancedCheckboxSettings
         */
        $type = $this->getAttributeKeySettings();
        $data += array(
            'akContent' => null,
        );
        $akContent = $data['akContent'];

        $type->setContent($akContent);

        return $type;
    }

    public function getDisplayValue()
    {
        return h($this->getAttributeValue()->getValue());
    }

    public function form()
    {
        $this->load();
        $value = null;
        if (is_object($this->attributeValue)) {
            $value = $this->app->make('helper/text')->entities($this->getAttributeValue()->getValue());
        }
        $this->set('value', $value);
        $akContent = '';
        if (isset($this->akContent)) {
            $akContent = $this->akContent;
        }
        $this->set('akContent', $akContent);
    }

    public function searchForm($list)
    {
        $list->filterByAttribute($this->attributeKey->getAttributeKeyHandle(), '%' . $this->request('value') . '%', 'like');

        return $list;
    }

    public function search()
    {
        $f = Core::make('helper/form');
        echo $f->text($this->field('value'), $this->request('value'));
    }

    public function type_form()
    {
        $this->load();$this->set('editor',$this->app->make('editor'));
    }

    protected function load()
    {
        $ak = $this->getAttributeKey();
        if (!is_object($ak)) {
            return false;
        }

        $type = $ak->getAttributeKeySettings();
        /**
         * @var $type AdvancedCheckboxSettings
         */
        $this->akContent = $type->getContent();
        $this->set('akContent', $type->getContent());
        $this->set('editor',$this->app->make('editor'));
    }

    public function exportKey($akey)
    {
        $this->load();
        $akey->addChild('type')->addAttribute('akContent', $this->akContent);

        return $akey;
    }

    public function createAttributeValue($value)
    {
        $av = new AdvancedCheckboxValue();
        $av->setValue($value);

        return $av;
    }

    public function importKey(\SimpleXMLElement $akey)
    {
        $type = $this->getAttributeKeySettings();
        if (isset($akey->type)) {
            $data['akContent'] = $akey->type['akContent'];
            $type->setContent((string) $akey->type['akContent']);
        }

        return $type;
    }


}
