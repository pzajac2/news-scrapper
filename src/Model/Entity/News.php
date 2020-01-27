<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * News Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $downloaded
 * @property int $author_id
 * @property string $title
 * @property string $excerpt
 * @property string $contents
 *
 * @property \App\Model\Entity\Author $author
 */
class News extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'created' => true,
        'modified' => true,
        'downloaded' => true,
        'author_id' => true,
        'title' => true,
        'excerpt' => true,
        'contents' => true,
        'author' => true
    ];
}
