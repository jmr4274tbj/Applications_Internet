<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Loans'), ['controller' => 'Loans', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Loan'), ['controller' => 'Loans', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?= h($file->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($file->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Path') ?></th>
            <td><?= h($file->path) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($file->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($file->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($file->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $file->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Loans') ?></h4>
        <?php if (!empty($file->loans)): ?>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($file->loans as $loans): ?>
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
