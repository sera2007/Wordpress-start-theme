<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); // address pingback ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, itarget-densitydpi=high-dpi">
     <?php
  	$favicon = ot_get_option( 'favicon' );
	if($favicon){ ?>
	  <link rel="icon" href="<?php echo esc_url( $favicon ); ?>" type="image/x-icon" />
	  <link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>" type="image/x-icon" />		
	<?php } ?>
    
	<?php wp_head();?>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<?php if(!is_front_page()){ ?>
	<!-- START TOPBAR -->
		<div class="topbar">
			<div class="container clearfix">
				<a href="/" class="logo f-left" title="">
					<img src="<?php echo get_template_directory_uri() . '/public/';?>img/logo1.png" alt="">
				</a>
				<div class="h1 f-left">Спортивне душпастирство кам’янець-подільської дієцезії</div>
				<div class="wrap f-right">
					<div class="contact">
						<?php if ( ot_get_option( 'adress' ) ) : $adress = ot_get_option( 'adress' ); ?><div class="location"><?php echo ( $adress ); ?></div><?php endif; ?>
						<?php if ( ot_get_option( 'phone' ) ) : $phone = ot_get_option( 'phone' ); ?><div class="phone"><?php echo ( $phone ); ?></div><?php endif; ?>
					</div>
					<div class="social">
						<div class="txt">Ми в соцмережах:</div>
						<?php if ( ot_get_option( 'facebook_link' ) ) : $facebook_link = ot_get_option( 'facebook_link' ); ?><a href="<?php echo esc_url( $facebook_link ); ?>" title="" class="fb"></a><?php endif; ?>
						<?php if ( ot_get_option( 'vkontakte_link' ) ) : $vkontakte_link = ot_get_option( 'vkontakte_link' ); ?><a href="<?php echo esc_url( $vkontakte_link ); ?>" title="" class="vk"></a><?php endif; ?>
						<?php if ( ot_get_option( 'youtube_link' ) ) : $youtube_link = ot_get_option( 'youtube_link' ); ?><a href="<?php echo esc_url( $youtube_link ); ?>" title="" class="yt"></a><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<!-- END TOPBAR -->
	<?php } ?>
	<!-- START NAVBAR -->
		<div class="navbar">
			<div class="container clearfix">
				<ul class="f-left">
				<?php 
					$page_id = get_the_ID();
					if($page_id==202 || $page_id==204){$page_id=99;}
					if($page_id==130 || $page_id==211 || $page_id==132){$page_id=100;}
					if($page_id==168 || $page_id==173){$page_id=102;}
					$menu_items = carat_get_menu_items('top-menu');
					
					//$term = get_queried_object();
					
					
					/* foreach(get_the_terms(get_the_ID(), 'category_tournament') as $term) { echo '<pre>';
					print_r($term);
					echo '</pre>'; }*/

					$top_menu=array();
					if(isset($menu_items)){
						$is_sub=0;
						$id=0;
						foreach ( (array) $menu_items as $key => $menu_item ) {
							if ($menu_item->object_id == $page_id){$active='1';}else{$active='0';}
								if($menu_item->menu_item_parent!=0){
									$top_menu[$id]['children'][$menu_item->ID]=array('title'=>$menu_item->title,'url'=>$menu_item->url);
								}else{
									$id=$menu_item->object_id;
									$top_menu[$id]=array('active'=>$active,'title'=>$menu_item->title,'url'=>$menu_item->url);
								}
							}
						}

						foreach ( (array) $top_menu as $key => $menu_item ) {
							if($menu_item['active']==1){$active='active';}else{$active='';}
							if(is_array($menu_item['children'])){$is_children='menuparent has-regularmenu';}else{{$is_children='';}}
							echo "<li ><a class='$active $is_children' href='".$menu_item['url']."'>".$menu_item['title']."</a>";
							if(is_array($menu_item['children'])){
								echo '<div class="regularmenu"><ul class="regularmenu-inner">';
									foreach ( (array) $menu_item['children'] as $key => $menu_sub_item ) {
										echo "<li ><a href='".$menu_sub_item['url']."'>".$menu_sub_item['title']."</a>";
									}
									echo '</ul></div>';
								}
								echo "</li>";
							} 

							?> 
				</ul>
				<div class="search f-right">
					<form role="search" method="get" id="searchform" class="searchform" action="/">
						<input type="text" name="s" id="s" class="searchinput" placeholder="">
						<button class="searchbtn" type="submit"></button>
					</form>
				</div>
			</div>
		</div>
		<!-- END NAVBAR -->
		<?php if(!is_front_page()){ ?>
		<!-- START BREADCRUMBS -->
		<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
			<ul class="container">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
			</ul>
		</div>
		<!--
		<div class="breadcrumbs">
			<ul class="container">
				<li><a href="#" title="">Галерея</a></li>
				<li><a href="#" title="">Фото галерея</a></li>
				<li><a href="#" title="">Дитячий турнір</a></li>
			</ul>
		</div>
		-->
		<!-- END BREADCRUMBS -->
		<?php } ?>