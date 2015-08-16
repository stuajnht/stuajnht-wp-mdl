<?php get_header(); ?>
<main class="mdl-layout__content">
	<div>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title(); ?></h3>
			<p><em><?php the_time('l, F jS, Y'); ?></em></p>
			<?php the_content(); ?>
		<?php endwhile; else: ?>
			<p><?php _e('Shucks, I\'ve got nothing. Sorry.'); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>