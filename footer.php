<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Focus
 */

?>


<footer id="focus-footer" class="site-footer">
  <div class="copyright__wrapper">
    <p class="copyright">Copyright <?php echo date('Y'); ?> | <?php bloginfo( 'name' );?></p>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
