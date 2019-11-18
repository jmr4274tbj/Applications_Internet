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
        //$this->addBehavior('Translate', ['fields' => ['note']]);
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
        $this->belongsToMany('Tags', [
            'foreignKey' => 'loan_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'loans_tags'
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
        $validator
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

        /*$validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            ->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
		*/
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    
     public function beforeSave($event, $entity, $options) {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

// The $query argument is a query builder instance.
// The $options array will contain the 'tags' option we passed
// to find('tagged') in our controller action.
    public function findTagged(Query $query, array $options) {
        $columns = [
            'Loans.id', 'Loans.user_id', 'Loans.fine',
            'Loans.note', 'Loans.date_issued', 'Loans.date_due',
            'Loans.date_returned', 'Loans.created',
            'Loans.slug',
        ];

        $query = $query
                ->select($columns)
                ->distinct($columns);

        if (empty($options['tags'])) {
            // If there are no tags provided, find loans that have no tags.
            $query->leftJoinWith('Tags')
                    ->where(['Tags.title IS' => null]);
        } else {
            // Find loans that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                    ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Loans.id']);
    }
}
