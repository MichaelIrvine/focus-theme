<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Focus
 */

get_header();
?>

<div id="page__gallery" class="content-area page__work-wrapper">
	<?php
	$images = get_field('work_page_gallery');

	if( get_field('toggle_lightbox') ):
		if( $images ): ?>
				<div class="gallery-grid__lightbox">
						<?php foreach( $images as $image ): ?>
								<figure class="gallery-item">
									<img class="lazy gallery-item--image" 
									data-src="<?php echo esc_url($image['url']); ?>" 
									data-caption="<?php echo esc_html($image['caption']); ?>"
									alt="<?php echo esc_attr($image['alt']); ?>" 
									/>
									<figcaption class="gallery-item--caption hidden">
										<?php echo esc_html($image['caption']); ?>
										<button class="close-lightbox">
											X
										</button>
									</figcaption>
								</figure>
						<?php endforeach; ?>
				</div>
		<?php endif; 
	else : 
		if( $images ): ?>
			<div class="gallery-grid">
					<?php foreach( $images as $image ): ?>
							<figure class="gallery-item">
								<img class="lazy gallery-item--image" 
								data-src="<?php echo esc_url($image['url']); ?>" 
								data-caption="<?php echo esc_html($image['caption']); ?>"
								alt="<?php echo esc_attr($image['alt']); ?>" 
								/>
								<figcaption class="gallery-item--caption">
									<?php echo esc_html($image['caption']); ?>
								</figcaption>
							</figure>
					<?php endforeach; ?>
			</div>
	<?php endif;
	endif;
	?>

</div>
<?php
get_footer();
