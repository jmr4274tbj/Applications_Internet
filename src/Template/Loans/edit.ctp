
<?php
$urlToLinkedListRequest = $this->Url->build([
    "controller" => "Categories",
    "action" => "getCategories",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListRequest = "' . $urlToLinkedListRequest . '";', ['block' => true]);
echo $this->Html->scriptBlock('var selectedCategoryId = "' . $loan->subcategory->category_id . '";', ['block' => true]);
echo $this->Html->scriptBlock('var selectedSubcategoryId = "' . $loan->subcategory_id . '";', ['block' => true]);
echo $this->Html->script('Loans/edit', ['block' => 'scriptBottom']);
?>

<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?=
            $this->Form->postLink(
                    __('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]
            )
        ?></li>
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
    <h3> Debug </h3>
    Original Category id: {{selectedCategoryId}}<br/>
    Original Subcategory id: {{selectedSubcategoryId}}<br/>
    Selected category: <span ng-bind="category.id"></span> <span ng-bind="category.name"></span><br/>
    Selected subcategory : <span ng-bind="category.subcategory.id"></span> <span ng-bind="category.subcategory.name"></span>
    <!-- pre ng-show='categories'>{{ categories | json }}</pre -->
    <?= $this->Form->create($loan) ?>
    <fieldset>
        <legend><?= __('Edit Loan') ?></legend>
        <div>
            Categories: 
            <select name="Category_id"
                    id="category-id" 
                    class="browser-default"
                    ng-init="category = { id: selectedCategoryId}"
                    ng-model="category" 
                    ng-options="item.name for item in categories track by item.id"
                    >
            </select>
        </div>
        <div>
            Subcategories: 
            <select name="subcategory_id"
                    id="subcategory-id" 
                    class="browser-default"
                    ng-model="category.subcategory"
                    ng-options="item.name for item in category.subcategories track by item.id"
                    >
            </select>
        </div>

        <?php
        echo $this->Form->control('fine');
        echo $this->Form->control('note');
        echo $this->Form->control('slug');
        echo $this->Form->control('date_issued');
        echo $this->Form->control('date_due');
        echo $this->Form->control('date_returned');
        echo $this->Form->control('files._ids', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
