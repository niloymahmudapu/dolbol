<?php

$number          ??= 10;
$image_position  ??= 'top';
$show_all_button ??= true;

$paged  = get_query_var( 'paged' ) ?: 1;

$args = [
    'post_type'      => DLBL_Post_Type::POST_TYPE,
    'posts_per_page' => $number,
    'paged'          => $paged,
];

$query = new WP_Query( $args );

DLBL_Scripts_And_Styles::enqueue_team_members_list_styles();

?>

<div class="dlbl-team-members">
    <?php if ( $query->have_posts() ) : ?>
        <div class="dlbl-team-members-list">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="dlbl-team-member">
                    <?php if ( 'top' === $image_position ) : ?>
                        <a href="<?php the_permalink(); ?>" class="dlbl-team-member-image">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </a>
                    <?php endif; ?>
                    <div class="dlbl-team-member-content">
                        <h3 class="dlbl-team-member-name">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo get_the_title() ?: esc_html__( '(No name)', 'dolbol' ); ?>
                            </a>
                        </h3>
                        <?php $job_title = get_post_meta( get_the_ID(), DLBL_Post_Type::JOB_TITLE, true ); ?>
                        <p class="dlbl-team-member-job-title"><?php echo esc_html( $job_title ) ?: esc_html__( '(No job title)', 'dolbol' ); ?></p>
                        <div class="dlbl-team-member-description">
                            <?php echo wp_trim_words( get_the_content() ?: esc_html__( '(No bio)', 'dolbol' ), 20, '...' ); ?>
                        </div>
                    </div>
                    <?php if ( 'bottom' === $image_position ) : ?>
                        <a href="<?php the_permalink(); ?>" class="dlbl-team-member-image">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="dlbl-team-members-footer">
            <?php if ( false !== $show_all_button ) : ?>
                <a class="dlbl-team-members-see-all" href="<?php echo esc_url( get_post_type_archive_link( DLBL_Post_Type::POST_TYPE ) ); ?>">
                    <?php echo esc_html__( 'See All', 'dolbol' ); ?>
                    <span class="dashicons dashicons-arrow-right-alt"></span>
                </a>
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No team members found.', 'dolbol' ); ?></p>
    <?php endif; ?>
</div>
