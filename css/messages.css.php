/* $Id$ */

/**
 * @file
 * Message Styling
 *
 * Sensible styling for Drupal's error/warning/status messages.
 */

<?php
  $messages = dcss('messages');
  $css = array(
    'selectors' => array(
      'div.messages',
      'div.status',
      'div.warning',
    ),
    'styles' => array(
      'min-height: 21px',
      'margin: 0 1em 5px 1em',
      'padding: 5px',
      'color' => $messages['default']['color'],
      'background-color' => $messages['default']['background_color'],
      'border' => implode(' ', $messages['default']['border']),
    ),
  );
  if (!empty($messages['use_images'])) {
      $css['styles'][] ="background-image: url(" . dcss_url('../images/messages-status.png', 'zendcss') . ")";
      $css['styles']['padding'] = '5px 5px 5px 35px';
      $css['styles'][] = 'background-position: 5px 5px';
      $css['styles'][] = 'background-repeat: no-repeat';
  }
  echo  theme('dcss_css', $css);
  $css = array(
    'selector' => 'div.warning',
    'styles' => array(
      'border-color' =>  $messages['warning']['border_color'],
    ),
  );
  if (!empty($messages['use_images'])) {
    $css['styles'][] = "background-image: url(" . dcss_url('../images/messages-warning.png', 'zendcss') . ")";
  }
  echo theme('dcss_css', $css);
  
  $css = array(
    'selectors' => array(
      'div.warning',
      'tr.warning',
    ),
    'styles' => array(
      'color' => $messages['warning']['color'],
      'background-color' => $messages['warning']['background_color'],
    ),
  );
  echo theme('dcss_css', $css);
  
  $css = array(
    'selector' => 'div.error',
    'styles' => array(
      'border-color' =>  $messages['error']['border_color'],
    ),
  );
  if (!empty($messages['use_images'])) {
    $css['styles'][] = "background-image: url(" . dcss_url('../images/messages-error.png', 'zendcss') . ")";
  }
  echo theme('dcss_css', $css);
  
  $css = array(
    'selectors' => array(
      'div.error',
      'tr.error',
    ),
    'styles' => array(
      'color' => $messages['error']['color'],
      'background-color' => $messages['error']['background_color'],
    ),
  );
  echo theme('dcss_css', $css);
?>

div.messages ul {
  margin-top: 0;
  margin-bottom: 0;
}
