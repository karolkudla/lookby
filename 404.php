<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package siteorigin-corp
 * @license GPL 2.0 
 */

get_header(); ?>

<?php wp_redirect( home_url() ); exit; ?>

<?php
get_footer();
