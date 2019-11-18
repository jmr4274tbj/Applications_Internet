<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subcategory Entity
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $name
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Loan[] $loans
 */
class Subcategory extends Entity
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
        'category_id' => true,
        'name' => true,
        'category' => true,
        'loans' => true
    ];
}
