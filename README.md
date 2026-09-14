![DimiPress Local Avatar banner](img/banner.png)

# DimiPress Local Avatar

Choose a WordPress Media Library image as a user's profile avatar, with an easy switch back to Gravatar whenever wanted.

![License: AGPL-3.0-or-later](https://img.shields.io/badge/License-AGPL--3.0--or--later-3da639.svg)
![Requires WordPress 6.4+](https://img.shields.io/badge/WordPress-6.4%2B-21759b.svg)
![Requires PHP 7.4+](https://img.shields.io/badge/PHP-7.4%2B-777bb4.svg)

## Features

- Select an existing image or upload a new one through the standard WordPress Media Library.
- Choose between a local avatar and Gravatar directly in WordPress's built-in **Profile Picture** section.
- Keep a selected local image while temporarily switching back to Gravatar.
- Remove the avatar setting without deleting the original Media Library attachment.
- Use local avatars anywhere WordPress uses the standard `get_avatar()` API, including REST API `avatar_urls`.
- Accessible avatar controls with keyboard support and screen-reader feedback.
- No theme, host, remote service, or site-specific dependency.

## Screenshots

| Full wp-admin — Gravatar selected | Full wp-admin — Local selected |
| --- | --- |
| ![Full WordPress admin profile screen with Gravatar selected](img/Screenshot%20-%201.png) | ![Full WordPress admin profile screen with local avatar selected](img/Screenshot%20-%202.png) |

| Control detail — Gravatar selected | Control detail — Local selected |
| --- | --- |
| ![Close-up of DimiPress Local Avatar with Gravatar selected](img/Screenshot%20-%203.png) | ![Close-up of DimiPress Local Avatar with local image selected](img/Screenshot%20-%204.png) |

## Installation

1. Download or clone this repository.
2. Upload the `dimipress-local-avatar` directory to `/wp-content/plugins/`, or create a ZIP archive of that directory and upload it in **Plugins → Add New → Upload Plugin**.
3. Activate **DimiPress Local Avatar**.

## Usage

1. Open **Users → Profile**, or edit a user you are allowed to manage.
2. In **Profile Picture**, click **Choose local image**.
3. Select or upload an image in the Media Library.
4. The control switches to **Local** automatically. Use the segmented **Gravatar / Local** switch to select the avatar source.
5. Click **Update Profile** to save.

Switching to Gravatar preserves the chosen local image for later. **Remove saved local image** clears only the avatar setting; the Media Library file is never deleted.

If a saved local image has been deleted, trashed, or is no longer a valid image, the profile screen falls back to Gravatar. The stale avatar setting is cleared the next time the profile is saved.

## Requirements

- WordPress 6.4 or newer
- PHP 7.4 or newer

## Development and security

- [Contributing guide](CONTRIBUTING.md)
- [Security policy](SECURITY.md)
- [Changelog](CHANGELOG.md)
- [AGPL-3.0-or-later license](LICENSE)

## Contact

For questions, feedback, and contributions, contact [Aleksa Dimitrijević on GitHub](https://github.com/tradicije) or email [aleksa@linux.com](mailto:aleksa@linux.com). For security reports, please follow the [security policy](SECURITY.md).
