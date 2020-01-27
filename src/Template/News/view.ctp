<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit News'), ['action' => 'edit', $news->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete News'), ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?> </li>
        <li><?= $this->Html->link(__('List News'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Authors'), ['controller' => 'Authors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Author'), ['controller' => 'Authors', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="news view large-9 medium-8 columns content">
    <h3><?= h($news->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Author') ?></th>
            <td><?= $news->has('author') ? $this->Html->link($news->author->name, ['controller' => 'Authors', 'action' => 'view', $news->author->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($news->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Excerpt') ?></th>
            <td><?= h($news->excerpt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contents') ?></th>
            <td><?= h($news->contents) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($news->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($news->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($news->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Downloaded') ?></th>
            <td><?= h($news->downloaded) ?></td>
        </tr>
    </table>
</div>
