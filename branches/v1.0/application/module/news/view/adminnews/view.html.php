<h2><img src="<?=src('img/admin/speaker_24.png')?>" /><?=i18n('admin.news.view.title')?></h2>
<div id="news-view" class="ui-widget">
    <div class="ui-widget-content ui-corner-all properties foldable">
    	<h3 class="ui-widget-header ui-corner-all title"><?=i18n('admin.news.view.properties.title')?></h3>
    	<div>
	    	<b><?=i18n('admin.news.view.properties.author')?>:</b><?=$news->author?><br />
        	<b><?=i18n('admin.news.view.properties.date')?>:</b><?=date2str(strtotime($news->date))?> (<?=$news->date?>)<br />
    	</div>
    </div>
    <div class="ui-widget-content ui-corner-all body foldable">
    	<h3 class="ui-widget-header ui-corner-all title"><?=i18n('admin.news.view.body.title')?></h3>
    	<div><?=$news->body?></div>
    </div>
    <div class="ui-widget-content ui-corner-all comments foldable">
    	<h3 class="ui-widget-header ui-corner-all title"><?=i18n('admin.news.view.comments.title')?></h3>
    	<div>
    		<?php if (count($comments = $news->getComments())): ?>
    		<?php foreach ($comments as $comment): ?>
    		<div class="ui-corner-all ui-widget-content comment <?=($comment->published ? 'published' : 'unpublished')?>">
    			<div class="settings">
    				<?=InputHelper::export('id', 'hidden', $comment->id)?>
    				<?=InputHelper::export('publish', 'button', i18n('admin.news.view.comment.publish'))?>
    				<?=InputHelper::export('unpublish', 'button', i18n('admin.news.view.comment.unpublish'))?>
        			<?=InputHelper::export('delete', 'button', i18n('admin.news.view.comment.delete'))?>
    			</div>
    			<div class="properties">
    				<b><?=i18n('admin.news.view.comment.properties.author')?>:</b><?=$comment->author?><br />
    				<b><?=i18n('admin.news.view.comment.properties.date')?>:</b><?=$comment->date?><br />
    				<b><?=i18n('admin.news.view.comment.properties.mail')?>:</b><?=$comment->mail?><br />
    				<b><?=i18n('admin.news.view.comment.properties.website')?>:</b><?=$comment->website?><br />
    				<b><?=i18n('admin.news.view.comment.properties.ip')?>:</b><?=$comment->ip?><br />
    			</div>
    			<div class="ui-widget-content ui-corner-all body">
    				<?=$comment->body?>
    			</div>
    		</div>
    		<?php endforeach ?>
    		<?php else: ?>
    		<p><?=i18n('admin.news.view.comments.no_comments')?></p>
    		<?php endif ?>
    	</div>
    </div>
</div>
<script type="text/javascript">
$(function () {
	$('.comment input[name="publish"]').click(function () {
		var id = $(this).siblings('input[name="id"]').val(),
			el = $(this);
		$.ajax({
			url: '<?=url('admin/news/publishComment')?>',
			data: { id: id },
			success: function (data) {
				if (data.success)
					el.toggle().parents('.comment').toggleClass('published unpublished').find('input[name="unpublish"]').toggle();
			},
			error: function () {
				alert('Error during XHR call');
			}
		});
	});

	$('.comment input[name="unpublish"]').click(function () {
		var id = $(this).siblings('input[name="id"]').val(),
			el = $(this);
		$.ajax({
			url: '<?=url('admin/news/unpublishComment')?>',
			data: { id: id },
			success: function (data) {
				if (data.success)
					el.toggle().parents('.comment').toggleClass('published unpublished').find('input[name="publish"]').toggle();
			},
			error: function () {
				alert('Error during XHR call');
			}
		});
	});

	$('.comment input[name="delete"]').click(function () {
		var id = $(this).siblings('input[name="id"]').val(),
			el = $(this);
		$.ajax({
			url: '<?=url('admin/news/deleteComment')?>',
			data: { id: id },
			success: function (data) {
				if (data.success)
					el.parents('.comment').hide('blind', function () { $(this).remove(); });
			},
			error: function () {
				alert('Error during XHR call');
			}
		});
	});

	$('.comments .published').find('input[name="publish"]').toggle();
	$('.comments .unpublished').find('input[name="unpublish"]').toggle();
});
</script>