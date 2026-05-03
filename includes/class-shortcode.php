<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DLBL_Shortcode {
    public const SHORTCODE = 'team_members';

    public function __construct() {
        add_action( 'init', [ $this, 'register_shortcode' ] );
        add_filter( 'template_include', [ $this, 'include_template' ] );
    }

    public function register_shortcode() {
        add_shortcode( self::SHORTCODE, [ $this, 'render_shortcode' ] );
    }

    public function render_shortcode( array $atts ): string {
        $number           = absint( $atts['number'] ?? 10 );
        $image_position   = sanitize_text_field( $atts['image_position'] ?? 'top' );
        $show_all_button  = wp_validate_boolean( $atts['show_all_button'] ?? true );

        ob_start();

        include DLBL_DIR . 'templates/team-members-list.php';

        return ob_get_clean();
    }

    public function include_template( string $template ): string {
        if ( is_singular( DLBL_Post_Type::POST_TYPE ) ) {
            return DLBL_DIR . 'templates/single-team-member.php';
        }

        if ( is_post_type_archive( DLBL_Post_Type::POST_TYPE ) ) {
            return DLBL_DIR . 'templates/archive-team-members.php';
        }

        return $template;
    }
}