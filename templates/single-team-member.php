<?php

DLBL_Scripts_And_Styles::enqueue_single_team_member_styles();
get_header();

?>
<main class="dlbl-single">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="dlbl-single-member">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="dlbl-single-image">
					<?php the_post_thumbnail( 'medium' ); ?>
				</div>
			<?php endif; ?>

			<div class="dlbl-single-content">
				<h1 class="dlbl-single-name"><?php echo get_the_title() ?: '(No name)' ?></h1>

				<?php $position = get_post_meta( get_the_ID(), DLBL_Post_Type::JOB_TITLE, true ); ?>
				<p class="dlbl-single-job-title"><?php echo esc_html( $position ) ?: '(No job title)' ?></p>

				<div class="dlbl-single-bio">
					<?php echo get_the_content() ?: '(No bio)'; ?>
				</div>
			</div>

		</article>
	<?php endwhile; ?>
</main>
<?php

get_footer();