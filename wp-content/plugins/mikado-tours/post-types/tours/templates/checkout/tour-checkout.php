<?php get_header(); ?>
<div class="mkdf-tours-checkout-page-holder">
	<?php if(have_posts()) : while(have_posts()) :  the_post(); ?>
		<div class="mkdf-tours-checkout-page-content">
			<?php the_content(); ?>
		</div>

		<?php echo mkdf_tours_get_checkout_page_content(); ?>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
