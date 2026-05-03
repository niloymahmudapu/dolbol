<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DLBL_Meta_Box {
    public function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
        add_action( 'save_post', [ $this, 'save_meta_box' ] );
    }

    public function add_meta_box(): void {
        add_meta_box(
            DLBL_Post_Type::JOB_TITLE,
            __( 'Job Title', 'dolbol' ),
            [ $this, 'render_meta_box' ],
            DLBL_Post_Type::POST_TYPE,
            'normal',
            'high'
        );
    }

    public function save_meta_box( int $post_id ): void {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( ! isset( $_POST[ DLBL_Post_Type::JOB_TITLE ] ) ) {
            return;
        }

        $job_title = sanitize_text_field( $_POST[ DLBL_Post_Type::JOB_TITLE ] );
        update_post_meta( $post_id, DLBL_Post_Type::JOB_TITLE, $job_title );
    }

    public function render_meta_box( WP_Post $post ): void {
        $job_title = get_post_meta( $post->ID, DLBL_Post_Type::JOB_TITLE, true );

        ?>
        <div>
            <label for="dlbl_job_title" style="display: block; margin-bottom: 4px;"><?php esc_html_e( 'Job Title', 'dolbol' ); ?></label>
            <input type="text" id="dlbl_job_title" name="dlbl_job_title" value="<?php echo esc_attr( $job_title ); ?>" class="widefat">
        </div>
        <?php
    }
}   