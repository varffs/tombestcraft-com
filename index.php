<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div id="masonry-container" class="grid-row">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
      <article class="grid-item item-s-12 item-m-6 item-l-4 margin-bottom-small text-align-center" id="post-<?php the_ID(); ?>">
        <div class="card background-yellow">
          <?php the_post_thumbnail('l-4'); ?>
          <div class="gallery-caption">
            <h4><?php the_title(); ?></h4>
            <div class="font-smaller">
              <?php echo $post->post_content; ?>
            </div>
          </div>
        </div>
      </article>
<?php
  }
} else {
?>
      <article class="grid-item item-s-12 item-m-6 item-l-4 margin-bottom-small text-align-center">
        <?php _e('Sorry nothing found'); ?>
      </article>
<?php
} ?>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>