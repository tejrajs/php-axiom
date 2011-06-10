<h1>Testing Table Generation</h1>
<?php

$table = TableHelper::export('test');

$table->body->setFilter(array('name', 'surname'));

$table
    ->addRows(User::getUsers())
    ->setColumnNames(array('col1', 'col2', 'col3'))
    ->addRow(array('test1', 'test2'), 'foot');

echo $table;
