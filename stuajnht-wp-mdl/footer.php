  <?php if ( has_nav_menu( 'footer-main-menu' ) ) { // Check for footer main menu ?>
    <footer class="mdl-mini-footer">
      <div class="mdl-mini-footer__left-section">
        <div class="mdl-logo">
          <?php bloginfo('name'); ?>
        </div>
        <?php wp_nav_menu( array(
                                  'theme_location' => 'footer-main-menu',
                                  'menu_class' => 'mdl-mini-footer__link-list',
                                  'container' => '',
                                  'fallback_cb' => ''
                                ) ); ?>
      </div>
      <?php if ( has_nav_menu( 'footer-social-menu' ) ) { // Check for footer social menu ?>
      <!--<div class="mdl-mini-footer__right-section">
        <button class="mdl-mini-footer__social-btn"></button>
        <button class="mdl-mini-footer__social-btn"></button>
        <button class="mdl-mini-footer__social-btn"></button>
      </div>-->
      <?php wp_nav_menu( array(
                                  'theme_location' => 'footer-social-menu',
                                  'container_class' => 'mdl-mini-footer__right-section',
                                  'fallback_cb' => '',
                                  'walker' => new stuajnht_wp_mdl_walker_nav_footer_social_Menu
                                ) ); ?>
      <?php } // End of check for footer social menu ?>
    </footer>
  <?php } // End of check for footer main menu ?>

    <?php wp_footer(); ?>
	</body>
</html>