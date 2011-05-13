<div id="#articles">
	<h2><?=i18n('admin.articles.title')?></h2>
	<table>
		<thead>
			<tr>
				<th><input type="checkbox" id="select_all" /></th>
				<th><?=i18n('admin.articles.table.title')?></th>
				<th><?=i18n('admin.articles.table.date')?></th>
				<th><?=i18n('admin.articles.table.author')?></th>
			</tr>
		</thead>
		<tbody>
		<?php if ($articles->valid()): ?>
		    <?php foreach ($articles as $article): ?>
			<tr>
				<td><input type="checkbox" name="articles[]" value="<?=$article->id?>" /></td>
				<td><?=$article->title?></td>
				<td><?=$article->date?></td>
				<td><?=$article->getAuthor()->name?></td>
			</tr>
		    <?php endforeach; ?>
		<?php endif; ?>
		</tbody>
	</table>
</div>