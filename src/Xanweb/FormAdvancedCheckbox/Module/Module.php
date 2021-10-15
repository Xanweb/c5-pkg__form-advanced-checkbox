<?php
namespace Xanweb\FormAdvancedCheckbox\Module;

use Xanweb\FormAdvancedCheckbox\Service\ServiceProvider;
use Xanweb\Module\Module as AbstractModule;

class Module extends AbstractModule
{

    public static function pkgHandle(): string
    {
        return 'form_advanced_checkbox';
    }

    protected static function getServiceProviders(): array
    {
        return [
            ServiceProvider::class
        ];
    }
}