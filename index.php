<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<!-- START CONTENT -->
		<div class="content container clearfix">
			<div class="newsdetail">
				<div class="title sm"><?php the_title(); ?></div>
				<div class="mainimg f-left">
					<img src="<?php echo $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>" alt="">
				</div>
				<div class="txt">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<!-- END CONTENT -->	
<?php endwhile; endif; ?>		
<?php get_footer(); ?>

