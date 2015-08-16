<?php get_header(); ?>
<div class="demo-ribbon"></div>
<main class="demo-main mdl-layout__content">
	<div class="demo-container mdl-grid">
		<div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
		<div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col wow fadeInUp">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h3><?php the_title(); ?></h3>
				<div class="demo-crumbs mdl-color-text--grey-500">
					<?php the_time('l, F jS, Y'); ?>
				</div>
				<?php the_content(); ?>
			<?php endwhile; else: ?>
				<p><?php _e('Shucks, I\'ve got nothing. Sorry.'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>