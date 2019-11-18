<?php
$urlToPublishersAutocompletedemoJson = $this->Url->build([
    "controller" => "Publishers",
    "action" => "findPublishers",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToPublishersAutocompletedemoJson . '";', ['block' => true]);
echo $this->Html->script('Publishers/autocompletedemo', ['block' => 'scriptBottom']);
?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Publisher'), ['action' => 'add']) ?></li>
    </ul>
</nav>

<?= $this->Form->create('Publishers') ?>
<fieldset>
    <legend><?= __('Search Publisher') ?></legend>
    <?php
    echo $this->Form->input('name', ['id' => 'autocomplete']);
    ?>
</fieldset>
<?= $this->Form->end() ?>