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
    <legend><?= t('Settings'); ?></legend>

    <div class="form-group">
        <div class="form-check">
            <?php echo $form->checkbox('akShowTitle', 1, $akShowTitle); ?>
            <label class="form-check-label" for="akShowTitle">
                <?php echo t('Display question label'); ?>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label"><?= t('Checkbox content'); ?></label>
        <?= $editor->outputStandardEditor('akContent', LinkAbstractor::translateFromEditMode($akContent)); ?>
        <p class="help-block"><?= t('This will be displayed next to the checkbox. If it is blank, the name of the attribute will be displayed.'); ?></p>
    </div>
</fieldset>
