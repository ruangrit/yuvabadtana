<?php
/**
 * @file
 * od_preload_features.features.menu_custom.inc
 */

/**
 * Implements hook_menu_default_menu_custom().
 */
function od_preload_features_menu_default_menu_custom() {
  $menus = array();

  // Exported menu: menu-webmaster.
  $menus['menu-webmaster'] = array(
    'menu_name' => 'menu-webmaster',
    'title' => 'Webmaster',
    'description' => '',
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Webmaster');


  return $menus;
}
