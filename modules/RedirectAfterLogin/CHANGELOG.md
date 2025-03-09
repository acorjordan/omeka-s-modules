# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.4.0] - 2024-08-29

- Automatically redirect already logged in users

## [0.3.0] - 2023-06-16

This version adds compatibility with Omeka S 4. The minimum Omeka S version
required is still 2.0.0

## [0.2.0] - 2022-10-24

### Changed

- Now compatible with Omeka S 3
- If no `redirect_url` parameter was set and the logged in user does not have
  the permission to go to the administration dashboard, redirect to the front
  page instead

## [0.1.0] - 2020-12-01

Initial release

[0.4.0]: https://github.com/biblibre/omeka-s-module-RedirectAfterLogin/releases/tag/v0.4.0
[0.3.0]: https://github.com/biblibre/omeka-s-module-RedirectAfterLogin/releases/tag/v0.3.0
[0.2.0]: https://github.com/biblibre/omeka-s-module-RedirectAfterLogin/releases/tag/v0.2.0
[0.1.0]: https://github.com/biblibre/omeka-s-module-RedirectAfterLogin/releases/tag/v0.1.0
