<?php

namespace Drupal\custom_library_versioner;

/**
 * Helper class for setting custom library versions.
 */
class CustomLibraryVersionerHelper {

  /**
   * Drupal's root path.
   *
   * @var string
   */
  private string $root;

  /**
   * CustomLibraryVersionHelper constructor.
   *
   * @param string $root
   *   Drupal's root path.
   */
  public function __construct(string $root) {
    $this->root = $root;
  }

  /**
   * Replaces CUSTOM_LIBRARY_VERSION strings with a version number from a file.
   *
   * @param array $libraries
   *   Library definitions from css/js alter hooks.
   */
  public function setVersion(array &$libraries): void {
    $custom_library_version = $this->getCustomLibraryVersionFile();
    foreach ($libraries as &$library) {
      if (!empty($library['version']) && $library['version'] === 'CUSTOM_LIBRARY_VERSION') {
        if (!$custom_library_version) {
          $library['version'] = \Drupal::VERSION;
          continue;
        }
        $library['version'] = $custom_library_version;
      }
    }
  }

  /**
   * Loads the version file from outside the web root.
   *
   * @return false|string
   *   The file path, or false if not found.
   */
  private function getCustomLibraryVersionFile(): false|string {
    $drupal_root_parts = explode('/', $this->root);
    array_pop($drupal_root_parts);
    $path = implode('/', $drupal_root_parts) . '/CUSTOM_LIBRARY_VERSION';
    return file_exists($path) ? trim(file_get_contents($path)) : FALSE;
  }

}
