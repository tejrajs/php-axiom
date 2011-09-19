<h1><?=i18n('news.view.title')?></h1>
<div class="news">
	<div class="news-head">
		<span class="news-author"><?=i18n('news.view.author', $news->author)?></span>
		<span class="news-date"><?=i18n('news.view.date', $news->date)?></span>
	</div>
	<div class="news-body">
		<?=$news->body?>
	</div>
	<div class="news-comments">
		<h2><?=i18n('news.view.comments.title')?></h2>
		<?php foreach ($news->getComments() as $comment): ?>
		<div class="news-comments-head">
			<span class="news-comment-author">
				<a href="<?=($comment->website ? $comment->website : '#')?>">
				    <?=i18n('news.view.comment.author', $comment->author)?>
				</a>
			</span>
			<span class="news-comment-date">
			    <?=i18n('news.view.comment.date', $comment->date)?>
			</span>
		</div>
		<div class="news-comment-body">
			<?=$comment->body?>
		</div>
		<?php endforeach ?>
	</div>
	<form class="news-comments-add">
		<div><label><?=i18n('news.comments.form.author')?></label><input type="text" name="author" /></div>
		<div><label><?=i18n('news.comments.form.mail')?></label><input type="text" name="mail" /></div>
		<div><label><?=i18n('news.comments.form.website')?></label><input type="text" name="website" /></div>
		<div><label><?=i18n('news.comments.form.body')?></label><textarea name="body"></textarea></div>
		<div><input type="submit" value="<?=i18n('news.comments.form.submit')?>" /></div>
		<input type="hidden" name="id" value="<?=$news->id?>" />
	</form>
</div>
<script type="text/javascript">
$(function () {
	$('form.news-comments-add').submit(function () {
		alert('Submit Catched');
		return true;
	});
});
</script>
