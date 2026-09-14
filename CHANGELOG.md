# Changelog

All notable changes to this project are documented here.

## 1.3.4 - 2026-09-14

### Accessibility

- Added accessible names to the Gravatar and Local avatar selection buttons.
- Added screen-reader status messages after selecting or removing a local avatar.

### Reliability

- Fall back to Gravatar in the profile interface when a saved local image is no longer available.
- Clear stale local-avatar metadata when the profile is next saved.
- Open the Media Library when an empty Local avatar choice is selected.
- Confirmed local avatars are returned through standard WordPress REST API avatar URLs.
- Matched the source switch corner radius to WordPress action buttons.

## 1.3.3 - 2026-09-14

- Confirmed compatibility with WordPress 7.1 and PHP 8.3.
- Updated the plugin homepage URL.

## 1.3.2 - 2026-09-14

- Updated the Gravatar preview to use Gravatar's current SHA-256 email-hash format.

## 1.3.1 - 2026-09-14

- Added plugin author, homepage, license, and translation metadata.
- Added a private vulnerability-reporting policy.
- Added maintainer GitHub and email contact details.
- Added a GitHub README with usage documentation and screenshots.

## 1.3.0 - 2026-09-14

- Require permission to edit a selected attachment before it can be saved as an avatar.
- Reject trashed attachments and centralize the plugin asset version.

## 1.2.8 - 2026-09-14

- Refined spacing around the source switch and help text.

## 1.2.7 - 2026-09-14

- Allowed help text to extend to the action-row width outside the preview container.

## 1.2.6 - 2026-09-14

- Matched help-text width to the action area and added separation above it.

## 1.2.5 - 2026-09-14

- Kept local-avatar actions on one row independently of the preview width.

## 1.2.4 - 2026-09-14

- Styled the remove action as a red WordPress button.

## 1.2.3 - 2026-09-14

- Improved spacing between local-avatar actions.

## 1.2.2 - 2026-09-14

- Removed duplicate labels beneath the avatar previews.

## 1.2.1 - 2026-09-14

- Matched the switch width to the two avatar previews and centered it.

## 1.2.0 - 2026-09-14

- Displayed Gravatar and local-avatar choices side by side.
- Replaced radio controls with an accessible iOS-style switch.
- Styled the switch as a segmented control with a blue active label.

## 1.1.0 - 2026-09-14

- Added a Gravatar or local-image selector in the standard WordPress Profile Picture area.
- Kept saved local images available when a user temporarily switches back to Gravatar.
- Added project contribution guidance.

## 1.0.0 - 2026-09-14

- Initial release with Media Library avatar selection and WordPress avatar integration.
