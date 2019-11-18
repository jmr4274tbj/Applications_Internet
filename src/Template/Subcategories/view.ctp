<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subcategory $subcategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subcategory'), ['action' => 'edit', $subcategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subcategory'), ['action' => 'delete', $subcategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subcategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subcategories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subcategory'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Loans'), ['controller' => 'Loans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Loan'), ['controller' => 'Loans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subcategories view large-9 medium-8 columns content">
    <h3><?= h($subcategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $subcategory->has('category') ? $this->Html->link($subcategory->category->name, ['controller' => 'Categories', 'action' => 'view', $subcategory->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subcategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subcategory->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Loans') ?></h4>
        <?php if (!empty($subcategory->loans)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Fine') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Date Issued') ?></th>
                <th scope="col"><?= __('Date Due') ?></th>
                <th scope="col"><?= __('Date Returned') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Subcategory Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subcategory->loans as $loans): ?>
            <tr>
                <td><?= h($loans->id) ?></td>
                <td><?= h($loans->user_id) ?></td>
                <td><?= h($loans->fine) ?></td>
                <td><?= h($loans->note) ?></td>
                <td><?= h($loans->slug) ?></td>
                <td><?= h($loans->date_issued) ?></td>
                <td><?= h($loans->date_due) ?></td>
                <td><?= h($loans->date_returned) ?></td>
                <td><?= h($loans->created) ?></td>
                <td><?= h($loans->modified) ?></td>
                <td><?= h($loans->subcategory_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Loans', 'action' => 'view', $loans->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Loans', 'action' => 'edit', $loans->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Loans', 'action' => 'delete', $loans->id], ['confirm' => __('Are you sure you want to delete # {0}?', $loans->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
