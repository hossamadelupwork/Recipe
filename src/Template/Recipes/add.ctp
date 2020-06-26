<!-- File: src/Template/Articles/add.ctp -->

<h1>Add Recipe</h1>
<?php

    echo $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    echo $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
    echo $this->Html->script([
        'https://code.jquery.com/jquery-3.5.1.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js'
    ]);

    echo $this->Form->create($recipe);
    echo $this->Form->control('name');
    echo $this->Form->control('summary');
    echo $this->Form->control('instructions', ['rows' => '3']);
?>

<!-- Ingredients table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Ingredients Table</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fa fa-plus fa-2x" aria-hidden="true"> Add Ingredients </i>  </a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Unity</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Note</th>
            <th class="text-center">Remove</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
    echo $this->Form->control('serving',['type'=>'number']);
    echo $this->Form->control('prep_time',['type'=>'time']);
    echo $this->Form->control('cook_time',['type'=>'time']);
    echo $this->Form->button(__('Save Recipe'));
    echo $this->Form->end();
?>


<!-- Editable table -->
<script>
    const $tableID = $('#table');
 const $BTN = $('#export-btn');
 const $EXPORT = $('#export');

    function createRow(index){
        return `<tr >
                    <td class="pt-3-half" contenteditable="true">
                        <input type="text" name="ingredients[${index}][name]" required="required">
                    </td>
                    <td class="pt-3-half" contenteditable="true">
                        <input type="text" name="ingredients[${index}][unity]" required="required">
                    </td>
                    <td class="pt-3-half" contenteditable="true">
                        <input type="number" name="ingredients[${index}][amount]" required="required">
                    </td>
                    <td class="pt-3-half" contenteditable="true">
                    <input type="text" name="ingredients[${index}][note]">
                    </td>
                    <td>
                        <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light">Remove</button></span>
                    </td>
                </tr>`;
    }

    $('.table-add').on('click', 'i', () => {
        $('tbody').append(createRow($tableID.find('tbody tr').length));
    });

    $tableID.on('click', '.table-remove', function () {

    $(this).parents('tr').detach();
    });

    $tableID.on('click', '.table-up', function () {

    const $row = $(this).parents('tr');

    if ($row.index() === 0) {
        return;
    }

    $row.prev().before($row.get(0));
    });

    $tableID.on('click', '.table-down', function () {

    const $row = $(this).parents('tr');
    $row.next().after($row.get(0));
    });

    // A few jQuery helpers for exporting only
    jQuery.fn.pop = [].pop;
    jQuery.fn.shift = [].shift;

    $BTN.on('click', () => {

    const $rows = $tableID.find('tr:not(:hidden)');
    const headers = [];
    const data = [];

    // Get the headers (add special header logic here)
    $($rows.shift()).find('th:not(:empty)').each(function () {

        headers.push($(this).text().toLowerCase());
    });

    // Turn all existing rows into a loopable array
    $rows.each(function () {
        const $td = $(this).find('td');
        const h = {};

        // Use the headers from earlier to name our hash keys
        headers.forEach((header, i) => {

        h[header] = $td.eq(i).text();
        });

        data.push(h);
    });

    // Output the result
    $EXPORT.text(JSON.stringify(data));
 });
</script>