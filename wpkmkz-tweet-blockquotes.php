<?php
/**
 * Plugin Name:       WPkmkz Tweet Blockquotes
 * Plugin URI:        http://wpkamikaze.com/wpkmkz-tweet-blockquotes
 * Description:       Add a blockquote with a tweet button to share on twitter
 * Tags:              widgets, widget, twitter, tweet, blockquote
 * Version:           1.3.3
 * Author:            Kostas Skapator Charal
 * Author URI:        http://wpkamikaze.com
 * Text Domain:       wpkmkz_tb
 * Requires at least: 3.4
 * Tested up to:      3.9.1
 * Stable tag:        1.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/skapator/wpkmkz-tweet-blockquotes
 */

/*
|----------------------------------------------------------------
| Add the editor button
|----------------------------------------------------------------
|
*/
add_action( 'init', 'wpkmkz_tweet_blockquotes_button' );

function wpkmkz_tweet_blockquotes_button() {
    add_filter( "mce_external_plugins", "wpkmkz_add_tweet_blockquotes_button" );
    add_filter( 'mce_buttons', 'wpkmkz_register_tweet_blockquotes_button' );
}

function wpkmkz_add_tweet_blockquotes_button( $plugin_array ) {
    $plugin_array['wpkmkz_tweet_blockquotes'] = plugins_url('tinymce-button/wpkmkz-tweet-blockquotes.js', __FILE__ );
    return $plugin_array;
}

function wpkmkz_register_tweet_blockquotes_button( $buttons ) {
    array_push( $buttons, 'wpkmkz_tweet_blockquotes' );
    return $buttons;
}


/*
|----------------------------------------------------------------
| The shortcode
|----------------------------------------------------------------
|
*/
function wpkmkz_tweetblock_shortcode( $atts, $content="" ) {

  extract( shortcode_atts( array(
    'text' => 0
  ), $atts ) );

  global $post;

  $text = $text ? esc_attr($text) : __('Tweet this', 'wpkmkz_tb');

  wp_register_style( 'tweetblock', plugins_url('css/style.css', __FILE__ ) );
  wp_enqueue_style( 'tweetblock' );

  wp_enqueue_script( 'tweetblock', plugins_url('js/wpkmkz-tweetblock.js', __FILE__ ), array('jquery'), null, true );

  $output  = '<blockquote class="wpkmkz-tweetblock" ';
  $output .= 'data-text="' . $text . '" ';
  $output .= 'data-shorturl="' . esc_url( wp_get_shortlink($post->ID) ) . '" ';
  $output .= '>';
  $output .= $content;
  $output .= '</blockquote>';

  return $output;
}
add_shortcode( 'TWEETBLOCK', 'wpkmkz_tweetblock_shortcode' );