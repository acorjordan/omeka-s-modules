# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.5.0] - 2023-03-13

This version adds support for PHP 8.0 and 8.1; the minimum supported version of
PHP is 7.4

### Dependencies

- Updated laminas-ldap from 2.10.3 to 2.15.0

## [0.4.0] - 2023-01-10

This version adds support for Omeka S 4.0; the minimum supported version of
Omeka S is 3.0.

## [0.3.2] - 2022-02-18

### Fixed

- Fixed error: Undefined constant "Ldap\Authentication\Adapter\identity"

## [0.3.1] - 2021-05-31

### Added

- Added options to map LDAP attributes to user's email and name (partially
  contributed by @Daniel-KM)

## [0.3.0] - 2021-03-26

**BREAKING CHANGE** The module is no longer compatible with Omeka S version 2.x

- Added compatibility with Omeka S version 3.x

## [0.2.0] - 2021-03-26

### Changed

- The module won't install if ldap extension is not loaded
- A message in the configuration form now tells about the LDAP servers configuration file
- Improve README.md (partially contributed by @Daniel-KM)

### Fixed

- Fix CSRF issue in configuration form (contributed by @Daniel-KM)

## [0.1.0] - 2021-03-26

Initial release

[0.5.0]: https://github.com/biblibre/omeka-s-module-Ldap/compare/v0.4.0...v0.5.0
[0.4.0]: https://github.com/biblibre/omeka-s-module-Ldap/compare/v0.3.2...v0.4.0
[0.3.2]: https://github.com/biblibre/omeka-s-module-Ldap/compare/v0.3.1...v0.3.2
[0.3.1]: https://github.com/biblibre/omeka-s-module-Ldap/compare/v0.3.0...v0.3.1
[0.3.0]: https://github.com/biblibre/omeka-s-module-Ldap/compare/v0.2.0...v0.3.0
[0.2.0]: https://github.com/biblibre/omeka-s-module-Ldap/compare/v0.1.0...v0.2.0
[0.1.0]: https://github.com/biblibre/omeka-s-module-Ldap/releases/tag/v0.1.0
