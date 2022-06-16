  <footer id="footer" class="container text-align-center margin-top-basic margin-bottom-small">
    <?php
      wp_nav_menu(
        array(
          'theme_location' => 'footer',
          'fallback_cb' => false
        )
      ); ?>
  </footer>

</section>

<?php
  get_template_part('partials/scripts');
  get_template_part('partials/schema-org');
?>

</body>
</html>