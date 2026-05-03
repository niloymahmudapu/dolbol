<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DLBL_Scripts_And_Styles {
    public const TEAM_MEMBERS_LIST_STYLE = 'dlbl-team-members-list';
    public const SINGLE_TEAM_MEMBER_STYLE = 'dlbl-single-team-member';

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ self::class, 'register_scripts_and_styles' ] );
    }

    public static function register_scripts_and_styles(): void {
        wp_register_style( self::TEAM_MEMBERS_LIST_STYLE, DLBL_URL . 'assets/css/team-members-list.css', [], DLBL_VERSION );
        wp_register_style( self::SINGLE_TEAM_MEMBER_STYLE, DLBL_URL . 'assets/css/single-team-member.css', [], DLBL_VERSION );
    }

    public static function enqueue_team_members_list_styles(): void {
        wp_enqueue_style( self::TEAM_MEMBERS_LIST_STYLE );
    }

    public static function enqueue_single_team_member_styles(): void {
        wp_enqueue_style( self::SINGLE_TEAM_MEMBER_STYLE );
    }
}