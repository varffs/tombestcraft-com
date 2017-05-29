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
      <article class="grid-item item-s-12 item-m-6 item-l-6 margin-bottom-small text-align-center" id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>">
          <div class="card background-yellow">
            <h2 class="font-size-extra font-bold margin-bottom-small"><?php the_title(); ?></h2>
            <?php the_post_thumbnail(); ?>
            <h3 class="font-size-mid margin-top-tiny">Find out more</h3>
          </div>
        </a>
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