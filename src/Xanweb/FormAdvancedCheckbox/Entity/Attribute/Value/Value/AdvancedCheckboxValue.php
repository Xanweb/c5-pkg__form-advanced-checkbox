<?php

namespace Xanweb\FormAdvancedCheckbox\Entity\Attribute\Value\Value;

use Concrete\Core\Entity\Attribute\Value\Value\AbstractValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="atAdvancedCheckbox")
 */
class AdvancedCheckboxValue extends AbstractValue
{
    /**
     * @ORM\Column(type="boolean")
     */
    protected $value = false;

    public function __toString()
    {
        return ($this->value) ? t('I agree') : t("I don't agree");
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
