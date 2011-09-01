<script type="text/javascript">
<!--
(function ($) {
	$.axiom = {
		init:  function () {
    		var arg = arguments[0] || { url: '/axiom/jsonbridge/getlocale' };
    		$.getJson(arg.url, function (json) {
    			$.axiom.locale.locale = json.locale || '';
    			$.axiom.locale.locales = json.locales || [];
    			$.axiom.locale.date_format = json.date_format || 'Y/m/d';
    			$.axiom.locale.translations = json.translations || {};
    			$.axiom.locale.base_url = json.base_url || '/axiom';
    		});
    	},

    	locale: {}
	};
	
	$.fn.i18n = $.axiom.i18n = function () {};
	$.fn.src = $.axiom.src = function () {};
	$.fn.url = $.axiom.url = function () {};
})(jQuery);
//-->
</script>
<?php throw new RuntimeException('test (exception)', 123); ?>