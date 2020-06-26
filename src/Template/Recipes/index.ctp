<!-- File: src/Template/Articles/index.ctp -->

<h1>Recipes</h1>
<p><?= $this->Html->link("Add Recipe", ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Summary</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

    <!-- Here is where we iterate through our $articles query object, printing out article info -->

    <?php foreach ($recipes as $recipe): ?>
    <tr>
        <td>
            <?= $this->Html->link($recipe->id, ['action' => 'view', $recipe->id]) ?>
        </td>
        <td>
            <?= $recipe->name ?>
        </td>
        <td>
            <?= $recipe->summary ?>
        </td>
        <td>
            <?= $recipe->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $recipe->id]) ?>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $recipe->id],
                ['confirm' => 'Are you sure?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>