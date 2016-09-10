<?php get_header(); ?>

<div class="mdl-grid">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <!-- Cell -->
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp">
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Welcome</h2>
      </div>
      <div class="mdl-card__supporting-text">
        The Sky Tower is an observation and telecommunications tower located in Auckland, New Zealand. It is 328 metres (1,076 ft) tall, making it the tallest man-made structure in the Southern Hemisphere.
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
            Read More
          </a>
      </div>
      <div class="mdl-card__menu">
        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
            <i class="material-icons">share</i>
          </button>
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