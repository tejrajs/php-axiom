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
    		<div class="comment">
    			
    		</div>
    		<?php endforeach ?>
    		<?php else: ?>
    		<p><?=i18n('admin.news.view.comments.no_comments')?></p>
    		<?php endif ?>
    	</div>
    </div>
</div>
