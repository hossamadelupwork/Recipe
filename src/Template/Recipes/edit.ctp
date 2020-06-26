<h1>Edit Recipe</h1>
<?php
    echo $this->Form->create($recipe);
    echo $this->Form->control('name');
    echo $this->Form->control('summary');
    echo $this->Form->control('instructions', ['rows' => '3']);
    ?>
    <h1>Ingredients</h1>
    <table>
    <tr>
        <th>Name</th>
        <th>Unity</th>
        <th>Amount</th>
        <th>Note</th>
    </tr>

    <?php foreach ($recipe->ingredients as $key=>$ingredient): ?>
    <tr>
        <?php echo $this->Form->input('ingredients.'.$key.'.id', ['type' => 'hidden', 'value' => $ingredient->id]); ?>

        <td> 
            <?php echo $this->Form->control('ingredients.'.$key.'.name',['value'=>$ingredient->name]); ?>
        </td>
        <td>
            <?php echo $this->Form->control('ingredients.'.$key.'.unity',['value'=>$ingredient->unity]); ?>
        </td>
        <td>
            <?php echo $this->Form->control('ingredients.'.$key.'.amount',['value'=>$ingredient->amount]); ?>
        </td>
        <td>
            <?php echo $this->Form->control('ingredients.'.$key.'.note',['value'=>$ingredient->note]); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
    echo $this->Form->control('serving',['type'=>'number']);
    echo $this->Form->control('prep_time',['type'=>'time']);
    echo $this->Form->control('cook_time',['type'=>'time']);
    echo $this->Form->button(__('Save Recipe'));
    echo $this->Form->end();
?>