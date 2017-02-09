# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/).

NOTE: Always keep an Unreleased version at the top of this CHANGELOG for easy updating.

## [Unreleased] - YYYY-MM-DD
### Added
- For new features.
### Changed
- For changes in existing functionality.
### Deprecated
- For once-stable features removed in upcoming releases.
### Removed
- For deprecated features removed in this release.
### Fixed
- For any bug fixes.
### Security
- To invite users to upgrade in case of vulnerabilities.

## [2.0.0] - 2017-02-09
### Added
- CHANGELOG.md

### Changed
- Update composer to use lumen-framework 5.4.
- Update doc comments for functions.

### Fixed
- Namespace in CreatesHttpResponses, JsonExceptionHandler, ValidatesData.

## [1.4.0] - 2016-05-20
### Added
- Gitter badge.

### Changed
- JsonExceptionHandler to return valid json.
- Clean the exception stack trace in the JsonExceptionHandler.

## [1.3.3] - 2016-04-24
### Added
- Contributing information.

### Changed
- Update README.md
- Improve JsonExceptionHandler.

## [1.3.2] - 2016-04-06
### Fixed
- Namespace.

## [1.3.1] - 2016-04-01
### Added
- Proper route rendering to PaginatesData Trait.

## [1.3.0] - 2016-04-01
### Added
- PaginatesData trait.

### Removed
- Pagination from EntityService.

## [1.2.1] - 2016-03-31
### Fixed
- Namespace for EntityService.

## [1.2.0] - 2016-03-31
### Changed
- Format code style

### Removed
- Resource responses from CreatesHttpResponses.

## [1.1.3] - 2016-03-31
### Added
- EntityService service.
- PerformsSearch trait.

### Changed
- Update gitignore.
- Update composer.
- Format code style.

## [1.1.2] - 2016-03-30
### Fixed
- Bug in ExceptionHandler.

## [1.1.1] - 2016-03-30
### Added
- SerializesData Trait.

## [1.1.0] - 2016-03-26
### Changed
- Refactor ExceptionHandler.
- Move RunsLumen under Traits.

## [1.0.1] - 2016-03-26
### Added
- ShortId as dependency.

### Changed
- Refactor objectId to domainId.

## [1.0.0] - 2016-03-07
### Changed
- Restructuring of the project. 
- Update composer.

### Removed
- ChecksPermissions trait.
- SerializerService service.
- SerializesData trait.
- DomainEvent event.
- HasOccurred trait.

## [0.14.0] - 2015-12-22
### Added
- Function subjectHasPermission to ChecksPermissions trait.

## [0.13.1] - 2015-12-04
### Added
- JSON_PARTIAL_OUTPUT_ON_ERROR flag when encoding JSON responses.

## [0.13.0] - 2015-10-01
### Changed
- Renamed ProcessesRequests to CreatesHttpResponses.
- FiresEvents::fireEvent returns the result.
- Refactor DomainEvent.

## [0.12.3] - 2015-09-29
### Added
- Missing type hints to ValidatesData trait. 

## [0.12.2] - 2015-09-28
### Fixed
- Bug that caused ValidatesData trait to always pass validation. 

## [0.12.1] - 2015-09-16
## [0.12.0] - 2015-09-16
### Added
- Support for enabling/disabling entity filters.

## [0.11.1] - 2015-09-16
### Removed
- Hard-coded .env file.

## [0.11.0] - 2015-09-16
### Added
- RunsLumen trait.
- Missing methods to ChecksPermissions.

### Changed
- Moved lumen modules to suggests.

## [0.10.0] - 2015-09-10
### Added
- CreatesIdentities trait.

## [0.9.0] - 2015-09-09
### Changed
- Change function signature for validationFailedResponse and throwValidationFailed.

## [0.8.0] - 2015-09-09
### Added
- Application traits.

### Changed
- Re-factor existing application traits.

