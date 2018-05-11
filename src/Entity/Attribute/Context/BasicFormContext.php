<?php
namespace Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Context;

use Concrete\Core\Attribute\Context\Context;
use Concrete\Core\Attribute\View;
use Concrete\Core\Entity\Attribute\Key\Key;
use Concrete\Core\Entity\Attribute\Value\AbstractValue;
use Concrete\Core\Filesystem\TemplateLocator;

class BasicFormContext extends Context
{

    public function __construct()
    {
        $this->runActionIfAvailable('composer'); //legacy
        $this->runActionIfAvailable('form');
        $this->includeTemplateIfAvailable('composer'); //legacy
        $this->includeTemplateIfAvailable('form');
    }

    public function setLocation(TemplateLocator $locator)
    {
        $locator = parent::setLocation($locator);
        $locator->prependLocation([DIRNAME_ELEMENTS .
            DIRECTORY_SEPARATOR .
            DIRNAME_EXPRESS .
            DIRECTORY_SEPARATOR .
            DIRNAME_EXPRESS_FORM_CONTROLS .
            DIRECTORY_SEPARATOR .
            DIRNAME_EXPRESS_FORM_CONTROLS // not a typo
            , 'form_advanced_checkbox']);
        return $locator;
    }

    public function render(Key $key, $value = null)
    {
        if (is_object($value)) {
            $v = new View($value);
        } else {
            $v = new View($key);
        }
        $v->render($this);
    }


}
