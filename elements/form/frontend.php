<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="form-group">

    <?php if ($view->isRequired()) { ?>
        <span class="text-muted small"><?=t('Required')?></span>
    <?php } ?>

    <?php $view->renderControl()?>
</div>
