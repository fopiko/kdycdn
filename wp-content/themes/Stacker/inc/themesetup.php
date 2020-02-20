<?php
// Theme Specific Settings

// Custom Backgrounds
function themefurnace_register_custom_background()
{
	$args = array(
		'default-color' => '#f5f5f5',
		'default-image' => '',
	);

	$args = apply_filters( 'themefurnace_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( !empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background' );
	}
}

add_action( 'after_setup_theme', 'themefurnace_register_custom_background' );


function load_theme_fonts()
{
	$heading = get_theme_mod( 'google_fonts_heading_font' );
	$body = get_theme_mod( 'google_fonts_body_font' );
	if ( ( !empty( $heading ) && $heading != 'none' ) || ( !empty( $body ) && $body != 'none' ) ) {
		echo '<style type="text/css">';
		$imports = array();
		$styles = array();
		if ( !empty( $heading ) && $heading != 'none' ) {
			$imports[] = '@import url(//fonts.googleapis.com/css?family=' . urlencode( $heading ) . ');';
			$styles[] = 'h1, h2, h3, h4, h5, h6 { font-family: "' . $heading . '" !important }';
		}
		if ( !empty( $body ) && $body != 'none' ) {
			$imports[] = '@import url(//fonts.googleapis.com/css?family=' . urlencode( $body ) . ');';
			$styles[] = 'body, .itemdate, .tagline { font-family: "' . $body . '" !important }';
		}

		echo implode( "\r\n", $imports );
		echo implode( "\r\n", $styles );
		echo '</style>';

	}
}

// load colors
function load_theme_colors()
{
	$backgroundColor = get_theme_mod( 'background_color', '#f5f5f5;' );
	$contentColor = get_theme_mod( 'themefurnace_content_color', '#ffffff;' );
	$headingsColor = get_theme_mod( 'themefurnace_headings_color', '#141414;' );
	$footerHeadingsColor = get_theme_mod( 'themefurnace_footer_headings_color', '#fff;' );
	$textColor = get_theme_mod( 'themefurnace_text_color', '#8b8989;' );
	$footerTextColor = get_theme_mod( 'themefurnace_footer_text_color', '#8a8a8a;' );
	$headerTextColor = get_theme_mod( 'themefurnace_header_text_color', '#b8b4b4;' );
	$headerBackgroundColor = get_theme_mod( 'themefurnace_header_color', '#ffffff;' );
	$headerMenuColor = get_theme_mod( 'themefurnace_menu_color', '#a2a2a2;' );
	$headerMenuBackgroundColor = get_theme_mod( 'themefurnace_menu_background_color', '#f9f9f9;' );
	$linkColor = get_theme_mod( 'themefurnace_link_color', '#b8b4b4;' );
	$footerColor = get_theme_mod( 'themefurnace_footer_color', '#292e32;' );

	echo '<style type="text/css">';

	if ( !empty( $backgroundColor ) ) {
		$hash = '';
		if ( strpos( $backgroundColor, '#' ) === false ) {
			$hash = '#';
		}
		echo 'body { background-color: ' . $hash . $backgroundColor . '}';
	}

	if ( !empty( $contentColor ) ) {
		$hash = '';
		if ( strpos( $contentColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '#posts .container, #content, .masonry > .item, .inside.item { background-color: ' . $hash . $contentColor . '}';
		echo '.item img { border-color: ' . $hash . $contentColor . '}';
	}

	if ( !empty( $headingsColor ) ) {
		$hash = '';
		if ( strpos( $headingsColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '.site-title a, .itemtitle a, #content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { color: ' . $hash . $headingsColor . ' !important }';
	}

	if ( !empty( $footerHeadingsColor ) ) {
		$hash = '';
		if ( strpos( $footerHeadingsColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '.footerheading, #footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, .footer-title a { color: ' . $hash . $footerHeadingsColor . ' !important }';
	}

	if ( !empty( $textColor ) ) {
		$hash = '';
		if ( strpos( $textColor, '#' ) === false ) {
			$hash = '#';
		}
		echo 'body { color: ' . $hash . $textColor . '}';
	}

	if ( !empty( $footerTextColor ) ) {
		$hash = '';
		if ( strpos( $footerTextColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '#footer, .footertext { color: ' . $hash . $footerTextColor . '}';
	}

	if ( !empty( $headerTextColor ) ) {
		$hash = '';
		if ( strpos( $headerTextColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '.tagline { color: ' . $hash . $headerTextColor . '}';
	}

	if ( !empty( $headerBackgroundColor ) ) {
		$hash = '';
		if ( strpos( $headerBackgroundColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '#header { background: ' . $hash . $headerBackgroundColor . '}';
	}

	if ( !empty( $headerMenuColor ) ) {
		$hash = '';
		if ( strpos( $headerMenuColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '#cssmenu > ul li a { color: ' . $hash . $headerMenuColor . ' !important }';
		echo '#cssmenu .menu > ul li a { color: ' . $hash . $headerMenuColor . ' !important }';
		echo ' li.menu-item-has-children > a:before, li.menu-item-has-children > a:after { background-color: ' . $hash . $headerMenuColor . ' !important}';
		echo ' li.page_item_has_children > a:before, li.page_item_has_children > a:after { background-color: ' . $hash . $headerMenuColor . ' !important}';
	}

	if ( !empty( $headerMenuBackgroundColor ) ) {
		$hash = '';
		if ( strpos( $headerMenuBackgroundColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '#cssmenu { background-color: ' . $hash . $headerMenuBackgroundColor . ' !important }';
	}

	if ( !empty( $linkColor ) ) {
		$hash = '';
		if ( strpos( $linkColor, '#' ) === false ) {
			$hash = '#';
		}
		echo ' a, #footerwidgets a { color: ' . $hash . $linkColor . ' !important }';
	}

	if ( !empty( $footerColor ) ) {
		$hash = '';
		if ( strpos( $footerColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '#footer { background-color: ' . $hash . $footerColor . '}';
	}

	echo '</style>';
}

function load_homepage_column_count()
{
	$column_count = get_theme_mod( 'themefurnace_homepage_columns', '3' );
	echo '<style>';
	echo '@media only screen and (min-width: 1100px) {
    .masonry { column-count: ' . $column_count . '; -webkit-column-count: ' . $column_count . '; -moz-column-count: ' . $column_count . '}}';
	echo '</style>';
}