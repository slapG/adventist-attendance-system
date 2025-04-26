<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\AttendancesTable&\Cake\ORM\Association\HasMany $Attendances
 *
 * @method \App\Model\Entity\Employee newEmptyEntity()
 * @method \App\Model\Entity\Employee newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('employees');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Attendances', [
            'foreignKey' => 'employee_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('middle_name')
            ->maxLength('middle_name', 255)
            ->requirePresence('middle_name', 'create')
            ->notEmptyString('middle_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->integer('department_id')
            ->notEmptyString('department_id');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmptyDate('date_of_birth');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->scalar('place_of_birth')
            ->maxLength('place_of_birth', 255)
            ->requirePresence('place_of_birth', 'create')
            ->notEmptyString('place_of_birth');

        $validator
            ->scalar('qr_code')
            ->maxLength('qr_code', 255)
            ->allowEmptyString('qr_code');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('department_id', 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }
}
