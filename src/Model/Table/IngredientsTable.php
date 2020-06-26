<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class IngredientsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Recipes');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('name', false)
            ->maxLength('name', 255)

            ->allowEmpty('note', true)
            
            ->allowEmpty('unity', false)
            ->maxLength('unity', 255)

            ->allowEmpty('amount', false)
            ->integer('amount', true)
            
            ->allowEmpty('recipe_id ', false)
            ->integer('recipe_id ', true);

        return $validator;
    }
}
