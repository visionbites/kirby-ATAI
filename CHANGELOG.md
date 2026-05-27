# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.0] – 2026-05-27

### Added
- New `target` field property to specify which files field holds the image when the field is used in a page blueprint (instead of a file blueprint)
- Support for page view image resolution via `k-page-view` detection — the field now works both on file views and page views
- Input validation on the backend: returns a proper `400` error when `image` or `lang` fields are missing
- Explicit `404` response when the requested image cannot be found

### Changed
- Kirby 5 version constraint (`^5.0`) added to `composer.json` requirements
- API key is now truncated in metadata sent to alttext.ai (only first 8 characters + `...`) to avoid leaking credentials in logs
- UUID parsing now correctly strips the `file://` prefix before looking up the file, preventing lookup failures
- Option key renamed from `reachable` to `is_reachable` to match the documented configuration key
- `onInput` in the Vue component no longer mutates the `value` prop directly — it emits the new value via the `input` event instead

### Fixed
- View detection logic corrected: the field now properly detects `k-file-view` vs `k-page-view` to resolve the image UUID
- API call errors on the backend are now caught and returned as a JSON error response (`500`) instead of throwing an unhandled exception
- API call errors on the frontend are now caught and displayed via `this.$panel.error()` instead of failing silently

### Documentation
- README restructured with Requirements section, separate File/Page blueprint examples, field property table, and Development section
- Options table updated with correct `is_reachable` key name and improved descriptions

## [1.0.1] – 2025-03-16

### Fixed
- Fixed typo in `composer.json`

## [1.0.0] – 2025-03-16

### Added
- Initial release: `atai` field type for generating alt text via alttext.ai API
- Support for image URL mode (`is_reachable: true`) and base64 upload mode
- Configuration options: `api_key`, `reference`, `is_reachable`