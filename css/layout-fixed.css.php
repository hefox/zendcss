/* $Id$ */

/**
 * @file
 * Layout Styling (DIV Positioning)
 *
 * Define CSS classes to create a table-free, 3-column, 2-column, or single
 * column layout depending on whether blocks are enabled in the left or right
 * columns.
 *
 * This layout is based on the Zen Columns layout method.
 *   http://drupal.org/node/201428
 *
 * Only CSS that affects the layout (positioning) of major elements should be
 * listed here.  Such as:
 *   display, position, float, clear, width, height, min-width, min-height
 *   margin, border, padding, overflow
 */

<?php
// call the create layout for default settings
echo zendcss_create_layout_css();

?>

.region-header {
  clear: both; /* Clear the logo */
}

/*
 * Main (container for everything else)
 */
#main-wrapper {
  position: relative;
}


#content .section {
  margin: 0;
  padding: 0;
}

/*
 * Navigation
 */
#navigation {
  float: left; /* LTR */
  width: 100%;
  margin-left: 0; /* LTR */
  margin-right: -100%; /* LTR */ /* Negative value of #navigation's width + left margin. */
  padding: 0; /* DO NOT CHANGE. Add padding or margin to #navigation .section. */
  height: 2.3em; /* The navigation can have any arbritrary height. We picked one
                    that is the line-height plus 1em: 1.3 + 1 = 2.3
                    Set this to the same value as the margin-top below. */
}

.with-navigation #content,
.with-navigation .region-sidebar-first,
.with-navigation .region-sidebar-second {
  margin-top: 2.3em; /* Set this to the same value as the navigation height above. */
}

#navigation .section {
}

#navigation ul /* Primary and secondary links */ {
  margin: 0;
  padding: 0;
  text-align: left; /* LTR */
}

#navigation li /* A simple method to get navigation links to appear in one line. */ {
  float: left; /* LTR */
  padding: 0 10px 0 0; /* LTR */
}

/*
 * First sidebar
 */

.region-sidebar-first .section {
  margin: 0 20px 0 0; /* LTR */
  padding: 0;
}

/*
 * Second sidebar
 */

.region-sidebar-second .section {
  margin: 0 0 0 20px; /* LTR */
  padding: 0;
}

/*
 * Prevent overflowing content
 */
#header,
#content,
#navigation,
.region-sidebar-first,
.region-sidebar-second,
#footer,
.region-page-closure {
  overflow: visible;
  word-wrap: break-word; /* A very nice CSS3 property */
}

#navigation {
  overflow: hidden; /* May need to be removed if using a dynamic drop-down menu */
}

/*
 * If a div.clearfix doesn't have any content after it and its bottom edge
 * touches the bottom of the viewport, Firefox and Safari will mistakenly
 * place several pixels worth of space between the bottom of the div and the
 * bottom of the viewport. Uncomment this CSS property to fix this.
 * Note: with some over-large content, this property might cause scrollbars
 * to appear on the #page-wrapper div.
 */
/*
#page-wrapper {
  overflow-y: hidden;
}
*/
