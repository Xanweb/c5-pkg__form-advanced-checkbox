<?php

namespace Xanweb\FormAdvancedCheckbox\Module;

use Xanweb\FormAdvancedCheckbox\Service\ServiceProvider;
use Xanweb\Module\Module as AbstractModule;

class Module extends AbstractModule
{
    /**
     * {@inheritdoc}
     *
     * @see AbstractModule::pkgHandle()
     */
    public static function pkgHandle(): string
    {
        return 'form_advanced_checkbox';
    }

    /**
     * {@inheritdoc}
     *
     * @see AbstractModule::getServiceProviders()
     */
    protected static function getServiceProviders(): array
    {
        return [
            ServiceProvider::class,
        ];
    }
}
