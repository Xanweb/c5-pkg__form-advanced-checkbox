<?php
namespace Concrete\Package\FormAdvancedCheckbox;

use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Attribute\TypeFactory;
use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Export\Item\AttributeType;
use Concrete\Core\Package\Package;
use Concrete\Core\Support\Facade\Facade;

class Controller extends Package
{
    protected $pkgHandle = 'form_advanced_checkbox';
    protected $appVersionRequired = '8.1';
    protected $pkgVersion = '0.0.1';

    public function getPackageName()
    {
        return t('Form advanced checkbox');
    }

    public function getPackageDescription()
    {
        return t('Form advanced checkbox');
    }
    protected $pkgAutoloaderRegistries = [
        'src' => 'Concrete\Package\FormAdvancedCheckbox',
    ];
    public function install()
    {
        $pkg = parent::install();
        $app = Facade::getFacadeApplication();
        $atFactory = $app->make(TypeFactory::class);

        $at = $atFactory->getByHandle('advanced_checkbox');
        if (!is_object($at)) {
            $at = $atFactory->add('advanced_checkbox', 'Advanced checkbox', $pkg);
        }
        $siteAkc = $app->make(CategoryService::class)->getByHandle('site');
        if (is_object($siteAkc)) {
            $siteAkc->getController()->associateAttributeKeyType($at);
        }
    }
}
