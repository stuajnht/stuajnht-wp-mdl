<?php get_header(); ?>

<div class="mdl-grid">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <!-- Cell -->
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp">
      <div class="mdl-card__title"<?php
              // Setting the card post image to that of the blog post
              if (has_post_thumbnail()) {
                // Note: This seems hacky. The "the_post_thumbnail_url()" always seems to
                //       echo out the output, so can't be saved into a variable. Creating
                //       the background-image url around it is the only way to get it to work
                echo " style=\"background-image: url('";
                  the_post_thumbnail_url();
                echo "');\"";
              }
           ?>>
        <h2 class="mdl-card__title-text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
      <div class="mdl-card__supporting-text">
        Posted on <?php the_date(get_option('date_format')); ?>
      </div>
      <div class="mdl-card__supporting-text">
        <?php the_excerpt(); ?>
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="<?php the_permalink(); ?>">
            Read More
          </a>
      </div>
    </div>
  <!-- End Cell -->
  <?php endwhile; else : ?>
    <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Well, this isn't quite right&hellip;</h2>
      </div>
      <div class="mdl-card__supporting-text">
        I'm sorry. I looked everywhere I could, but there doesn't seem to be any posts. Perhaps a friendly email to the webmaster may get things rolling?
      </div>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>