<?php
use Migrations\AbstractMigration;

class IngredientsMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('ingredients');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('unity', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('amount', 'integer', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('note', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('recipe_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        
        $table->addForeignKey('recipe_id', 'recipes', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
