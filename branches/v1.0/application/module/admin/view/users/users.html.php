<h2><img src="<?=src('img/admin/hat_24.png')?>" /><?=i18n('admin.users.title')?></h2>
<table class="ui-widget sortable">
	<thead>
		<tr>
			<th class="ui-state-default"><?=i18n('admin.users.table.login')?></th>
			<th class="ui-state-default"><?=i18n('admin.users.table.name')?></th>
			<th class="ui-state-default"><?=i18n('admin.users.table.surname')?></th>
			<th class="ui-state-default"><?=i18n('admin.users.table.creation')?></th>
			<th class="ui-state-default"><?=i18n('admin.users.table.connection')?></th>
			<th class="ui-state-default" colspan="3"><?=i18n('admin.table.action')?></th>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php foreach ($users as $user_view): ?>
		<tr>
			<td class="ui-widget-content"><?=$user_view->login?></td>
			<td class="ui-widget-content"><?=$user_view->name?></td>
			<td class="ui-widget-content"><?=$user_view->surname?></td>
			<td class="ui-widget-content"><?=$user_view->creation?></td>
			<td class="ui-widget-content"><?=$user_view->last_connection?></td>
			<td class="ui-widget-content action">
				<a href="<?=url('admin/users/edit')?>?id=<?=$user_view->id?>">
					<span class="ui-icon ui-icon-pencil tiptip" title="<?=i18n('admin.table.action.edit')?>"></span>
				</a>
			</td>
			<td class="ui-widget-content action">
				<a href="<?=url('admin/users/delete')?>?id=<?=$user_view->id?>">
					<span class="ui-icon ui-icon-close tiptip confirm" title="<?=i18n('admin.table.action.delete')?>"></span>
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
	<span class="ui-button-text">
		<a href="<?=url('admin/users/add')?>"><?=i18n('admin.users.add')?></a>
	</span>
</div>