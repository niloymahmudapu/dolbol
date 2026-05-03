<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DLBL_Post_Type {

	public const POST_TYPE = 'dlbl_team_member';
	public const JOB_TITLE = 'dlbl_job_title';

	public function __construct() {
		add_action( 'init', [ $this, 'register' ] );
		add_action( 'manage_' . self::POST_TYPE . '_posts_custom_column', [ $this, 'render_columns' ], 10, 2 );
		add_filter( 'manage_' . self::POST_TYPE . '_posts_columns', [ $this, 'change_columns' ] );
		add_filter( 'enter_title_here', [ $this, 'enter_title_placeholder' ] );
		add_filter( 'the_title', [ $this, 'change_no_title_text' ], 10, 2 );
	}

	public function register(): void {
		$args = [
			'labels'      => [
				'name'                  => __( 'Team Members', 'dolbol' ),
				'all_items'             => __( 'All Team Members', 'dolbol' ),
				'add_new_item'          => __( 'Add Team Member', 'dolbol' ),
				'edit_item'             => __( 'Edit Team Member', 'dolbol' ),
				'featured_image'        => __( 'Profile Picture', 'dolbol' ),
				'set_featured_image'    => __( 'Set Profile Picture', 'dolbol' ),
				'remove_featured_image' => __( 'Remove Profile Picture', 'dolbol' ),
				'use_featured_image'    => __( 'Use as Profile Picture', 'dolbol' ),
			],
			'public'      => true,
			'has_archive' => true,
			'rewrite'     => [
				'slug' => 'team-members',
			],
			'supports'    => [ 'title', 'editor', 'thumbnail' ],
			'menu_icon'   => 'dashicons-groups',
		];

		register_post_type( self::POST_TYPE, $args );
	}

	public function render_columns( string $column_name, int $post_id ): void {
		if ( self::JOB_TITLE === $column_name ) {
			$job_title = get_post_meta( $post_id, self::JOB_TITLE, true );
			echo $job_title ?: __( 'N/A', 'dolbol' );
		} else if ( 'thumbnail' === $column_name ) {
			$thumbnail = get_the_post_thumbnail( $post_id, [ 36, 36 ], [
				'style' => 'border-radius: 50%;',
			] );
			echo $thumbnail ?: __( 'N/A', 'dolbol' );
		}
	}

	public function change_columns( array $post_columns ): array {
		$columns = [
			'cb'             => $post_columns['cb'],
			'title'          => __( 'Full name', 'dolbol' ),
			'thumbnail'      => __( 'Profile', 'dolbol' ),
			self::JOB_TITLE  => __( 'Job Title', 'dolbol' ),
			'date'           => $post_columns['date'],
		];

		return $columns;
	}

	public function enter_title_placeholder( string $input ): string {
		if ( self::POST_TYPE === get_post_type() ) {
			return __( 'Enter full name', 'dolbol' );
		}

		return $input;
	}

	public function change_no_title_text( $title, $post_id ) {
		if ( is_admin() && get_post_type( $post_id ) === self::POST_TYPE && empty( $title ) ) {
			return __( '(no name)', 'dolbol' );
		}

		return $title;
	}
}