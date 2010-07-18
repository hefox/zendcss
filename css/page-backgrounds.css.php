/* $Id$ */

/**
 * @file
 * Page Background Styling
 *
 * The default layout method of Zen doesn't give themers equal-height columns.
 * However, equal-height columns are difficult to achieve and totally
 * unnecessary. Instead, use the Faux Columns method described in the following
 * ALA article:
 *   http://www.alistapart.com/articles/fauxcolumns/
 */

<?php
  $selectors = array(
    'body' => 'body',
    'footer' => '#footer',
    'page' => '#page',
    'header' => '#header',
    'header_section' => '#header .section',
    'footer_section' => '#footer .section',
    'main' => '#main',
    'page_wrapper' => '#page-wrapper',
  );
  $colors = dcss('colors');
  if ($colors) {
    foreach($colors as $key => $values) {
      $css = array(
        'selector' => $selectors[$key],
        'styles' => array(),
      );
      foreach($values as $type => $color) { 
        if ($color != '' && $color != 'none') {
          switch($type) {
            case 'font':
              $css['styles']['color'] = $color;
              break;
            case 'background':
              $css['styles']['background-color'] = $color;
            break;
          }
        }
      }
      if ($css['styles']) {
        echo theme('dcss_css', $css);
      }
    }
  }
?>