<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
<?php endif; ?>

<?php if(!empty($post->post_password)) : ?>
	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
	<?php endif; ?>
<?php endif; ?>

<div class="mdl-grid mdl-color--grey-200">
  <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
  <div class="mdl-color--white mdl-shadow--4dp mdl-color-text--grey-800 mdl-cell mdl-cell--8-col single-post__page-comments">
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
  </div>
</div>

<?php if(comments_open()) : ?>
	<?php if(get_option('comment_registration') && !$user_ID) : ?>
	<?php else : ?>
		<?php if($user_ID) : ?>
		<?php else : ?>
		<?php endif; ?>
	<?php endif; ?>
<?php else : ?>
<?php endif; ?>