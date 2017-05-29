<?php
/*   pr($post); */
?>

<form class="contact-form">
  <h3>Send an enquiry about <?php echo $post->post_title; ?></h3>
  <input type="hidden" name="project" id="product" value="<?php echo $post->post_title; ?>">
  <input type="hidden" name="nonce" id="nonce" value="<?php echo wp_create_nonce('enquiry'); ?>">
  <label for="from">From:</label>
  <input type="email" name="from" id="from" placeholder="youremail@domain.com"/>
  <label for="copy">Message:</label>
  <textarea name="copy" id="copy"></textarea>
  <input type="submit" value="Send">
</form>
