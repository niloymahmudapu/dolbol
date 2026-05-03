<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

DLBL_Scripts_And_Styles::enqueue_team_members_list_styles();
?>

<div class="dlbl-team-members" style="max-width:1024px; margin: 0 auto; padding: 2rem;">
    <header class="page-header" style="text-align: center; margin-bottom: 2rem;">
        <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="dlbl-team-members-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="dlbl-team-member">
                    <a href="<?php the_permalink(); ?>" class="dlbl-team-member-image">
                        <?php the_post_thumbnail( 'medium' ); ?>
                    </a>
                    
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
                </div>
            <?php endwhile; ?>
        </div>
        
        <div class="dlbl-team-members-footer">
            <div class="dlbl-team-members-pagination">
                <?php
                global $wp_query;
                
                if ( $wp_query->max_num_pages > 1 ) {
                    echo paginate_links( [
                        'total'   => $wp_query->max_num_pages,
                        'current' => max( 1, get_query_var( 'paged' ) ),
                    ] );
                }
                ?>
            </div>
        </div>
    <?php else : ?>
        <p><?php esc_html_e( 'No team members found.', 'dolbol' ); ?></p>
    <?php endif; ?>
</div>

<?php
get_footer();
