<?php defined('C5_EXECUTE') or die('Access Denied.');

/**
 * @var Concrete\Core\Attribute\View $view
 * @var Concrete\Core\Form\Service\Form $form
 * @var Concrete\Package\FormAdvancedCheckbox\Attribute\AdvancedCheckbox\Controller $controller
 * @var bool $checked
 */

use Concrete\Core\Editor\LinkAbstractor;

?>

<div class="form-group">
    <div class="form-check">
        <?= $form->checkbox($view->field('value'), 1, $checked) ?>
        <label class="form-check-label" for="<?= $view->field('value') ?>">
            <?= LinkAbstractor::translateFrom($controller->getCheckboxLabel()) ?>
        </label>
    </div>
</div>
