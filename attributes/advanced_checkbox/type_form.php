<?php
/* @var \Concrete\Core\Editor\RedactorEditor $editor */
?>
<fieldset>
<legend><?php echo t('Content to show on checkbox')?></legend>

<div class="form-group">
	<?php
    echo $editor->outputStandardEditor('akContent', $akContent); //isset($question) ? LinkAbstractor::translateTo($question->getName()) : ''
    ?>
</div>

</fieldset>