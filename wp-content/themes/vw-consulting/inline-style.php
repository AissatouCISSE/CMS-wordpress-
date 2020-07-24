<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_consulting_first_color = get_theme_mod('vw_consulting_first_color');

	$vw_consulting_custom_css = ''; 

	if($vw_consulting_first_color != false){
		$vw_consulting_custom_css .='.toggle-nav i{';
			$vw_consulting_custom_css .='background-color: '.esc_html($vw_consulting_first_color).';';
		$vw_consulting_custom_css .='}';
	}

	if($vw_consulting_first_color != false){
		$vw_consulting_custom_css .='a:hover{';
			$vw_consulting_custom_css .='color: '.esc_html($vw_consulting_first_color).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_custom_css .='@media screen and (max-width:1000px) {';
		if($vw_consulting_first_color != false){
			$vw_consulting_custom_css .='.search-box i{
			background-color:'.esc_html($vw_consulting_first_color).';
			}';
		}
	$vw_consulting_custom_css .='}';

	/*---------------------------Second highlight color-------------------*/

	$vw_consulting_second_color = get_theme_mod('vw_consulting_second_color');

	if($vw_consulting_second_color != false){
		$vw_consulting_custom_css .='#header .menu a::after, #header .menu a::before, .scrollup{';
			$vw_consulting_custom_css .='background-color: '.esc_html($vw_consulting_second_color).';';
		$vw_consulting_custom_css .='}';
	}
	if($vw_consulting_second_color != false){
		$vw_consulting_custom_css .='a, #contact_info .custom-social-icons a i:hover, #footer li a:hover, #footer caption, .post-main-box:hover h2, #sidebar ul li a:hover, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .post-navigation a:hover, .post-navigation a:focus, .scrollup i, .entry-content a, .post-main-box:hover h2 a, #footer .textwidget a, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, .main-navigation ul.sub-menu a:hover, .page-template-custom-home-page #header .main-navigation a:hover{';
			$vw_consulting_custom_css .='color: '.esc_html($vw_consulting_second_color).';';
		$vw_consulting_custom_css .='}';
	}
	if($vw_consulting_second_color != false){
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='border-color: '.esc_html($vw_consulting_second_color).';';
		$vw_consulting_custom_css .='}';
	}
	if($vw_consulting_second_color != false){
		$vw_consulting_custom_css .='.main-navigation ul ul{';
			$vw_consulting_custom_css .='border-top-color: '.esc_html($vw_consulting_second_color).';';
		$vw_consulting_custom_css .='}';
	}
	if($vw_consulting_second_color != false){
		$vw_consulting_custom_css .='.main-navigation ul ul{';
			$vw_consulting_custom_css .='border-bottom-color: '.esc_html($vw_consulting_second_color).';';
		$vw_consulting_custom_css .='}';
	}
	if($vw_consulting_first_color != false || $vw_consulting_second_color != false){
		$vw_consulting_custom_css .='input[type="submit"], .page-template-custom-home-page .logo-bg, .home-page-header, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, .more-btn a:hover, #slider .more-btn a:hover, .box-content:hover, #footer .tagcloud a:hover, #footer h3:after, #footer-2, #comments input[type="submit"], #sidebar .custom-social-icons i:hover, #footer .custom-social-icons i:hover, #sidebar h3, #sidebar .tagcloud a:hover, .pagination a:hover, .pagination .current, .widget_product_search button, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, nav.woocommerce-MyAccount-navigation ul li, #comments a.comment-reply-link, .header-fixed, .page-template-custom-home-page .header-fixed .inner-header, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer #respond input#submit:hover, #footer a.button:hover, #footer button.button:hover, #footer input.button:hover, #footer #respond input#submit.alt:hover, #footer a.button.alt:hover, #footer button.button.alt:hover, #footer input.button.alt:hover, #sidebar a.custom_read_more:hover, #footer a.custom_read_more:hover{
		background: linear-gradient(to right, '.esc_html($vw_consulting_first_color).', '.esc_html($vw_consulting_second_color).');
		}';
	}
	if($vw_consulting_first_color != false || $vw_consulting_second_color != false){
		$vw_consulting_custom_css .='.heading{
		border-image: linear-gradient(to right, '.esc_html($vw_consulting_first_color).', '.esc_html($vw_consulting_second_color).') 1 100%;
		}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_consulting_theme_lay = get_theme_mod( 'vw_consulting_width_option','Full Width');
    if($vw_consulting_theme_lay == 'Boxed'){
		$vw_consulting_custom_css .='body{';
			$vw_consulting_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_consulting_custom_css .='}';
		$vw_consulting_custom_css .='.page-template-custom-home-page .middle-header{';
			$vw_consulting_custom_css .='width: 98.7%;';
		$vw_consulting_custom_css .='}';
	}else if($vw_consulting_theme_lay == 'Wide Width'){
		$vw_consulting_custom_css .='body{';
			$vw_consulting_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_consulting_custom_css .='}';
	}else if($vw_consulting_theme_lay == 'Full Width'){
		$vw_consulting_custom_css .='body{';
			$vw_consulting_custom_css .='max-width: 100%;';
		$vw_consulting_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_consulting_theme_lay = get_theme_mod( 'vw_consulting_slider_opacity_color','0.4');
	if($vw_consulting_theme_lay == '0'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.1'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.1';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.2'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.2';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.3'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.3';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.4'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.4';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.5'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.5';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.6'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.6';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.7'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.7';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.8'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.8';
		$vw_consulting_custom_css .='}';
		}else if($vw_consulting_theme_lay == '0.9'){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='opacity:0.9';
		$vw_consulting_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_consulting_theme_lay = get_theme_mod( 'vw_consulting_slider_content_option','Left');
    if($vw_consulting_theme_lay == 'Left'){
		$vw_consulting_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$vw_consulting_custom_css .='text-align:left; left:15%; right:45%;';
		$vw_consulting_custom_css .='}';
	}else if($vw_consulting_theme_lay == 'Center'){
		$vw_consulting_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$vw_consulting_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_consulting_custom_css .='}';
	}else if($vw_consulting_theme_lay == 'Right'){
		$vw_consulting_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .more-btn{';
			$vw_consulting_custom_css .='text-align:right; left:45%; right:15%;';
		$vw_consulting_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_consulting_slider_height = get_theme_mod('vw_consulting_slider_height');
	if($vw_consulting_slider_height != false){
		$vw_consulting_custom_css .='#slider img{';
			$vw_consulting_custom_css .='height: '.esc_html($vw_consulting_slider_height).';';
		$vw_consulting_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$vw_consulting_slider = get_theme_mod('vw_consulting_slider_arrows');
	if($vw_consulting_slider == false){
		$vw_consulting_custom_css .='.info-border{';
			$vw_consulting_custom_css .='padding: 0;';
		$vw_consulting_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_consulting_theme_lay = get_theme_mod( 'vw_consulting_blog_layout_option','Default');
    if($vw_consulting_theme_lay == 'Default'){
		$vw_consulting_custom_css .='.post-main-box{';
			$vw_consulting_custom_css .='';
		$vw_consulting_custom_css .='}';
	}else if($vw_consulting_theme_lay == 'Center'){
		$vw_consulting_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .post-main-box .more-btn{';
			$vw_consulting_custom_css .='text-align:center;';
		$vw_consulting_custom_css .='}';
		$vw_consulting_custom_css .='.post-info{';
			$vw_consulting_custom_css .='margin-top:10px;';
		$vw_consulting_custom_css .='}';
		$vw_consulting_custom_css .='.post-info hr{';
			$vw_consulting_custom_css .='margin:15px auto;';
		$vw_consulting_custom_css .='}';
	}else if($vw_consulting_theme_lay == 'Left'){
		$vw_consulting_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .post-main-box .more-btn, #our-services p{';
			$vw_consulting_custom_css .='text-align:Left;';
		$vw_consulting_custom_css .='}';
		$vw_consulting_custom_css .='.post-info hr{';
			$vw_consulting_custom_css .='margin-bottom:10px;';
		$vw_consulting_custom_css .='}';
		$vw_consulting_custom_css .='.post-main-box h2{';
			$vw_consulting_custom_css .='margin-top:10px;';
		$vw_consulting_custom_css .='}';
	}
	
	/*------------------------------Responsive Media -----------------------*/

	$vw_consulting_resp_topbar = get_theme_mod( 'vw_consulting_resp_contact_info_hide_show',false);
    if($vw_consulting_resp_topbar == true){
    	$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='#contact_info{';
			$vw_consulting_custom_css .='display:block;';
		$vw_consulting_custom_css .='} }';
	}else if($vw_consulting_resp_topbar == false){
		$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='#contact_info{';
			$vw_consulting_custom_css .='display:none;';
		$vw_consulting_custom_css .='} }';
	}

	$vw_consulting_resp_stickyheader = get_theme_mod( 'vw_consulting_stickyheader_hide_show',false);
    if($vw_consulting_resp_stickyheader == true){
    	$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='.header-fixed{';
			$vw_consulting_custom_css .='display:block;';
		$vw_consulting_custom_css .='} }';
	}else if($vw_consulting_resp_stickyheader == false){
		$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='.header-fixed{';
			$vw_consulting_custom_css .='display:none;';
		$vw_consulting_custom_css .='} }';
	}

	$vw_consulting_resp_slider = get_theme_mod( 'vw_consulting_resp_slider_hide_show',false);
    if($vw_consulting_resp_slider == true){
    	$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='#slider{';
			$vw_consulting_custom_css .='display:block;';
		$vw_consulting_custom_css .='} }';
	}else if($vw_consulting_resp_slider == false){
		$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='#slider{';
			$vw_consulting_custom_css .='display:none;';
		$vw_consulting_custom_css .='} }';
	}

	$vw_consulting_resp_metabox = get_theme_mod( 'vw_consulting_metabox_hide_show',true);
    if($vw_consulting_resp_metabox == true){
    	$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='.post-info{';
			$vw_consulting_custom_css .='display:block;';
		$vw_consulting_custom_css .='} }';
	}else if($vw_consulting_resp_metabox == false){
		$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='.post-info{';
			$vw_consulting_custom_css .='display:none;';
		$vw_consulting_custom_css .='} }';
	}

	$vw_consulting_resp_sidebar = get_theme_mod( 'vw_consulting_sidebar_hide_show',true);
    if($vw_consulting_resp_sidebar == true){
    	$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='#sidebar{';
			$vw_consulting_custom_css .='display:block;';
		$vw_consulting_custom_css .='} }';
	}else if($vw_consulting_resp_sidebar == false){
		$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='#sidebar{';
			$vw_consulting_custom_css .='display:none;';
		$vw_consulting_custom_css .='} }';
	}

	$vw_consulting_resp_scroll_top = get_theme_mod( 'vw_consulting_resp_scroll_top_hide_show',true);
    if($vw_consulting_resp_scroll_top == true){
    	$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='display:block;';
		$vw_consulting_custom_css .='} }';
	}else if($vw_consulting_resp_scroll_top == false){
		$vw_consulting_custom_css .='@media screen and (max-width:575px) {';
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='display:none !important;';
		$vw_consulting_custom_css .='} }';
	}

	/*------------------ Search Settings -----------------*/
	
	$vw_consulting_search_font_size = get_theme_mod('vw_consulting_search_font_size');
	if($vw_consulting_search_font_size != false){
		$vw_consulting_custom_css .='.search-box i{';
			$vw_consulting_custom_css .='font-size: '.esc_html($vw_consulting_search_font_size).';';
		$vw_consulting_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_consulting_button_padding_top_bottom = get_theme_mod('vw_consulting_button_padding_top_bottom');
	$vw_consulting_button_padding_left_right = get_theme_mod('vw_consulting_button_padding_left_right');
	if($vw_consulting_button_padding_top_bottom != false || $vw_consulting_button_padding_left_right != false){
		$vw_consulting_custom_css .='.post-main-box .more-btn a{';
			$vw_consulting_custom_css .='padding-top: '.esc_html($vw_consulting_button_padding_top_bottom).'; padding-bottom: '.esc_html($vw_consulting_button_padding_top_bottom).';padding-left: '.esc_html($vw_consulting_button_padding_left_right).';padding-right: '.esc_html($vw_consulting_button_padding_left_right).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_button_border_radius = get_theme_mod('vw_consulting_button_border_radius');
	if($vw_consulting_button_border_radius != false){
		$vw_consulting_custom_css .='.post-main-box .more-btn a{';
			$vw_consulting_custom_css .='border-radius: '.esc_html($vw_consulting_button_border_radius).'px;';
		$vw_consulting_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_consulting_copyright_alingment = get_theme_mod('vw_consulting_copyright_alingment');
	if($vw_consulting_copyright_alingment != false){
		$vw_consulting_custom_css .='.copyright p{';
			$vw_consulting_custom_css .='text-align: '.esc_html($vw_consulting_copyright_alingment).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_copyright_padding_top_bottom = get_theme_mod('vw_consulting_copyright_padding_top_bottom');
	if($vw_consulting_copyright_padding_top_bottom != false){
		$vw_consulting_custom_css .='#footer-2{';
			$vw_consulting_custom_css .='padding-top: '.esc_html($vw_consulting_copyright_padding_top_bottom).'; padding-bottom: '.esc_html($vw_consulting_copyright_padding_top_bottom).';';
		$vw_consulting_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_consulting_scroll_to_top_font_size = get_theme_mod('vw_consulting_scroll_to_top_font_size');
	if($vw_consulting_scroll_to_top_font_size != false){
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='font-size: '.esc_html($vw_consulting_scroll_to_top_font_size).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_scroll_to_top_padding = get_theme_mod('vw_consulting_scroll_to_top_padding');
	$vw_consulting_scroll_to_top_padding = get_theme_mod('vw_consulting_scroll_to_top_padding');
	if($vw_consulting_scroll_to_top_padding != false){
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='padding-top: '.esc_html($vw_consulting_scroll_to_top_padding).';padding-bottom: '.esc_html($vw_consulting_scroll_to_top_padding).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_scroll_to_top_width = get_theme_mod('vw_consulting_scroll_to_top_width');
	if($vw_consulting_scroll_to_top_width != false){
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='width: '.esc_html($vw_consulting_scroll_to_top_width).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_scroll_to_top_height = get_theme_mod('vw_consulting_scroll_to_top_height');
	if($vw_consulting_scroll_to_top_height != false){
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='height: '.esc_html($vw_consulting_scroll_to_top_height).';';
		$vw_consulting_custom_css .='}';
	}

	$vw_consulting_scroll_to_top_border_radius = get_theme_mod('vw_consulting_scroll_to_top_border_radius');
	if($vw_consulting_scroll_to_top_border_radius != false){
		$vw_consulting_custom_css .='.scrollup i{';
			$vw_consulting_custom_css .='border-radius: '.esc_html($vw_consulting_scroll_to_top_border_radius).'px;';
		$vw_consulting_custom_css .='}';
	}