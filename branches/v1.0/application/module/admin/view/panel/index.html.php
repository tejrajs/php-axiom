<div id="panel">
    <h2><?=i18n('admin.panel.title')?></h2>
    <div>
    	<span class="ui-widget-content ui-corner-all">
    		<a href="<?=url('admin/users')?>">
    			<img src="<?=src('img/admin/hat_48.png')?>" alt="hat_48.png" width="48" height="48" />
    			<?=i18n('admin.panel.users')?>
    		</a>
    	</span>
    </div>
    <div>
    	<span class="ui-widget-content ui-corner-all">
    		<a href="<?=url('admin/files')?>">
    			<img src="<?=src('img/admin/inbox_48.png')?>" alt="inbox_48.png" width="48" height="48" />
    			<?=i18n('admin.panel.files')?>
    		</a>
    	</span>
    </div>
    <div>
    	<span class="ui-widget-content ui-corner-all">
    		<a href="<?=url('admin/statistics')?>">
    			<img src="<?=src('img/admin/chart_bar_up_48.png')?>" alt="chart_bar_up_48.png" width="48" height="48" />
    			<?=i18n('admin.panel.statistics')?>
    		</a>
    	</span>
    </div>
    <div>
    	<span class="ui-widget-content ui-corner-all">
    		<a href="<?=url('admin/settings')?>">
    			<img src="<?=src('img/admin/gear_48.png')?>" alt="gear_48.png" width="48" height="48" />
    			<?=i18n('admin.panel.settings')?>
    		</a>
    	</span>
    </div>
    <?php if (!empty($modules)): ?>
    <h2><?=i18n('admin.panel.modules.title')?></h2>
    <?php foreach ($modules as $module_name => $module_definition): ?>
    <div>
    	<span class="ui-widget-conent ui-corner-all">
    		<a href="<?=$module_definition['url']?>">
    			<img src="<?=src('img/admin/app_48.png')?>" alt="app_48.png" width="48" height="48" />
    			<?=$module_name?>
    		</a>
    	</span>
    </div>
    <?php endforeach ?>
    <?php endif ?>
</div>