/* $Id$ */

/**
 * @file
 * HTML Element Styling
 *
 * Ok, I admit it. I fooled you. This isn't a "reset" stylesheet. Instead this
 * is the place where you should set (not reset) the default styling for all
 * HTML elements.
 *
 * @see http://meiert.com/en/blog/20080419/reset-style-sheets-are-bad/
 * @see http://snook.ca/archives/html_and_css/no_css_reset/
 */


/*
 * Fonts
 *
 * Our font size and line height declarations are based on the following ALA
 * article:
 *   http://www.alistapart.com/articles/howtosizetextincss
 *
 * All modern browsrs use a 16px default font size. Specifying the font-size
 * and line-height in ems (relative to the 16px default font) allows the user
 * to resize the font in the browser and produces the most consistent results
 * across different browsers.
 */
body {
  font-size: 100%; /* Fixes exaggerated text resizing in IE6 and IE7 */
}

<?php
$defaults = dcss('defaults');
  // convert px to em
  if (strpos( $defaults['page_font'], 'px')) {
    $page_font = str_replace('px', '', $defaults['page_font']);
    $line_height = ($page_font + 4) / $page_font . 'em'; 
    $page_font = $page_font / 16 . 'em';
  } else {
    $page_font = $defaults['page_font'];
    $line_height = 'inherit';
  }
  echo theme('dcss_css', array(
    'selectors' => array(
      '#skip-link',
      '#page',
    ),
    'styles' => array(
      'font-size' => $page_font,
      'line-height' => $line_height,
    ),
  ));
?>

body,
caption,
th,
td,
input,
textarea,
select,
option,
legend,
fieldset {
  font-family: <?php echo $defaults['font_family'] ?>;
}

pre,
code {
  font-size: 1.1em; /* Monospace fonts can be hard to read */
  font-family: <?php echo $defaults['code_font_family'] ?>;
}

/*
 * Headings
 */
h1 {
  font-size: 2em;
  line-height: 1.3em;
  margin-top: 0;
  margin-bottom: 0.5em; /* 0.5em is equavalent to 1em in the page's base font.
                           Remember, a margin specified in ems is relative to
                           the element's font-size, not to the pages' base
                           font size. So, for example, if we want a 1em margin
                           (relative to the base font), we have to divide that
                           length by the element's font-size:
                           1em / 2em = 0.5em */
}

h2 {
  font-size: 1.5em;
  line-height: 1.3em;
  margin-top: 0.667em; /* Equivalent to 1em in the page's base font: 1 / 1.5 = 0.667em */
  margin-bottom: 0.667em;
}

h3 {
  font-size: 1.3em;
  line-height: 1.3em;
  margin-top: 0.769em; /* Equivalent to 1em in the page's base font: 1 / 1.3 = 0.769 */
  margin-bottom: 0.769em;
}

h4,
h5,
h6 {
  font-size: 1.1em;
  line-height: 1.3em;
  margin-top: 0.909em; /* Equivalent to 1em in the page's base font: 1 / 1.1 = 0.909 */
  margin-bottom: 0.909em;
}

/*
 * Block-level elements
 */
p,
ul,
ol,
dl,
pre,
table,
fieldset {
  margin: 1em 0;
}

blockquote {
  margin: 1em 2em;
}

/*
 * Lists
 *
 * We need to standardize the list item indentation.
 */
ul,
ol {
  margin-left: 0;
  padding-left: 2em; /* LTR */
}

.block ul,
.item-list ul /* Drupal overrides */ {
  margin: 1em 0;
  padding: 0 0 0 2em; /* LTR */
}

ul ul, ul ol,
ol ol, ol ul,
.block ul ul, .block ul ol,
.block ol ol, .block ol ul,
.item-list ul ul, .item-list ul ol,
.item-list ol ol, .item-list ol ul {
  margin: 0;
}

li {
  margin: 0;
  padding: 0;
}

.item-list ul li /* Drupal override */ {
  margin: 0;
  padding: 0;
  list-style: inherit;
}

ul.menu li,
li.expanded,
li.collapsed,
li.leaf /* Drupal override */ {
  margin: 0;
  padding: 0;
}

ul          { list-style-type: disc; }
ul ul       { list-style-type: circle; }
ul ul ul    { list-style-type: square; }
ul ul ul ul { list-style-type: circle; }
ol          { list-style-type: decimal; }
ol ol       { list-style-type: lower-alpha; }
ol ol ol    { list-style-type: decimal; }

dt {
  margin: 0;
  padding: 0;
}

dd {
  margin: 0 0 0 2em;
  padding: 0;
}

/*
 * Links
 *
 * The order of link states are based on Eric Meyer's article:
 * http://meyerweb.com/eric/thoughts/2007/06/11/who-ordered-the-link-states
 */
<?php
  $links = dcss('links');
  foreach(array('link', 'visited', 'hover_focus' => array('a:hover','a:focus'), 'active') as $key => $selector) {
    $css = array('styles' => array());
    if (is_array($selector)) {
      $css['selectors'] = $selector;
    } else {
      $css['selector'] = 'a:' . $selector;
      $key = $selector;
    }
    if (!empty($links[$key]['color'])) {
      $css['styles']['color'] = $links[$key]['color'];
    }
    if (!empty($links[$key]['text_decoration'])) {
      $css['styles']['text-decoration'] = $links[$key]['text_decoration'];
    }
    if (!empty($css['styles'])) {
      echo theme('dcss_css', $css);
    }
  }
?>

/*
 * Tables
 *
 * Drupal provides table styling which is only useful for its admin section
 * forms, so we override this default CSS. (We set it back in forms.css.)
 */
table {
  border-collapse: collapse;
  /* width: 100%; */ /* Prevent cramped-looking tables */
}

th,
thead th,
tbody th {
  text-align: left; /* LTR */
  padding: 0;
  border-bottom: none;
}

tbody {
  border-top: none;
}

/*
 * Abbreviations
 */
abbr {
  border-bottom: 1px dotted #666;
  cursor: help;
  white-space: nowrap;
}

abbr.created /* Date-based "abbreviations" show computer-friendly timestamps which are not human-friendly. */ {
  border: none;
  cursor: auto;
  white-space: normal;
}

/*
 * Images
 */
img {
  border: 0;
}

/*
 * Horizontal rules
 */
hr {
  height: 1px;
  border: 1px solid #666;
}

/*
 * Forms
 */
form {
  margin: 0;
  padding: 0;
}

fieldset {
  margin: 1em 0;
  padding: 0.5em;
}
