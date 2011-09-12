<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=$lang?>" lang="<?=$lang?>">
	<head>
		<title><?=i18n('admin.title')?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="<?=$lang?>" />
        <link href="<?=src('css/lightness/jquery-ui-1.8.16.custom.css')?>" type="text/css" rel="stylesheet" media="screen" />
        <link href="<?=src('css/admin.css')?>" type="text/css" rel="stylesheet" media="screen" />
        <link href="<?=src('css/tipTip.css')?>" type="text/css" rel="stylesheet" media="screen" />
        <link href="<?=src('css/cleditor/cleditor.css')?>" type="text/css" rel="stylesheet" media="screen" />
        <link href="<?=src('css/fancybox/jquery.fancybox-1.3.4.css')?>" type="text/css" rel="stylesheet" media="screen" />
        <link href="<?=src('img/axiom_16.png')?>" type="image/png" rel="icon" />
        <script src="<?=src('js/jquery-1.5.1.min.js')?>" type="text/javascript"></script>
        <script src="<?=src('js/jquery.tablesorter.min.js')?>" type="text/javascript"></script>
        <script src="<?=src('js/jquery-ui-1.8.11.custom.min.js')?>" type="text/javascript"></script>
        <script src="<?=src('js/jquery.validate.js')?>" type="text/javascript"></script>
        <script src="<?=src('js/jquery.tipTip.minified.js')?>" type="text/javascript"></script>
        <script src="<?=src('js/jquery.cleditor.min.js')?>" type="text/javascript"></script>
        <script src="<?=src('js/jquery.fancybox-1.3.4.js')?>" type="text/javascript"></script>
		<script type="text/javascript">
		$(function () {
			$('.warning,.error').click(function () { $(this).hide('blind'); });
			$('.tiptip').tipTip({defaultPosition: 'top'});

			$('th').last().addClass('ui-corner-tr');
			$('th').first().addClass('ui-corner-tl');
			$('tfoot td').last().addClass('ui-corner-br');
			$('tfoot td').first().addClass('ui-corner-bl');

			$("form").addClass('ui-widget');
			$("fieldset").addClass('ui-widget-content ui-corner-all');
			$("legend").addClass('ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix');
			$("fieldset > div > :input").wrap($('<div>').addClass('ui-corner-all'));
			$("fieldset > div > span").buttonset().find('.ui-button-text').css('padding', '0.1em 0.4em');
			$("input[type='submit'],input[type='button']").button();
			$("input[type='password']").val('');

			$('#panel span').hover(
				function () { $(this).addClass('ui-state-active'); },
				function () { $(this).removeClass('ui-state-active'); }
			);

			$(".cledit").cleditor({width: '100%'});
			
			$("table.sortable").tablesorter({
				cssHeader: 'ui-widget-header',
				cssAsc: 'ui-state-active',
				cssDesc: 'ui-state-active',
				cancelSelection: true,
				widthFixed: true
			});
			
			$('a[rel=box]').fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600,
				'speedOut'		:	200,
				'overlayShow'	:	false
			});

			$(".foldable .title").css('cursor', 'pointer').click(function () {
				$(this).siblings().toggle();
			});

			$(".confirm").click(function () {
				return confirm('<?=i18n('admin.confirm_action')?>');
			});

			$("tbody tr").hover(
				function () { $(this).addClass('ui-state-active'); },
				function () { $(this).removeClass('ui-state-active'); }
			);
		});
		</script>
		<!--
			JQUERY UI THEME SWITCHER
		-->
		<link type="text/css" rel="stylesheet" href="http://jqueryui.com/themes/base/ui.all.css" />
        <script type="text/javascript" src="http://jqueryui.com/themeroller/themeswitchertool/"></script>
        <script type="text/javascript">
        $(function () {
        	$('#switcher').themeswitcher();
        });
        </script>
	</head>
	<body class="ui-widget-content">
		<!--
			JQUERY UI THEME SWITCHER HOLDER
		-->
		<div id="switcher"></div>
		<div id="wrapper" class="ui-widget-content">
			<div id="header" class="ui-widget-header ui-corner-bottom ui-helper-clearfix">
				<h1><a href="<?=url('admin')?>"><?=i18n('admin.header.title')?></a></h1>
				<div id="user">
            		<span><?=i18n('admin.header.user', $user->name, $user->surname)?></span>
            		<span><a href="<?=url('logout')?>"><?=i18n('admin.header.logout')?></a></span>
            	</div>
				<ul id="menu" class="ui-dialog-titlebar ui-widget-content ui-corner-all ui-helper-clearfix">
					<li><a href="<?=url('admin/users')?>"><?=i18n('admin.menu.users')?></a></li>
					<li><a href="<?=url('admin/files')?>"><?=i18n('admin.menu.files')?></a></li>
					<li><a href="<?=url('')?>"><?=i18n('admin.menu.view_site')?></a></li>
				</ul>
			</div>
			<div id="content">
				<div id="messages">
				<?php if (!empty($alerts)): ?>
					<?php foreach ($alerts as $alert): ?>
					<div class="ui-state-error ui-corner-all error">
						<p>
						    <span class="ui-icon ui-icon-alert"></span>
						    <?=$alert?>
						</p>
					</div>
					<?php endforeach ?>
				<?php endif ?>
				<?php if (!empty($warnings)): ?>
                    <?php foreach ($warnings as $warning): ?>
                    <div class="ui-state-highlight ui-corner-all warning">
						<p>
							<span class="ui-icon ui-icon-info"></span>
						    <?=$warning?>
						</p>
					</div>
					<?php endforeach ?>
				<?php endif ?>
				</div>
				<?=$content?>
			</div>
			<div id="footer">
				<div class="ui-widget-header ui-corner-top">
					&copy; 2011 Benjamin Delespierre
					- <a href="http://www.bdelespierre.fr" target="_blank">www.bdelespierre.fr</a>
					- <a href="http://code.google.com/p/php-axiom/" target="_blank" title="<?=i18n('axiom.subtitle')?>" class="tiptip">Powered by Axiom</a>
				</div>
			</div>
		</div>
	</body>
</html>