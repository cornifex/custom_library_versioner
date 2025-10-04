<?php

namespace Drupal\custom_theme_library_versioner;

use Drupal\Core\Asset\LibraryDiscoveryParser as CoreLibraryDiscoveryParser;

/**
 * Custom Library Discovery Parser.
 */
class LibraryDiscoveryParser extends CoreLibraryDiscoveryParser {

  public function buildByExtension($extension) {
    $libraries = parent::buildByExtension($extension);
    foreach ($libraries as &$library) {
      if (!empty($library['version']) && $library['version'] === 'CUSTOM_LIBRARY_VERSION') {
        $custom_library_version = $this->getCustomLibraryVersionFile();
        if (!$custom_library_version) {
          unset($library['version']);
          continue;
        }
        $library['version'] = $custom_library_version;
      }
    }
    return $libraries;
  }

  private function getCustomLibraryVersionFile() {
    $drupal_root_parts = explode('/', $this->root);
    array_pop($drupal_root_parts);
    $path = implode('/', $drupal_root_parts) . '/CUSTOM_LIBRARY_VERSION';
    return file_exists($path) ? trim(file_get_contents($path)) : FALSE;
  }

}
