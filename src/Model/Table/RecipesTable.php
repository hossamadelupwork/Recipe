<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class RecipesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->hasMany('Ingredients');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('name', false)
            ->maxLength('name', 255)

            ->allowEmpty('instructions', false)

            ->allowEmpty('summary', false)
            
            ->allowEmpty('serving', false)
            ->integer('serving', true)

            ->allowEmpty('prep_time', false)
            ->time('prep_time', true)
            
            ->allowEmpty('cook_time', false)
            ->time('cook_time', true);

        return $validator;
    }
}
