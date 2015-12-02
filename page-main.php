<?php 

/*
Template Name: Головна сторінка
*/

get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
<!-- START HEADER -->
		<div class="header" id="home">
			<div class="container">
				<div class=" wrap clearfix">
					<div class="contact f-left">
						<?php if ( ot_get_option( 'adress' ) ) : $adress = ot_get_option( 'adress' ); ?><div class="location"><?php echo ( $adress ); ?></div><?php endif; ?>
						<?php if ( ot_get_option( 'phone' ) ) : $phone = ot_get_option( 'phone' ); ?><div class="phone"><?php echo ( $phone ); ?></div><?php endif; ?>
					</div>
					<div class="social f-right">
						<div class="txt">Ми в соцмережах:</div>
						<?php if ( ot_get_option( 'facebook_link' ) ) : $facebook_link = ot_get_option( 'facebook_link' ); ?><a href="<?php echo esc_url( $facebook_link ); ?>" title="" class="fb"></a><?php endif; ?>
						<?php if ( ot_get_option( 'vkontakte_link' ) ) : $vkontakte_link = ot_get_option( 'vkontakte_link' ); ?><a href="<?php echo esc_url( $vkontakte_link ); ?>" title="" class="vk"></a><?php endif; ?>
						<?php if ( ot_get_option( 'youtube_link' ) ) : $youtube_link = ot_get_option( 'youtube_link' ); ?><a href="<?php echo esc_url( $youtube_link ); ?>" title="" class="yt"></a><?php endif; ?>
					</div>
				</div>
				<div class="logo" style="background-image:url(<?php the_field('main_logo'); ?>);"></div>
				<h1><?php the_field('title'); ?></h1>
				<?php if (get_field('subscribe')==1){ ?>
				<div class='subscribe_info'>
				</div>
				<?php echo do_action('[sbscrbr_form]'); ?>
				<?php
					// get our subscription form
					$subscriptionForm = \SimpleSubscribe\Developers::getSubscriptionForm();
					// with this we determine modal windows class, since it's hidden automatically,
					// with every submission, we should make it visible, therefore add class "visible"
					$modalWindowVisible = $subscriptionForm->isSubmitted() ? 'visible' : '';
					// just empty variable to be filled with errors / success message
					$subscriptionMessage = '';
					// is it valid or not?
					if($subscriptionForm->isSubmitted() && $subscriptionForm->isValid()){
						// it is, this is our messages
						$subscriptionMessage = 'Ваша підписка успішно оформлена';
					} elseif($subscriptionForm->isSubmitted() && $subscriptionForm->hasErrors()) {
						// it's not! get error messages in variable
						$subscriptionMessage = $subscriptionForm->getAllErrors();
						$subscriptionMessage='Помилка при оформленні підписки ('.$subscriptionMessage[0].')';
					}
				?>


        <?php
            // print message, if any
            
            // display form
            echo $subscriptionForm;
			echo '<ul class="subscribe_message"><li>'.$subscriptionMessage.'</li></ul>';
        ?>
				
				<?php } ?>
			</div>
		</div>
		<!-- END HEADER -->
		<!-- START TOURNAMENTS -->
		<div class="tournaments" id="tournaments">
			<div class="container clearfix">
				<div class="title">Турніри</div>
				<div class="tabwrapper">
					<ul class="tabnav">
						<li data-target="0" class="active"><span>Майбутні події</span></li>
						<li data-target="1"><span>Минулі події</span></li>
					</ul>
					<div class="tabs">
						<div class="tab t0 active">
							<div class="itemswrapper">
							<?php
                                $query = new WP_Query( array(
									'post_type' => 'tournaments',
									'meta_query' => array(
										array(
											'key' => 'date', // name of custom field
											'value' => date('Y-m-d'), // matches exaclty "123", not just 123. This prevents a match for "1234"
											'type'		=> 'DATE',
											'compare' => '>='
										)
									),
								   'orderby' => 'date',
								   'order' => 'ASC',
								) );
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) : $query->the_post();
									$img_url = get_field('picture');
									$term_list = wp_get_post_terms($post->ID, 'category_tournament', array("fields" => "all"));
									$term=$term_list[0];
									$term_color = get_field('color', $term->taxonomy . '_' . $term->term_id);

									?>
								<div class="item">
									<div class="icon">
										<?php echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?h=252&w=303&src='.$img_url.'" alt="">'; ?>
										<?php if ( $term->name!='' ) { echo '<div class="whom '.$term_color.'">'.$term->name.'</div>';} ?>
									</div>
									<div class="type <?php echo $term_color; ?>"><?php the_title(); ?></div>
									<div class="name"><?php the_field('title2'); ?></div>
									<div class="date"><?php the_time(get_field('date')); ?></div>
									<?php if (get_field('location')!=''){ ?><div class="location"><?php the_field('location'); ?> </div><?php } ?>
									<a class="more btn green" href="<?php the_permalink(); ?>" title="">Детальніше</a>
								</div>
								<?php	
									endwhile;
								endif;
								?>
								<?php wp_reset_query(); ?>								
							</div>
							<a href="/category_tournament/kids/" class="toall" title=""><span>всі турніри</span> ››</a>
						</div>
					
						<div class="tab t1">
								<div class="itemswrapper">
									<?php
									$query = new WP_Query( array(
										'post_type' => 'tournaments',
										'meta_query' => array(
											array(
												'key' => 'date', // name of custom field
												'value' => date('Y-m-d'), // matches exaclty "123", not just 123. This prevents a match for "1234"
												'type'		=> 'DATE',
												'compare' => '<'
											)
										),
									   'orderby' => 'start_date',
									   'order' => 'ASC',
									) );
									if ( $query->have_posts() ) :
										while ( $query->have_posts() ) : $query->the_post();
										$img_url = get_field('picture');
										$term_list = wp_get_post_terms($post->ID, 'category_tournament', array("fields" => "all"));
										$term=$term_list[0];
										$term_color = get_field('color', $term->taxonomy . '_' . $term->term_id);

										?>
									<div class="item">
										<div class="icon">
											<?php echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?h=252&w=303&src='.$img_url.'" alt="">'; ?>
											<?php if ( $term->name!='' ) { echo '<div class="whom '.$term_color.'">'.$term->name.'</div>';} ?>
										</div>
										<div class="type <?php echo $term_color; ?>"><?php the_title(); ?></div>
										<div class="name"><?php the_field('title2'); ?></div>
										<div class="date"><?php the_time(get_field('date')); ?></div>
										<?php if (get_field('location')!=''){ ?><div class="location"><?php the_field('location'); ?> </div><?php } ?>
										<a class="more btn green" href="<?php the_permalink(); ?>" title="">Детальніше</a>
									</div>
									<?php	
										endwhile;
									endif;
									?>
									<?php wp_reset_query(); ?>									
								</div>
								<a href="/tournaments" class="toall" title=""><span>всі турніри</span> ››</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END TOURNAMENTS -->
		<!-- START GALLERY -->
		<div class="gallery" id='gallery'>
			<div class="container">
				<div class="title">Галерея</div>
				<div class="tabwrapper">
					<ul class="tabnav">
						<li data-target="0" class="active"><span>Фото</span></li>
						<li data-target="1"><span>Відео</span></li>
					</ul>
					<div class="tabs">
						<div class="tab t0 active">
							<div class="itemswrapper">
								<div class="wrap">
								<?php
									$i=0;
									$query = new WP_Query( array(
										'post_type' => 'gallery',
										'tax_query' => array(
											array(
												'taxonomy' => 'category_gallery',
												'field' => 'id',
												'terms' => 13
											)
										),
									   'orderby' => 'start_date',
									) );
									if ( $query->have_posts() ) :
										while ( $query->have_posts() ) : $query->the_post();
										$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
										$i++;
																	
									?>
										
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="item" style="background-image:url(<?php echo get_bloginfo("template_url").'/timthumb.php?h=258&w=470&src='.$img_url;?>">
										<span class="wrapper">
											<span class="icon foto"></span>
											<span class="name"><?php the_title(); ?></span>
											<span class="description"><?php the_field('location'); ?>, <?php the_field('date'); ?></span>
										</span>
									</a>
									<?php
									if($i % 4 == 0){echo '</div><div class="wrap"> ';}	
										endwhile;
									endif;
									?>
									<?php wp_reset_query(); ?>									
								</div>

							</div>
							<a href="/category_gallery/foto/" title="" class="toall"><span>всі фото</span> ››</a>
						</div>
						<div class="tab t1">
							<div class="itemswrapper">
								<div class="wrap">
									<?php
									$i=0;
									$query = new WP_Query( array(
										'post_type' => 'gallery',
										'tax_query' => array(
											array(
												'taxonomy' => 'category_gallery',
												'field' => 'id',
												'terms' => 12
											)
										),
									   'orderby' => 'date',
									) );
									if ( $query->have_posts() ) :
										while ( $query->have_posts() ) : $query->the_post();
										$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
										$i++;
										
										?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="item" style="background-image:url(<?php echo get_bloginfo("template_url").'/timthumb.php?h=258&w=470&src='.$img_url;?>">
										<span class="wrapper">
											<span class="icon video"></span>
											<span class="name"><?php the_title(); ?></span>
											<span class="description"><?php the_field('location'); ?>, <?php the_field('date'); ?></span>
										</span>
									</a>
									<?php
									if($i % 4 == 0){echo '</div><div class="wrap"> ';}	
										endwhile;
									endif;
									?>	
									<?php wp_reset_query(); ?>
								</div>
							</div>
							<a href="/category_gallery/video/" title="" class="toall"><span>всі відео</span> ››</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END GALLERY -->
		<!-- START ABOUT -->
		<div class="about" id='about'>
			<div class="container">
				<div class="title">про нас</div>
				<div class="subtitle">покровителі</div>
				<div class="wrap clearfix">
				<?php if( have_rows('patrons') ): ?>
					<?php $i=0;
						while( have_rows('patrons') ): the_row(); 
						$i++;
						?>
							<div class="item f-<?php if($i % 1 == 0){echo 'left';}else{echo 'right';} ?>">
								<div class="imgwrap f-left"><img src="<?php the_sub_field('foto'); ?>" alt="<?php the_sub_field('title'); ?>"></div>
								<div class="txt f-left">
									<div class="name"><?php the_sub_field('title'); ?></div>
									<div class="post"><?php the_sub_field('subtitle'); ?></div>
									<div class="description"><?php the_sub_field('excerpt'); ?></div>
									<a href="<?php the_sub_field('url'); ?>" title="" class="more btn green">Читати далі</a>
								</div>
							</div>
					<?php endwhile; ?>
				<?php endif; ?>
					
				</div>
			</div>
		</div>
		<!-- END ABOUT -->
		<!-- START VOLUNTEERING -->
		<div class="volunteering">
			<div class="container">
				<div class="subtitle">Волонтерство</div>
				<?php if( have_rows('волонтерство') ): ?>
					<?php $i=0;
						while( have_rows('волонтерство') ): the_row(); 
						$i++;
						?>
							<a href="<?php the_sub_field('url'); ?>" class="volunter" title=""><img src="<?php the_sub_field('picture'); ?>" alt=""></a>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- END VOLUNTEERING -->
		<!-- START SYMBOLICS -->
		<div class="symbolics">
			<div class="container  clearfix">
				<div class="subtitle">Символіка</div>
				<?php if( have_rows('символіка') ): ?>
					<?php $i=0;
						while( have_rows('символіка') ): the_row(); 
						$i++;
						?>
							<a href="<?php the_sub_field('url'); ?>" title="" class="symbol f-left"><span class="icon"><img src="<?php the_sub_field('picture'); ?>" alt=""></span><span class="name"><span><?php the_sub_field('title'); ?></span></span></a>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- END SYMBOLICS -->
		<!-- START NEWSBLOCK -->
		<div class="newsblock" id='news'>
			<div class="container clearfix">
				<div class="title">новини</div>
				<div class="column f-left">
					<div class="h4">Загальні новини</div>
					<?php
                                $query = new WP_Query( array(
									'post_type' => 'post',
									'tax_query' => array(
											array(
												'taxonomy' => 'category',
												'field' => 'id',
												'terms' => 1
											)
										),
								   'posts_per_page' => '3',
								) );
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) : $query->the_post();
									$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

					?>
							<div class="item clearfix">
								<?php if($img_url!='') {echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?h=108&w=178&src='.$img_url.'" alt=""  class="f-left">';} ?>
								<a href="<?php echo the_permalink(); ?>" title="" class="name"><?php echo the_title(); ?></a>
								<div class="date"><?php the_time(get_the_date()); ?> <?php echo the_time(); ?><br/></div>
								<div class="txt"><?php echo the_excerpt(); ?></div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<a href="/category/general_news/" title="" class="toall"><span>Дивитись всі</span> ››</a>
				</div>
				<div class="column f-right">
					<div class="h4">Інші новини</div>
					<?php
                                $query = new WP_Query( array(
									'post_type' => 'post',
									'tax_query' => array(
											array(
												'taxonomy' => 'category',
												'field' => 'id',
												'terms' => 3
											)
										),
								   'posts_per_page' => '3',
								) );
								if ( $query->have_posts() ) :
									while ( $query->have_posts() ) : $query->the_post();
									$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );c

					?>
							<div class="item clearfix">
								<?php if($img_url!='') {echo '<img src="'.get_bloginfo("template_url").'/timthumb.php?h=108&w=178&src='.$img_url.'" alt=""  class="f-left">';} ?>
								<a href="<?php echo the_permalink(); ?>" title="" class="name"><?php echo the_title(); ?></a>
								<div class="date"><?php the_time(get_the_date()); ?>, <?php echo the_time(); ?><br/></div>
								<div class="txt"><?php echo the_excerpt(); ?></div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<a href="/category/our_news/" title="" class="toall"><span>Дивитись всі</span> ››</a>
				</div>
			</div>
		</div>
		<!-- END NEWSBLOCK -->
		<!-- START PARTNERS -->
		<div class="partners" id='media'>
			<div class="container clearfix">
				<div class="title">медіа-ПАртнери</div>
				<?php if( have_rows('медіа-партнери') ): ?>
					<?php $i=0;
						while( have_rows('медіа-партнери') ): the_row(); 
						$i++;
						?>
						
						<a href="<?php the_sub_field('url'); ?>" title="" class="partner f-left">
							<img src="<?php the_sub_field('picture'); ?>" alt="">
							<span class="name"><?php the_sub_field('title'); ?></span>
							<span class="description"><?php the_sub_field('text'); ?></span>
						</a>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- END PARTNERS -->
		<!-- START SPONSORS -->
		<div class="sponsors">
			<div class="container clearfix">
				<div class="title">Партнери</div>
				<?php if( have_rows('спонсори') ): ?>
					<?php $i=0;
						while( have_rows('спонсори') ): the_row(); 
						$i++;
						?>						
						<div class="sponsor f-<?php if($i % 1 == 0){echo 'left';}else{echo 'right';} ?> clearfix">
							<div class="icon f-left"><div class="helper"></div><img src="<?php the_sub_field('picture'); ?>" alt=""></div>
							<div class="name"><?php the_sub_field('title'); ?> <br/></div>
							<div class="description"><?php the_sub_field('excerpt'); ?></div>
							<a href="<?php the_sub_field('url'); ?>" title="" class="more"><span>детальніше</span> ›› </a>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- END SPONSORS -->
<?php endwhile; endif; ?>	
<?php get_footer(); ?>
