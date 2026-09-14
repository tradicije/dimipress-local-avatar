# Contributing

Thanks for contributing to DimiPress Local Avatar.

## Development principles

- Keep the plugin independent of any theme, host, site URL, or third-party service.
- Preserve the WordPress Media Library as the single owner of image files.
- Do not delete an attachment when an avatar setting is removed.
- Maintain compatibility with the WordPress avatar API by using core hooks.
- Use WordPress coding conventions, capability checks, sanitization, escaping, and translations for every user-facing string.

## Before opening a pull request

1. Test choosing, changing, removing, and switching between a local image and Gravatar on both Profile and Edit User screens.
2. Confirm a user without a local avatar still gets WordPress's normal Gravatar behavior.
3. Run `php -l dimipress-local-avatar.php` and `php -l uninstall.php`.
4. Update `readme.txt` and `CHANGELOG.md` when behavior visible to users changes.

## Scope

Please open an issue before adding settings, remote services, analytics, or non-core dependencies.

## Contact

For questions, feedback, or contribution discussion, use [github.com/tradicije](https://github.com/tradicije) or email [aleksa@linux.com](mailto:aleksa@linux.com). For security issues, follow the private reporting process in [SECURITY.md](SECURITY.md).
