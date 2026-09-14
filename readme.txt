=== DimiPress Local Avatar ===
Contributors: dimipress
Tags: avatar, profile, user profile, media library, gravatar
Requires at least: 6.4
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.3.1
License: AGPLv3 or later
License URI: https://www.gnu.org/licenses/agpl-3.0.html

Choose a local Media Library image as a WordPress user's profile avatar.

== Description ==

DimiPress Local Avatar lets a user, or an administrator editing that user, choose an image from the WordPress Media Library on the profile screen. The selected image is used wherever WordPress calls `get_avatar()`, replacing the external Gravatar image for that user.

The controls appear directly in the built-in Profile Picture section. Users can explicitly switch between Gravatar and a local image at any time. The plugin has no service, theme, or site-specific dependency. Images stay in the normal Media Library and remain there if an avatar is removed or the plugin is deleted.

== Installation ==

1. Upload the `dimipress-local-avatar` directory to `/wp-content/plugins/`, or install its ZIP from Plugins > Add New > Upload Plugin.
2. Activate DimiPress Local Avatar.
3. Open Users > Profile (or edit any user you can edit), choose an image under Local avatar, and save the profile.

== Usage ==

1. Go to Users > Profile to edit your account, or Users > All Users to edit another account you are allowed to manage.
2. Find the built-in Profile Picture section.
3. Click Choose local image and select or upload an image in the WordPress Media Library.
4. The switch changes to Local automatically. You can use the Gravatar/Local switch to choose which profile image WordPress displays.
5. Click Update Profile to save the choice.

To stop using a local avatar, switch back to Gravatar. To clear the saved local-image choice entirely, click Remove saved local image and update the profile. This does not delete the original Media Library image.

== Frequently Asked Questions ==

= Does it delete the selected image when I remove an avatar? =

No. It only removes the user's avatar setting. The Media Library attachment is untouched.

= Does it disable Gravatar for everyone? =

No. Users without a chosen local avatar continue using WordPress's normal avatar behavior.

== Privacy ==

Local-avatar settings are stored as WordPress user metadata: the selected Media Library attachment ID and the preferred avatar source. The plugin does not collect analytics or send this data to a service.

The Profile Picture control shows a Gravatar preview. That preview requests the user's Gravatar image using the standard MD5 hash of their email address, as WordPress normally does when Gravatar is used. Choosing a local image makes WordPress use the local Media Library attachment wherever it displays that user's avatar.

== Support ==

For questions, feedback, and contributions, contact <a href="https://github.com/tradicije">Aleksa Dimitrijević on GitHub</a> or email <a href="mailto:aleksa@linux.com">aleksa@linux.com</a>.

== Changelog ==

= 1.3.1 =
* Added complete plugin metadata and public project documentation.
* Improved attachment permission validation and profile-picture controls.

= 1.3.0 =
* Validated that a user can edit a selected Media Library attachment before saving it as an avatar.

= 1.2.0 =
* Added a visual Gravatar/local-avatar choice and iOS-style switch.

= 1.1.0 =
* Moved controls into WordPress's built-in Profile Picture section.
* Added an explicit Gravatar/local-image switch.
* Added contributor guidance.

= 1.0.0 =
* Initial release.
