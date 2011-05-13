<h2><?=i18n('admin.users.edit.title')?></h2>
<?php
$form = FormHelper::export(url('admin', 'saveUser'));

$form->addFieldset(i18n('admin.users.edit.properties'))
    ->addLine('login', i18n('admin.users.edit.login'))
    ->addLine('password', i18n('admin.users.edit.password'), 'password')
    ->addLine('password_confirm', i18n('admin.users.edit.password.confirm'), 'password')
    ->addLine('name', i18n('admin.users.edit.name'))
    ->addLine('surname', i18n('admin.users.edit.surname'));
    
$form->appendChild(InputHelper::export('save', 'submit', i18n('admin.form.save')));
$form->appendChild(InputHelper::export('cancel', 'submit', i18n('admin.form.cancel')));
$form->setId('edit-user')->autoFill($_REQUEST);

if (isset($user_edit)) {
    $form->appendChild(InputHelper::export("id", "hidden", $user_edit->id));
    $form->autoFill($user_edit);
}

echo $form;
?>
