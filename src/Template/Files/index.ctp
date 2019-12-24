<?php
$urlRedirectToIndex = $this->Url->build([
    "controller" => "Files",
    "action" => "index"
        ]);
echo $this->Html->scriptBlock('var urlRedirectToIndex = "' . $urlRedirectToIndex . '";', ['block' => true]);
echo $this->Html->css('dropzone/dropzone.min');
echo $this->Html->script('dropzone/dropzone', ['block' => 'scriptLibraries']);
echo $this->Html->script('dropzone/RedirectToIndex', ['block' => 'scriptBottom']);
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Loans'), ['controller' => 'Loans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Loan'), ['controller' => 'Loans', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="files index large-9 medium-8 columns content">
    <h3><?= __('Files') ?></h3>
    <?php
    echo $this->Form->create('image', [
        'url' => ['controller' => 'Files',
            'action' => 'add'
        ],
        'method' => 'post',
        'id' => 'my-awesome-dropzone',
        'class' => 'dropzone',
        'type' => 'file',
        'autocomplete' => 'off'
    ]);
    ?>
    <div class="image_upload_div">
        <div class="dz-message" data-dz-message><h5>(<?= __('Drop files here to upload') ?>)</h5></div>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= __('Preview') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td><?= $this->Number->format($file->id) ?></td>
                        <td><?= h($file->name) ?></td>
                        <td>
                            <?php
                            echo $this->Html->image($file->path . $file->name, [
                                "alt" => $file->name,
                                "width" => "220px",
                                "height" => "150px",
                                'url' => ['action' => 'view', $file->id]
                            ]);
                            ?>

                        </td>
                        <td><?= h($file->created) ?></td>
                        <td><?= h($file->modified) ?></td>
                        <td><?= h($file->status) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $file->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $file->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->Form->end() ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
