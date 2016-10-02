<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
<?php endif; ?>

<?php if(!empty($post->post_password)) : ?>
	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	<?php endif; ?>
<?php endif; ?>

<div class="mdl-grid mdl-color--grey-200">
  <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
  <div class="single-post__comments-title">
    <span class="single-post__comments-title__title-text">
      <?php if ( have_comments() ) :
        printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title'), get_comments_number() );
      else :
        echo 'No Comments';
      endif; ?>
    </span>
  </div>
</div>
<div class="mdl-grid mdl-color--grey-200">
  <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
  <div class="mdl-color--white mdl-shadow--4dp mdl-color-text--grey-800 mdl-cell mdl-cell--8-col single-post__comments-content">
    <?php if($comments) : ?>
      <ol>
        <?php foreach($comments as $comment) : ?>
        <li id="comment-<?php comment_ID(); ?>">
          <?php if ($comment->comment_approved == '0') : ?>
            <p>Your comment is awaiting approval</p>
          <?php endif; ?>
          <?php comment_text(); ?>
          <cite><?php comment_type(); ?> by <?php comment_author_link(); ?> on <?php comment_date(); ?> at <?php comment_time(); ?></cite>
        </li>
      <?php endforeach; ?>
      </ol>
    <?php else : ?>
      <p>No comments yet</p>
    <?php endif; ?>

    <?php if(comments_open()) : ?>
      <?php if(get_option('comment_registration') && !$user_ID) : ?>
        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
          <?php if($user_ID) : ?>
            <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
          <?php else : ?>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="author" value="<?php echo $comment_author; ?>" tabindex="1">
              <label class="mdl-textfield__label" for="author">Name<?php if($req) echo " (required)"; ?></label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2">
              <label class="mdl-textfield__label" for="email">Email address (will not be published)<?php if($req) echo " (required)"; ?></label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3">
              <label class="mdl-textfield__label" for="url">Website</label>
          <?php endif; ?>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <textarea class="mdl-textfield__input" type="text" name="comment" id="comment" rows="6" tabindex="4"></textarea>
            <label class="mdl-textfield__label" for="comment">Comment</label>
          </div>
          <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
          <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
          <?php do_action('comment_form', $post->ID); ?>
        </form>
      <?php endif; ?>
    <?php else : ?>
      <p>The comments are closed.</p>
    <?php endif; ?>
  </div>
</div>