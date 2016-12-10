  <!-- End main content -->
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
      <?php if ( has_nav_menu( 'footer-social-menu' ) ) { // Check for footer social menu 
              wp_nav_menu( array(
                                  'theme_location' => 'footer-social-menu',
                                  'container_class' => 'mdl-mini-footer__right-section',
                                  'fallback_cb' => '',
                                  'items_wrap' => '%3$s',
                                  'walker' => new stuajnht_wp_mdl_walker_nav_footer_social_Menu
                                ) );
            } // End of check for footer social menu ?>
    </footer>
  <?php } // End of check for footer main menu ?>

    <!-- Toast message container -->
    <div id="snackbarToastContainer" class="mdl-js-snackbar mdl-snackbar">
      <div class="mdl-snackbar__text"></div>
      <button id="snackbarToastButton" class="mdl-snackbar__action" type="button"></button>
    </div>

    <?php wp_footer(); ?>
    </div><!-- End of navigation bar -->
	</body>
</html>