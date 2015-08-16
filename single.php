<?php get_header(); ?>
<div class="single-banner-image" id="banner-image"></div>
<main class="single-main mdl-layout__content">
	<div class="single-container mdl-grid">
		<div class="mdl-cell mdl-cell--1-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
		<div class="single-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--10-col wow fadeInUp">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$bannerImage = get_post_meta(get_the_ID(), 'postBannerImage', true); ?>
				<h3><?php the_title(); ?></h3>
				<div class="single-date mdl-color-text--grey-500">
					<?php the_time('l, F jS, Y'); ?>
				</div>
				<?php the_content(); ?>
			<?php endwhile; else: ?>
				<p><?php _e('Shucks, I\'ve got nothing. Sorry.'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</main>
<script>
	document.getElementById("banner-image").style.backgroundImage = "url(<?php echo $bannerImage; ?>)";
</script>
<?php get_footer(); ?>