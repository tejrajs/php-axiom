<?php
$form = FormHelper::export()
    ->addLine("test1", "Test", "checkbox", 1)
    ->addLine("test2", "Test", "radio", 1)
    ->addLine("test3", "Test", "submit", "Envoyer");
    
$form->autoFill(array(
    'test1' => 1,
    'test2' => 1,
    'test3' => 'SandNigger',
));

echo $form;
?>