### Removed
- Controller. Use traits instead.

## [0.7.0] - 2015-09-08
### Added
- Application traits.

### Removed
- EntityController.

## [0.6.0] - 2015-09-03
### Added
- New exception classes.

### Changed
- Update composer. 
- Use HasIdentity trait.
- Re-factor model classes.

### Removed
- DocumentRepository.
- EntityEvent.

## [0.5.1] - 2015-09-03
### Fixed
- Missing use statement in DomainEvent.

## [0.5.0] - 2015-09-02
### Changed
- Re-factor DomainEvent and EntityEvent.

### Removed
- Filtering, sorting and pagination support. Use lumen-search instead.
- Document logic. Belongs in a separate project.

## [0.4.8] - 2015-08-19
### Added
- Most used functions to DocumentRepository.

## [0.4.7] - 2015-08-17
### Added
- Helper-functions to DocumentRepository.

## [0.4.6] - 2015-08-17
### Removed
- Unused function from IdentifiableDocumentObject.

## [0.4.5] - 2015-08-14
### Added
- IdentifiableDocumentObject for ODM. Similar to IdentifiableDomainObject in ORM.

## [0.4.4] - 2015-08-05
### Changed
- Consider integers and booleans to be values as well.

## [0.4.3] - 2015-08-05
### Added
- DocumentRepository.
- DocumentService.

## [0.4.2] - 2015-08-04
### Changed
- Update composer.
- Add keywords.

## [0.4.1] - 2015-08-04
### Changed
- Update composer.
- Use ORM namespace.

## [0.4.0] - 2015-08-04
### Added
- ODM models to implement Document.

## [0.3.2] - 2015-08-05
### Changed
- Consider integers and booleans to be values as well.

## [0.3.1] - 2015-08-04
### Added
- Ability to filter queries using "starts with" and "ends with".

## [0.3.0] - 2015-07-09
### Changed
- Default success response to an empty array.

## [0.2.5] - 2015-06-25
### Fixed
- Use statement in DomainEvent.

## [0.2.4] - 2015-06-25
### Changed
- Update composer.

## [0.2.3] - 2015-06-25
### Added
- New methods to EntityService.

## [0.2.2] - 2015-06-25
### Fixed
- Committing of entity changes.

## [0.2.1] - 2015-06-25
### Fixed
- Use statement in Controller.

## [0.2.0] - 2015-06-25
### Changed
- Update composer.

### Fixed
- Classes.

## [0.1.1] - 2015-06-23
### Changed
- Moved code under `src/`.

## [0.1.0] - 2015-06-23
### Added
- Project files.

