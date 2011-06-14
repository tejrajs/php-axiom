<h1>Testing Table Generation</h1>
<?php

$table = TableHelper::export('test');

$table->body->setFilter(array('name', 'surname'));

$table
    ->addRows(User::getUsers())
    ->setColumnNames(array('col1', 'col2', 'col3'))
    ->addRow(array('test1', 'test2'), 'foot');

echo $table;
?>
<div id="dataisland"><?=JSonDataIslandHelper::export(array('test' => array(1,2,3)))?>Data Island</div>
<script type="text/javascript">
var init = function () {
	var json = eval('('+document.getElementById('dataisland').firstChild.data+')');
	alert(json.test[2]);
};
window.onload = init;
</script>