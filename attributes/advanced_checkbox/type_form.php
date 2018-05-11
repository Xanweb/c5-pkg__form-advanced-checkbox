<?php
/* @var \Concrete\Core\Editor\RedactorEditor $editor */
$editor->setAllowFileManager(false);
$editor->setAllowSitemap(false);
$editor->getPluginManager()->deselect(array('table', 'underline', 'specialcharacters','sourcearea','image','sourcedialog'));
?>
<fieldset>
    <legend><?php echo t('Settings')?></legend>
    <div class="form-group">
        <label>
            <?php echo $form->checkbox('akShowTitle', 1, $akShowTitle);?>
            <?php echo t('Display question label');?></label>
    </div>
    <div class="form-group">
        <label><?php echo t('Checkbox content')?></label>
        <?php
        echo $editor->outputStandardEditor('akContent', \Concrete\Core\Editor\LinkAbstractor::translateTo($akContent));
        ?>
    </div>

</fieldset>