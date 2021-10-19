<?php

namespace Xanweb\FormAdvancedCheckbox\Service;

use Concrete\Core\Express\Form\Context\FormContext;
use Concrete\Core\Form\Context\Registry\ControlRegistry as CoreControlRegistry;
use Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use Xanweb\FormAdvancedCheckbox\Express\Form\Control\View\AttributeKeyFormView;

class ServiceProvider extends CoreServiceProvider
{
    public function register(): void
    {
        $this->app->extend(CoreControlRegistry::class, function (CoreControlRegistry $registry, $app) {
            $registry->register(new FormContext(), 'express_control_attribute_key', AttributeKeyFormView::class);

            return $registry;
        });
    }
}