[Unreleased]: https://github.com/nordsoftware/lumen-core/compare/2.0.0...HEAD
[2.0.0]: https://github.com/nordsoftware/lumen-core/compare/1.4.0...2.0.0
[1.4.0]: https://github.com/nordsoftware/lumen-core/compare/1.3.3...1.4.0
[1.3.3]: https://github.com/nordsoftware/lumen-core/compare/1.3.2...1.3.3
[1.3.2]: https://github.com/nordsoftware/lumen-core/compare/1.3.1...1.3.2
[1.3.1]: https://github.com/nordsoftware/lumen-core/compare/1.3.0...1.3.1
[1.3.0]: https://github.com/nordsoftware/lumen-core/compare/1.2.1...1.3.0
[1.2.1]: https://github.com/nordsoftware/lumen-core/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/nordsoftware/lumen-core/compare/1.1.3...1.2.0
[1.1.3]: https://github.com/nordsoftware/lumen-core/compare/1.1.2...1.1.3
[1.1.2]: https://github.com/nordsoftware/lumen-core/compare/1.1.1...1.1.2
[1.1.1]: https://github.com/nordsoftware/lumen-core/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/nordsoftware/lumen-core/compare/1.0.1...1.1.0
[1.0.1]: https://github.com/nordsoftware/lumen-core/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/nordsoftware/lumen-core/compare/0.14.0...1.0.0
[0.14.0]: https://github.com/nordsoftware/lumen-core/compare/0.13.1...0.14.0
[0.13.1]: https://github.com/nordsoftware/lumen-core/compare/0.13.0...0.13.1
[0.13.0]: https://github.com/nordsoftware/lumen-core/compare/0.12.3...0.13.0
[0.12.3]: https://github.com/nordsoftware/lumen-core/compare/0.12.2...0.12.3
[0.12.2]: https://github.com/nordsoftware/lumen-core/compare/0.12.1...0.12.2
[0.12.1]: https://github.com/nordsoftware/lumen-core/compare/0.12.0...0.12.1
[0.12.0]: https://github.com/nordsoftware/lumen-core/compare/0.11.1...0.12.0
[0.11.1]: https://github.com/nordsoftware/lumen-core/compare/0.11.0...0.11.1
[0.11.0]: https://github.com/nordsoftware/lumen-core/compare/0.10.0...0.11.0
[0.10.0]: https://github.com/nordsoftware/lumen-core/compare/0.9.0...0.10.0
[0.9.0]: https://github.com/nordsoftware/lumen-core/compare/0.8.0...0.9.0
[0.8.0]: https://github.com/nordsoftware/lumen-core/compare/0.7.0...0.8.0
[0.7.0]: https://github.com/nordsoftware/lumen-core/compare/0.6.0...0.7.0
[0.6.0]: https://github.com/nordsoftware/lumen-core/compare/0.5.1...0.6.0
[0.5.1]: https://github.com/nordsoftware/lumen-core/compare/0.5.0...0.5.1
[0.5.0]: https://github.com/nordsoftware/lumen-core/compare/0.4.8...0.5.0
[0.4.8]: https://github.com/nordsoftware/lumen-core/compare/0.4.7...0.4.8
[0.4.7]: https://github.com/nordsoftware/lumen-core/compare/0.4.6...0.4.7
[0.4.6]: https://github.com/nordsoftware/lumen-core/compare/0.4.5...0.4.6
[0.4.5]: https://github.com/nordsoftware/lumen-core/compare/0.4.4...0.4.5
[0.4.4]: https://github.com/nordsoftware/lumen-core/compare/0.4.3...0.4.4
[0.4.3]: https://github.com/nordsoftware/lumen-core/compare/0.4.2...0.4.3
[0.4.2]: https://github.com/nordsoftware/lumen-core/compare/0.4.1...0.4.2
[0.4.1]: https://github.com/nordsoftware/lumen-core/compare/0.4.0...0.4.1
[0.4.0]: https://github.com/nordsoftware/lumen-core/compare/0.3.2...0.4.0
[0.3.2]: https://github.com/nordsoftware/lumen-core/compare/0.3.1...0.3.2
[0.3.1]: https://github.com/nordsoftware/lumen-core/compare/0.3.0...0.3.1
[0.3.0]: https://github.com/nordsoftware/lumen-core/compare/0.2.5...0.3.0
[0.2.5]: https://github.com/nordsoftware/lumen-core/compare/0.2.4...0.2.5
[0.2.4]: https://github.com/nordsoftware/lumen-core/compare/0.2.3...0.2.4
[0.2.3]: https://github.com/nordsoftware/lumen-core/compare/0.2.2...0.2.3
[0.2.2]: https://github.com/nordsoftware/lumen-core/compare/0.2.1...0.2.2
[0.2.1]: https://github.com/nordsoftware/lumen-core/compare/0.2.0...0.2.1
[0.2.0]: https://github.com/nordsoftware/lumen-core/compare/0.1.1...0.2.0
[0.1.1]: https://github.com/nordsoftware/lumen-core/compare/0.1.0...0.1.1
[0.1.0]: https://github.com/nordsoftware/lumen-core/tree/0.1.0