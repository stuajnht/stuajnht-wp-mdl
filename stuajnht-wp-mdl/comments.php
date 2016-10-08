<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
<?php endif; ?>

<?php
// Setting up RelativeTime, to display comments as x months ago
require 'lib/RelativeTime/Autoload.php';
$relativeTime = new \RelativeTime\RelativeTime(array('truncate' => 2));
?>

<?php if(!empty($post->post_password)) : ?>
	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	<?php endif; ?>
<?php endif; ?>

<div class="mdl-grid mdl-color--grey-200">
  <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
  <div class="single-post__comments-title">
    <a name="comments"></a>
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
      <div class="comments">
        <?php foreach($comments as $comment) : ?>
        <div class="comment" id="comment-<?php comment_ID(); ?>">
          <?php if ($comment->comment_approved == '0') : ?>
            <p>Your comment is awaiting approval</p>
          <?php endif; ?>
          <header class="comment__header">
            <img src="<?php echo get_avatar_url(get_comment_author_email()); ?>" class="comment__avatar">
            <div class="comment__author">
              <strong><?php echo get_comment_author(); ?></strong>
              <span class="comment__date"><?php
                    $commentDateTime = get_comment_date('Y-m-d') . " " . get_comment_time('h:i:s');
                    echo '<abbr title="' . $commentDateTime . '">' . $relativeTime->timeAgo($commentDateTime) . '</abbr>';
                    ?></span>
            </div>
          </header>
          <div class="comment__text">
            <?php comment_text(); ?>
          </div>
          <nav class="comment__actions">
          </nav>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
      <p>No comments yet</p>
    <?php endif; ?>

    <?php if(comments_open()) : ?>
      <?php if(get_option('comment_registration') && !$user_ID) : ?>
        <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>
        <div class="single-post__comments-form__container">
          <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="single-post__comments-form__contents">
            <?php if($user_ID) : ?>
              <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php" class="mdl-chip mdl-chip--contact">
                <img class="mdl-chip__contact" src="<?php echo get_avatar_url($user_ID); ?>"></img>
                <span class="mdl-chip__text"><?php echo $user_identity; ?></span>
              </a>
              <p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
            <?php else : ?>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label single-post__comments-form__textfield">
                <input class="mdl-textfield__input" type="text" id="author" value="<?php echo $comment_author; ?>" tabindex="1">
                <label class="mdl-textfield__label" for="author">Name<?php if($req) echo " (required)"; ?></label>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label single-post__comments-form__textfield">
                <input class="mdl-textfield__input" type="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2">
                <label class="mdl-textfield__label" for="email">Email address (will not be published)<?php if($req) echo " (required)"; ?></label>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label single-post__comments-form__textfield">
                <input class="mdl-textfield__input" type="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3">
                <label class="mdl-textfield__label" for="url">Website</label>
              </div>
            <?php endif; ?>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label single-post__comments-form__textfield">
              <textarea class="mdl-textfield__input" type="text" name="comment" id="comment" rows="6" tabindex="4"></textarea>
              <label class="mdl-textfield__label" for="comment">Comment</label>
            </div>
            <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" />
            <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
            <?php do_action('comment_form', $post->ID); ?>
          </form>
        </div>
      <?php endif; ?>
    <?php else : ?>
      <p>The comments are closed.</p>
    <?php endif; ?>
  </div>
</div>