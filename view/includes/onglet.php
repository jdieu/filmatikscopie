<script>
	var $doc = $(document),
		tabstitle;

	$(window).on('blur', function() {
		$("body").attr('data-title', $('#titre-page').text());
		var _i = 0;
		$('#titre-page').text('hey <?php echo $_SESSION['pseudo_af93b9fd121b211f85c2668c1b96706f']; ?>, reviens !');

	}).on('focus', function() {
		window.clearInterval(tabstitle);
		$('#titre-page').text($("body").attr('data-title'));

	});
</script>