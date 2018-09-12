<?php
/**
 * Data sanitization functions
 *
 * @package dream
 */

// URL (esc_url)
function dream_sanitize_url($input) {
  return esc_url_raw($input);
}

// Number field (intval)
function dream_sanitize_number_intval($input) {
  if (is_numeric($input) && $input >= 1) {
    return intval($input);
  } else {
    return '';
  }
}

// Checkbox
function dream_sanitize_checkbox( $input ){
  if ( $input == 1 || $input == 'true' || $input === true ) {
    return 1;
  } else {
    return 0;
  }
}

// Blog pagination
function dream_sanitize_blog_pagination( $input ) {
  if ( ! in_array( $input, array( 'pagination', 'navigation' ) ) ) {
    $input = 'pagination';
  }
  return $input;
}

// Blog layout
function dream_sanitize_blog_layout($input) {
  $valid = array(
    'right_sidebar' => 'Right sidebar',
    'left_sidebar' => 'Left sidebar',
    'one_column' => 'One column',
  );
  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'right_sidebar';
  }
}

// Excerpt / Read more tag
function dream_sanitize_blog_excerpt_type($input) {
  $valid = array(
    'excerpt' => 'Excerpt',
    'more-tag' => 'Read More tag',
  );
  if (array_key_exists($input, $valid)) {
    return $input;
  } else {
    return 'excerpt';
  }
}
