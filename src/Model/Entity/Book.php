<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property int $loan_id
 * @property string $title
 * @property string $author
 * @property \Cake\I18n\FrozenDate $date_published
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Loan $loan
 */
class Book extends Entity
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
        'loan_id' => true,
        'publisher' => true,
        'title' => true,
        'author' => true,
        'date_published' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'loan' => true
    ];
}
