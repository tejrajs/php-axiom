<h2><img src="<?=src('img/admin/speaker_24.png')?>" /><?=i18n('admin.news.edit.title')?></h2>
<?php
$form = FormHelper::export(url('admin/news/save'));

$form->addFieldset(i18n('admin.news.edit.properties'))
    ->addLine('author', i18n('admin.news.edit.author'))
    ->addLine('date', i18n('admin.news.edit.date'), 'text', '', 'date')
    ->addLine('body', i18n('admin.news.edit.body'), 'textarea', '', 'cledit')
    ->addLine('published', i18n('admin.news.edit.published'), 'radio-group', array(i18n('lang.no') => 0, i18n('lang.yes') => 1));
    
$form->appendChild(InputHelper::export('save', 'submit', i18n('admin.form.save')));
$form->appendChild(InputHelper::export('cancel', 'submit', i18n('admin.form.cancel')));
$form->setId('edit-news')->autoFill($_REQUEST);

if (isset($news)) {
    $form->appendChild(InputHelper::export("id", "hidden", $news->id));
    $form->autoFill($news);
}

echo $form;
?>
