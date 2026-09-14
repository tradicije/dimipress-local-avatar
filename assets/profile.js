(function ($) {
	'use strict';

	$(function () {
		var frame;
		var input = $('#dimipress_local_avatar_id');
		var source = $('#dimipress_avatar_source');
		var toggle = $('#dimipress_avatar_toggle');
		var preview = $('.dimipress-local-avatar-local');
		var remove = $('.dimipress-local-avatar-remove');

		function setSource(value) {
			source.val(value);
			toggle.prop('checked', value === 'local');
			$('.dimipress-local-avatar-switch').toggleClass('is-local', value === 'local');
			$('.dimipress-local-avatar-option').removeClass('is-selected');
			$('.dimipress-local-avatar-option[data-avatar-source="' + value + '"]').addClass('is-selected');
		}

		setSource(source.val());
		toggle.on('change', function () { setSource(this.checked ? 'local' : 'gravatar'); });
		$('.dimipress-local-avatar-option').on('click', function () { setSource($(this).data('avatar-source')); });

		$('.dimipress-local-avatar-select').on('click', function () {
			if (frame) {
				frame.open();
				return;
			}
			frame = wp.media({
				title: dimipressLocalAvatar.title,
				button: { text: dimipressLocalAvatar.button },
				library: { type: 'image' },
				multiple: false
			});
			frame.on('select', function () {
				var image = frame.state().get('selection').first().toJSON();
				var url = image.sizes && image.sizes.thumbnail ? image.sizes.thumbnail.url : image.url;
				input.val(image.id);
				setSource('local');
				preview.html($('<img>', { src: url, alt: '', width: 96, height: 96 }));
				remove.prop('disabled', false);
			});
			frame.open();
		});

		remove.on('click', function () {
			input.val('');
			setSource('gravatar');
			preview.empty();
			remove.prop('disabled', true);
		});
	});
}(jQuery));
