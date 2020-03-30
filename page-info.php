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

<div id="page__info" class="content-area page__info-wrapper">
	<div class="page__col page__info-col-1">
		<?php
		$image = get_field('info_content_image');
		if (!empty($image)) : ?>
			<img class="page__info--image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
		<?php endif; ?>
	</div>
	<div class="page__col page__info-col-2">
		<div class="info-col-2__paragraph-1 copy">
			<?php the_field('info_content_column_1'); ?>
		</div>
		<div class="info-col-2__paragraph-2 copy">
			<?php the_field('info_content_column_2'); ?>
			<?php if (get_field('info_content_column_3_social_media')) : ?>
				<ul class="paragraph-2__social-media-links">
					<?php while (has_sub_field('info_content_column_3_social_media')) : ?>
						<li class="social-media-link__item">
							<a class="social-media-link" href="<?php the_sub_field('social_media_link'); ?>">
								<p><?php the_sub_field('social_media_title'); ?></p>
							</a>
					</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>

	</div>
</div>

<?php
get_footer();
