<?php
/* Template Name: Video Page */
get_header();
?>
<main id="main-content">
  <section id="posts">
    <div class="container">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
      <article class="grid-row" id="post-<?php the_ID(); ?>">
        <div class="grid-item item-s-12 item-m-12">
          <div class="card background-yellow">
            <?php the_content(); ?>
          </div>
        </div>
      </article>
<?php
  }
} else {
?>
      <div class="grid-row">
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
      </div>
<?php
} ?>
    </div>
  </section>
</main>
<?php
get_footer();
?>