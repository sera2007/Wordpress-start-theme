<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<!-- START CONTENT -->
		<div class="content container clearfix">
			<div class="newsdetail">
				<div class="title sm"><?php global $post; $category = get_the_category($post->ID); echo $category[0]->name; ?></div>
				<div class="name"><?php the_title(); ?></div>
				<div class="date"><?php the_time(get_the_date()); ?> <?php echo the_time(); ?></div>
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

