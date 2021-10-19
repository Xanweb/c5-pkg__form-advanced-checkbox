<?php

namespace Concrete\Package\FormAdvancedCheckbox;

use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Database\EntityManager\Provider\ProviderAggregateInterface;
use Concrete\Core\Database\EntityManager\Provider\StandardPackageProvider;
use Concrete\Core\Package\Package;
use Xanweb\FormAdvancedCheckbox\Module\Module;
use Xanweb\Module\Installer;
use Xanweb\Module\Uninstaller;

class Controller extends Package implements ProviderAggregateInterface
{
    protected $pkgHandle = 'form_advanced_checkbox';
    protected $appVersionRequired = '9.0.0@RC';
    protected $pkgVersion = '2.0';

    public function getPackageName(): string
    {
        return t('Advanced Checkbox Attribute');
    }

    public function getPackageDescription(): string
    {
        return t('Checkbox attribute with CkEditor label');
    }

    public function on_start()
    {
        Module::boot();
    }

    public function getPackageAutoloaderRegistries(): array
    {
        if (!class_exists(Module::class)) {
            return [
                'src/Xanweb/FormAdvancedCheckbox' => 'Xanweb\FormAdvancedCheckbox',
            ];
        }

        return [];
    }

    public function install()
    {
        $pkg = parent::install();

        $installer = new Installer($pkg);
        $at = $installer->installAttributeType('advanced_checkbox', tc('AttributeTypeName', 'Advanced checkbox'));

        $categorySvc = $this->app->make(CategoryService::class);
        foreach (['site', 'express'] as $akCategoryHandle) {
            $akc = $categorySvc->getByHandle($akCategoryHandle);
            $akc->getController()->associateAttributeKeyType($at);
        }
    }

    public function uninstall()
    {
        parent::uninstall();

        Uninstaller::dropTables('atAdvancedCheckboxSettings', 'atAdvancedCheckbox');
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityManagerProvider()
    {
        return new StandardPackageProvider($this->app, $this, [
            'src/Xanweb/FormAdvancedCheckbox/Entity' => 'Xanweb\FormAdvancedCheckbox\Entity',
        ]);
    }
}
