<?php
namespace Concrete\Package\FormAdvancedCheckbox;

use Concrete\Core\Database\EntityManager\Provider\StandardPackageProvider;
use Concrete\Core\Database\EntityManager\Provider\ProviderAggregateInterface;
use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Package\Package;
use Xanweb\FormAdvancedCheckbox\Module\Module;
use Xanweb\Module\Installer;
use Xanweb\Module\Uninstaller;

class Controller extends Package implements ProviderAggregateInterface
{
    protected $pkgHandle = 'form_advanced_checkbox';
    protected $appVersionRequired = '8.2.1';
    protected $pkgVersion = '1.0.0';

    public function getPackageName()
    {
        return t('Advanced Checkbox Attribute');
    }

    public function getPackageDescription()
    {
        return t('Checkbox attribute with CkEditor label');
    }

    public function on_start()
    {
        Module::boot();
    }

    public function getPackageAutoloaderRegistries()
    {
        if (!class_exists(Module::class)) {
            return [
                'src/Xanweb/FormAdvancedCheckbox' => 'Xanweb\FormAdvancedCheckbox'
            ];
        }
        return [];
    }

    public function install()
    {
        $pkg = parent::install();
        $installer = new Installer($pkg);
        $siteAkc = $this->app->make(CategoryService::class)->getByHandle('site');
        $at = $installer->installAttributeType('advanced_checkbox', 'Advanced checkbox', $siteAkc);
        $expressAkc = $this->app->make(CategoryService::class)->getByHandle('express');
        $expressAkc->getController()->associateAttributeKeyType($at);
    }

    public function uninstall()
    {
        parent::uninstall();
        Uninstaller::dropTables('atAdvancedCheckboxSettings', 'atAdvancedCheckbox');
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityManagerProvider()
    {
        return new StandardPackageProvider($this->app, $this, [
            'src/Xanweb/FormAdvancedCheckbox/Entity' => 'Xanweb\FormAdvancedCheckbox\Entity',
        ]);
    }
}
