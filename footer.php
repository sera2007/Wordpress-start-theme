 <div class="footer">
			<div class="container clearfix">
				<div class="f-left">
					<?php if ( ot_get_option( 'logo2' ) ) : ?>
						<div class="logo f-left" id="totop">
								 <img src="<?php echo esc_url( ot_get_option( 'logo2' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
						</div>
					<?php endif; ?>
					<div class="wrap f-left">
						<div class="h4">Контакти:</div>
						<?php if ( ot_get_option( 'adress' ) ) : $adress = ot_get_option( 'adress' ); ?><div class="loc"><?php echo ( $adress ); ?></div><?php endif; ?>
						<?php if ( ot_get_option( 'phone' ) ) : $phone = ot_get_option( 'phone' ); ?><div class="phone"><?php echo ( $phone ); ?></div><?php endif; ?>
					</div>
				</div>
				<div class="f-right">
					<div class="soc clearfix">						
						<?php if ( ot_get_option( 'youtube_link' ) ) : $youtube_link = ot_get_option( 'youtube_link' ); ?><a href="<?php echo esc_url( $youtube_link ); ?>" title="" class="yt f-right"></a><?php endif; ?>
						<?php if ( ot_get_option( 'vkontakte_link' ) ) : $vkontakte_link = ot_get_option( 'vkontakte_link' ); ?><a href="<?php echo esc_url( $vkontakte_link ); ?>" title="" class="vk f-right"></a><?php endif; ?>
						<?php if ( ot_get_option( 'facebook_link' ) ) : $facebook_link = ot_get_option( 'facebook_link' ); ?><a href="<?php echo esc_url( $facebook_link ); ?>" title="" class="fb f-right"></a><?php endif; ?>
						
						<div class="h4 f-right">Ми в соцмережах:</div>
					</div>
					<div class="copyright"><?php echo ot_get_option( 'copyright' ); ?></div>
				</div>
			</div>
		</div>
		<!-- END FOOTER -->
		
    <script async defer src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap"></script>
	<?php wp_footer(); ?>
	<?php echo ot_get_option( 'code_injection'); ?>
	</body>
</html>