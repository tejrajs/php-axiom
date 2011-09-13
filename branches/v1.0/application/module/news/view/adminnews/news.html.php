<h2><img src="<?=src('img/admin/speaker_24.png')?>" /><?=i18n('admin.news.title')?></h2>
<table class="ui-widget sortable">
	<thead>
		<tr>
    		<th class="ui-state-default">#</th>
    		<th class="ui-state-default"><?=i18n('admin.news.table.date')?></th>
    		<th class="ui-state-default"><?=i18n('admin.news.table.author')?></th>
    		<th class="ui-state-default"><?=i18n('admin.news.table.published')?></th>
    		<th class="ui-state-default" colspan="3"><?=i18n('admin.table.action')?></th>
		</tr>
	</thead>
	<tfoot>
	</tfoot>
	<tbody>
		<?php foreach ($news as $item): ?>
		<tr>
			<td class="ui-widget-content id"><?=$item->id?></td>
			<td class="ui-widget-content"><?=$item->date?></td>
			<td class="ui-widget-content"><?=$item->author?></td>
			<td class="ui-widget-content action">
    			<?php if ($item->published): ?>
    			<span class="ui-icon ui-icon-check"><?=i18n('lang.yes')?></span>
    			<?php else: ?>
    			<span class="ui-icon ui-icon-closethick"><?=i18n('lang.no')?></span>
    			<?php endif ?>
			</td>
			<td class="ui-widget-content action">
				<a href="<?=url('admin/news/view')?>&id=<?=$item->id?>">
					<span class="ui-icon ui-icon-search tiptip" title="<?=i18n('admin.table.action.view')?>"></span>
				</a>
			</td>
			<td class="ui-widget-content action">
				<a href="<?=url('admin/news/edit')?>&id=<?=$item->id?>">
					<span class="ui-icon ui-icon-pencil tiptip" title="<?=i18n('admin.table.action.edit')?>"></span>
				</a>
			</td>
			<td class="ui-widget-content action">
				<a href="<?=url('admin/news/view')?>&id=<?=$item->id?>">
					<span class="ui-icon ui-icon-close tiptip confirm" title="<?=i18n('admin.table.action.delete')?>"></span>
				</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
	<span class="ui-button-text">
		<a href="<?=url('admin/news/add')?>"><?=i18n('admin.news.add')?></a>
	</span>
</div>