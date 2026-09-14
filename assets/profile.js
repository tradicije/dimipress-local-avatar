(function ($) {
	'use strict';

	$(function () {
		var frame;
		var input = $('#dimipress_local_avatar_id');
		var source = $('#dimipress_avatar_source');
		var toggle = $('#dimipress_avatar_toggle');
		var preview = $('.dimipress-local-avatar-local');
		var remove = $('.dimipress-local-avatar-remove');
		var status = $('#dimipress_local_avatar_status');
		var actions = $('.dimipress-local-avatar-actions');
		var description = actions.nextAll('.description').first();

		function setSource(value) {
			source.val(value);
			toggle.prop('checked', value === 'local');
			$('.dimipress-local-avatar-switch').toggleClass('is-local', value === 'local');
			$('.dimipress-local-avatar-option').each(function () {
				var option = $(this);
				var selected = option.data('avatar-source') === value;
				option.toggleClass('is-selected', selected).attr('aria-pressed', selected ? 'true' : 'false');
			});
		}

		function announce(message) {
			status.text(message);
		}

		function alignDescription() {
			description.width(actions.outerWidth());
		}

		function openMediaPicker() {
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
				announce(dimipressLocalAvatar.localSelected);
			});
			frame.open();
		}

		alignDescription();
		setSource(source.val());
		toggle.on('change', function () { setSource(this.checked ? 'local' : 'gravatar'); });
		$('.dimipress-local-avatar-option').on('click', function () {
			var avatarSource = $(this).data('avatar-source');
			if (avatarSource === 'local' && !parseInt(input.val(), 10)) {
				openMediaPicker();
				return;
			}
			setSource(avatarSource);
		});

		$('.dimipress-local-avatar-select').on('click', function () {
			openMediaPicker();
		});

		remove.on('click', function () {
			input.val('');
			setSource('gravatar');
			preview.empty();
			remove.prop('disabled', true);
			announce(dimipressLocalAvatar.localRemoved);
		});
	});
}(jQuery));
