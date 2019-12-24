<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Loans Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\HasMany $Books
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Loan get($primaryKey, $options = [])
 * @method \App\Model\Entity\Loan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Loan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Loan|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Loan saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Loan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Loan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Loan findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LoansTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('loans');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
	$this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id'
        ]);
        $this->hasMany('Books', [
            'foreignKey' => 'loan_id'
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'loan_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'loans_files'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        /*$validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->decimal('fine')
            ->requirePresence('fine', 'create')
            ->notEmptyString('fine');

        $validator
            ->scalar('note')
            ->maxLength('note', 255)
            ->requirePresence('note', 'create')
            ->notEmptyString('note');

        $validator
            ->date('date_issued')
            ->requirePresence('date_issued', 'create')
            ->notEmptyDate('date_issued');

        $validator
            ->date('date_due')
            ->requirePresence('date_due', 'create')
            ->notEmptyDate('date_due');

        $validator
            ->date('date_returned')
            ->requirePresence('date_returned', 'create')
            ->notEmptyDate('date_returned');

        return $validator;*/
        
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('fine');

        $validator
            ->allowEmpty('note');

        $validator
            ->allowEmpty('date_issued');

        $validator
            ->allowEmpty('date_due');

        $validator
            ->allowEmpty('date_returned');
        
        return $validator;
    }
    
    public function isOwnedBy($loanId, $userId) {
        return $this->exists(['id' => $loanId, 'user_id' => $userId]);
    }

}
