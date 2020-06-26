<h1><?= h($recipe->name) ?></h1>
<p><?= h($recipe->summary) ?></p>
<p><small>Created: <?= $recipe->created->format(DATE_RFC850) ?></small></p>
<p><?= $this->Html->link('Edit', ['action' => 'edit', $recipe->id]) ?></p>