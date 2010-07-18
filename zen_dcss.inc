<?php

function zendcss_create_layout_css($info = array(), $default_css = array()) {
  $info += array(
    'width' => dcss('layout-width'),
    'first' => dcss('layout-region-sidebar-first'),
    'second' => dcss('layout-region-sidebar-second'),
  );
  $first_plus_second = dcss_calc($info['first'], $info['second'], 'add');
  $width_minus_first_second =  dcss_calc($info['width'], $first_plus_second, 'subtract');

  $width_minus_second = dcss_calc($info['width'], $info['second'], 'subtract');
  $width_minus_first = dcss_calc($info['width'], $info['first'], 'subtract');
  $csses = array(
    array(
      'selectors' => array(
        '#page-wrapper',
        '.region-page-closure',
      ),
      'styles' => array(
        'margin-left: auto',
        'margin-right: auto',
        'width' => $info['width'],
      )
    ), 
    array(
      'comment' => 'Content',
      'selectors' => array(
        '#content',
        '.no-sidebars #content',
      ),
      'styles' => array(
        'float:left',
        'width' => $info['width'],
        'margin-left: 0',
        'margin-right' => '-' . $info['width'],
        'padding: 0',        
      ),
    ),
    array(
      'selector' => '.sidebar-first #content',
      'styles' => array(
        'width' => $width_minus_first,
        'margin-left' => $info['first'],
        'margin-right' => '-' . $info['width'],      
      ),
    ),
    array(
      'selector' => '.sidebar-second #content',
      'styles' => array(
        'width' => $width_minus_second,
        'margin-left: 0',
        'margin-right' => '-' . $width_minus_second,      
      ),
    ),
    array(
      'selector' => '.two-sidebars #content',
      'styles' => array(
        'width' => $width_minus_first_second,
        'margin-left' => $info['first'],
        'margin-right' => '-' . $width_minus_second,      
      ),
    ),
    array(
      'comment' => 'First sidebar',
      'selector' => '.region-sidebar-first',
      'styles' => array(
        'float: left',
        'width' => $info['first'],
        'margin-left: 0',
        'padding: 0',
        'margin-right' => '-' . $info['first'],
      ),
    ),
    array(
      'comment' => 'Second sidebar',
      'selector' => '.region-sidebar-second',
      'styles' => array(
        'float: left',
        'width' => $info['second'],
        'margin-left' => $width_minus_second,
        'padding: 0',
        'margin-right' => '-' . $info['width'],
      ),
    ),
  );

  $output = '';
  foreach($csses as $css) {
    $css += $default_css;
    $output .= zendcss_format($css);
  }
  return $output;
}

/**
 * Formats css based on array
 */
function zendcss_format($css) {
  // defaults
  $css += array(
    'prepend_selector' => '',
    'comment' => '',
  );
  
  // add comments to css file
  $output = "\n";
  if (!empty($css['comment'])) {
    if (!is_array($css['comment'])) {
      $css['comment'] = array($css['comment']);
    }
    $output .= "\n/**\n * " .  implode("\n * ", $css['comment']) . "\n */\n";
  }
  
  // if a prepend selector, add a space to end of it
  if (!empty($css['prepend_selector'] )) {
     $css['prepend_selector']  .= ' ';
  }
  // output selectors
  $glue = ",\n" . $css['prepend_selector'];
  if (is_array($css['selectors'])) {
    $output .= $css['prepend_selector'] ;
    $output .= implode($glue, $css['selectors']);
  }
  else {
    $output = $css['prepend_selector'] . ' ' . $css['selector'];
  }
  $output .= " { \n";
  
  // output property and values
  foreach ($css['styles'] as $property => $value) {
    if (!is_numeric($property)) {
      $value =  $property . ': ' . $value;
    }
    $output .= '  ' . $value . ";\n";
  }
  $output .= "}\n\n";
  return $output; 
}