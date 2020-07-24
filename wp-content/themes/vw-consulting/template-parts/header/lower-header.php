<?php
/**
 * The template part for header
 *
 * @package VW Consulting 
 * @subpackage vw-consulting
 * @since vw-consulting 1.0
 */
?>

<div class="container">
	<div class="info-border">
		<div class="row">
			<div class="col-lg-2 col-md-2">	
				<?php if( get_theme_mod( 'vw_consulting_call') != '') { ?>
					<p><i class="<?php echo esc_attr(get_theme_mod('vw_consulting_phone_icon','fas fa-phone')); ?>"></i><?php echo esc_html( get_theme_mod('vw_consulting_call','')); ?></p>
				<?php }?>
			</div>
			<div class="col-lg-3 col-md-3">
				<?php if( get_theme_mod( 'vw_consulting_email') != '') { ?>
					<p><i class="<?php echo esc_attr(get_theme_mod('vw_consulting_email_icon','far fa-envelope')); ?>"></i><?php echo esc_html( get_theme_mod('vw_consulting_email','')); ?></p>
				<?php }?>
			</div>
			<div class="col-lg-4 col-md-4">
				<?php if( get_theme_mod( 'vw_consulting_time') != '') { ?>
					<p><i class="<?php echo esc_attr(get_theme_mod('vw_consulting_timing_icon','far fa-clock')); ?>"></i><?php echo esc_html( get_theme_mod('vw_consulting_time','')); ?></p>
				<?php }?>
			</div>
			<div class="col-lg-3 col-md-3">
				<?php dynamic_sidebar('social-links'); ?>
			</div>
		</div>
	</div>
</div>