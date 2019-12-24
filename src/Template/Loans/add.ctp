<?php
$urlToLinkedListRequest = $this->Url->build([
    "controller" => "Categories",
    "action" => "getCategories",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListRequest = "' . $urlToLinkedListRequest . '";', ['block' => true]);
echo $this->Html->script('Loans/add', ['block' => 'scriptBottom']);
?>
<?php
/**
 * @var \App\View\AppView $this
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Loans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Books'), ['controller' => 'Books', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Book'), ['controller' => 'Books', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subcategories'), ['controller' => 'Subcategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subcategory'), ['controller' => 'Subcategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
   
<div class="loans form large-9 medium-8 columns content" ng-app="linkedlists" ng-controller="categoriesController">
    <!-- h3> Debug </h3>
    You have selected category: <span ng-bind="subcategories.id"></span> <span ng-bind="subcategories.name"></span><br/>
    and subcategory : <span ng-bind="subcategory.id"></span> <span ng-bind="subcategory.name"></span>
    <pre ng-show='categories'>{{ categories | json }}</pre>-->
    
    <?php
    echo $this->Form->create($loan);
    ?>
    
    <fieldset>
        <legend><?= __('Add Loan') ?></legend>
        <div>
            Categories: 
            <select name="Category_id"
                    id="category-id" 
                    class="browser-default"
                    ng-model="category" 
                    ng-options="category.name for category in categories track by category.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            Subcategories: 
            <select name="subcategory_id"
                    id="subcategory-id" 
                    class="browser-default"
                    ng-disabled="!category" 
                    ng-model="subcategory"
                    ng-options="subcategory.name for subcategory in category.subcategories track by subcategory.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>
        <?php
        echo $this->Form->control('fine');
        echo $this->Form->control('note');
        echo $this->Form->control('slug');
        echo $this->Form->control('date_issued');
        echo $this->Form->control('date_due');
        echo $this->Form->control('date_returned');
        echo $this->Form->control('files._ids', ['options' => $files, 'class' => 'browser-default']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save Loan')) ?>
    <?= $this->Form->end() ?>
</div>
