<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publisher $publisher
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Publisher'), ['action' => 'edit', $publisher->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Publisher'), ['action' => 'delete', $publisher->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publisher->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Publishers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Publisher'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="publishers view large-9 medium-8 columns content">
    <h3><?= h($publisher->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($publisher->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($publisher->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($publisher->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($publisher->modified) ?></td>
        </tr>
    </table>
</div>
