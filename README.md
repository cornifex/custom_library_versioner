## INTRODUCTION

Custom Library Versioner is a quality-of-life module designed to automatically
assign version numbers to custom library assets (CSS and JavaScript files)
based on a CUSTOM_LIBRARY_VERSION file outside of the web root. If the file is
not found, Drupal's core version is used. This ensures that browsers cache-bust
properly when sites are updated across releases, preventing users from seeing
stale assets after deployments.

The primary use case for this module is:

- Automatically version custom theme and module library assets during Drupal
  core updates to force browser cache refreshes
- Maintain consistent versioning across all custom libraries without manual
  intervention in library YAML files
- Ensure project teams don't have to manually update version strings in
  *.libraries.yml files to prepare for releases.

## REQUIREMENTS

This module requires no additional dependencies beyond Drupal core.

## INSTALLATION

Install as you would normally install a contributed Drupal module.
See: https://www.drupal.org/node/895232 for further information.

## CONFIGURATION

No configuration is required. Once enabled, the module automatically:

## MAINTAINERS

Current maintainers:

- Justin Cornell (Cornifex) - https://www.drupal.org/u/cornifex
