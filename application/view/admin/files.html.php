<h2><?=i18n('admin.files.title')?></h2>
<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix ui-widget-content ui-state-default ui-corner-all">
	<?php foreach ($files as $file): ?>
	<?php
	switch ($file->getType()):
        case 'image': $src = src('upload/' . $file->filename); break;
        case 'audio': $src = src('img/admin/sound_48.png'); break;
        case 'video': $src = src('img/admin/film_48.png'); break;
        case 'application':
            if ($file->getSubtype() == 'pdf') { $src =  src('img/admin/document_48.png'); break; }
        default: $src = src('img/admin/app_48.png'); break;
	endswitch;
	?>
	<li class="ui-widget-content ui-corner-tr ui-draggable ui-corner-all" id="<?=$file->id?>">
		<h5 class="ui-widget-header ui-corner-all"><?=$file->filename?></h5>
		<img width="96" height="72" alt="<?=$file->filename?>" src="<?=$src?>" class="ui-corner-all" />
		<?php if ($file->getType() == 'image'): ?>
		<a class="ui-icon ui-icon-zoomin tiptip" title="<?=i18n('admin.files.file.view')?>" href="<?=$src?>">
		    <?=i18n('admin.files.file.view')?>
		</a>
		<?php endif ?>
		<a class="ui-icon ui-icon-info tiptip"
		   title="<?=i18n('admin.files.file.info')?>"
		   href="<?=url('admin', 'getFileInfo')?>?id=<?=$file->id?>">
		   <?=i18n('admin.files.file.info')?>
		</a>
		<a class="ui-icon ui-icon-trash tiptip"
		   title="<?=i18n('admin.files.file.delete')?>"
		   href="<?=url('admin', 'deleteFile')?>?id=<?=$file->id?>">
		    <?=i18n('admin.files.file.delete')?>
		</a>
	</li>
	<?php endforeach ?>
</ul>
<div id="properties" class="ui-widget-content ui-state-default ui-corner-all">
	<h4 class="ui-widget-header ui-corner-all">
		<span class="ui-icon ui-icon-info">Trash</span><?=i18n('admin.files.properties.title')?>
	</h4>
</div>
<div id="upload" class="ui-widget-content ui-state-default ui-corner-all">
	<h4 class="ui-widget-header ui-corner-all">
		<span class="ui-icon ui-icon-trash">Trash</span><?=i18n('admin.files.upload.title')?>
	</h4>
	<form action="<?=url('admin', 'upload')?>" method="post" enctype="multipart/form-data">
		<input type="file" name="files[]" />
		<input type="submit" value="<?=i18n('admin.files.upload.button.send')?>" />
		<input type="button" value="<?=i18n('admin.files.upload.button.add')?>" id="btnadd" />
	</form>
</div>
<div id="trash" class="ui-widget-content ui-state-default ui-corner-all">
	<h4 class="ui-widget-header ui-corner-all">
		<span class="ui-icon ui-icon-trash">Trash</span><?=i18n('admin.files.delete.title')?>
	</h4>
	<input type="button" id="btndelete" value="<?=i18n('admin.files.delete.empty')?>" />
</div>
<div class="clear"></div>
<script type="text/javascript">
<!--
$(function() {
	// there's the gallery and the trash
	var $gallery = $( "#gallery" ),
		$trash = $( "#trash" );

	// let the gallery items be draggable
	$( "li", $gallery ).draggable({
		cancel: "a.ui-icon", // clicking an icon won't initiate dragging
		revert: "invalid", // when not dropped, the item will revert back to its initial position
		helper: "clone",
		cursor: "move"
	});

	// let the trash be droppable, accepting the gallery items
	$trash.droppable({
		accept: "#gallery > li",
		activeClass: "ui-state-highlight",
		drop: function( event, ui ) {
			deleteImage( ui.draggable );
		}
	});

	// let the gallery be droppable as well, accepting items from the trash
	$gallery.droppable({
		accept: "#trash li",
		activeClass: "custom-state-active",
		drop: function( event, ui ) {
			recycleImage( ui.draggable );
		}
	});

	// image deletion function
	var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>"+
	                   "Recycle image</a>";
	function deleteImage( $item ) {
		$item.fadeOut(function() {
			var $list = $( "ul", $trash ).length ?
				$( "ul", $trash ) :
				$( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );

			$item.find( "a.ui-icon-trash" ).remove();
			$item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
				$item
					.animate({ width: "48px" })
					.find( "img" )
						.animate({ height: "36px" });
			});
		});
	}

	// image recycle function
	var trash_icon = "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>"+
	                 "Delete image</a>";
	function recycleImage( $item ) {
		$item.fadeOut(function() {
			$item
				.find( "a.ui-icon-refresh" )
					.remove()
				.end()
				.css( "width", "96px")
				.append( trash_icon )
				.find( "img" )
					.css( "height", "72px" )
				.end()
				.appendTo( $gallery )
				.fadeIn();
		});
	}

	// image preview function, demonstrating the ui.dialog used as a modal window
	function viewLargerImage( $link ) {
		var src = $link.siblings( "img" ).attr('src'),
		$img = $('<div><img src="' + src + '" /></div>');
		$img.dialog({
			modal: true,
			width: 500,
			height: 'auto',
			resizable: false,
			title: src
		}).find('img').imgscale();
	}

	// get file properties
	function viewProperties ( $item ) {
		var file_id = $item.attr('id'),
			url = $item.find('a.ui-icon-info').attr('href');
		$.ajax({
			url: url,
			data: { id: file_id, format: 'json' },
			success: function (data) {
				var $table = $("<table />").addClass('ui-widget sortable').hide();
				$.each(data, function (i, item) {
					$table.append('<tr><td class="ui-state-default">' + i + '</td><td class="ui-widget-content">' + item + '</td></tr>');
				});
				if ($( "#properties table" ).length)
					$( "#properties table" ).fadeOut(function () {
						$(this).remove();
						$('#properties').append($table.fadeIn());
					});
				else
					$('#properties').append($table.fadeIn());
			},
			failure: function () {
				alert('Error');
			}
		});
	}

	// resolve the icons behavior with event delegation
	$( "ul.gallery > li" ).click(function( event ) {
		var $item = $( this ),
			$target = $( event.target );

		if ( $target.is( "a.ui-icon-trash" ) ) {
			deleteImage( $item );
		} else if ( $target.is( "a.ui-icon-zoomin" ) ) {
			viewLargerImage( $target );
		} else if ( $target.is( "a.ui-icon-refresh" ) ) {
			recycleImage( $item );
		} else if ( $target.is( "a.ui-icon-info") ) {
			viewProperties ( $item );
		}

		return false;
	});

	$( "#btnadd" ).click(function () {
		$( "#upload form" ).prepend('<input type="file" name="files[]" />');
		$( "#gallery" ).height($( '#properties').height() + $( '#upload' ).height() + $( '#trash' ).height());

		return false;
	});

	$( "#btndelete" ).click(function () {
		if (!confirm('<?=i18n('admin.files.delete.confirm')?>'))
			return false;
		
		var data = { id: [], format: 'json' },
			list = $(this).siblings('ul').find('li');
		list.each(function (i, item) { data.id.push(item.id); });
		$.ajax({
			url: '<?=url('admin', 'deleteFile')?>',
			data: data,
			success: function () {
				list.fadeOut(function () { $(this).remove(); });
			},
			failure: function () {
				alert('Error');
			}
		});

		return false;
	});

	$( "#gallery" ).height($( '#properties').height() + $( '#upload' ).height() + $( '#trash' ).height());
});
//-->
</script>
