<h1>
    Loans tagged with
    <?= $this->Text->toList(h($tags), 'or') ?>
</h1>

<section>
    <?php foreach ($loans as $loan): ?>
        <article>
            <!-- Use the HtmlHelper to create a link -->
            <h4><?=
                $this->Html->link(
                        $loan->title,
                        ['controller' => 'Loans', 'action' => 'view', $loan->slug]
                )
                ?></h4>
            <span><?= h($loan->created) ?></span>
        </article>
<?php endforeach; ?>
</section>