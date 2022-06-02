<?php
use Concrete\Core\Editor\LinkAbstractor;

/**
 * @var Concrete\Core\Attribute\View $view
 * @var Concrete\Core\Form\Service\Form $form
 * @var Concrete\Core\Editor\CkeditorEditor $editor
 * @var bool $akShowTitle
 * @var string $akContent
 */
$editor->setAllowFileManager(false);
$editor->setAllowSitemap(true);
$editor->getPluginManager()->deselect(['table', 'underline', 'specialcharacters', 'sourcearea', 'image', 'sourcedialog']);
?>

<fieldset>
    <legend><?= t('Settings') ?></legend>

    <div class="form-group">
        <div class="form-check">
            <?= $form->checkbox('akShowTitle', 1, $akShowTitle) ?>
            <?= $form->label('akShowTitle', t('Display question label'), ['class' => 'form-check-label']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label('akContent', t('Checkbox content')) ?>
        <?= $editor->outputStandardEditor('akContent', LinkAbstractor::translateFromEditMode($akContent)) ?>
        <p class="help-block mt-1"><?= t('This will be displayed next to the checkbox. If it is blank, the name of the attribute will be displayed.') ?></p>
    </div>
</fieldset>
