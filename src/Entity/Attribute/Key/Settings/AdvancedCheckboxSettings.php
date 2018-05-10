<?php
namespace Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Key\Settings;

use Concrete\Core\Entity\Attribute\Key\Settings\Settings;
use Concrete\Package\FormAdvancedCheckbox\Entity\Attribute\Value\Value\AdvancedCheckboxValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="atAdvancedCheckboxSettings")
 */
class AdvancedCheckboxSettings extends Settings
{
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $akContent = '';

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->akContent;
    }

    /**
     * @param string $akContent
     */
    public function setContent($akContent)
    {
        $this->akContent = $akContent;
    }
}
