<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News[]|\Cake\Collection\CollectionInterface $news
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New News'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Authors'), ['controller' => 'Authors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Author'), ['controller' => 'Authors', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="news index large-9 medium-8 columns content">
    <h3><?= __('News') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('downloaded') ?></th>
                <th scope="col"><?= $this->Paginator->sort('author_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('excerpt') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contents') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $news): ?>
            <tr>
                <td><?= $this->Number->format($news->id) ?></td>
                <td><?= h($news->created) ?></td>
                <td><?= h($news->modified) ?></td>
                <td><?= h($news->downloaded) ?></td>
                <td><?= $news->has('author') ? $this->Html->link($news->author->name, ['controller' => 'Authors', 'action' => 'view', $news->author->id]) : '' ?></td>
                <td><?= h($news->title) ?></td>
                <td><?= h($news->excerpt) ?></td>
                <td><?= h($news->contents) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $news->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $news->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
