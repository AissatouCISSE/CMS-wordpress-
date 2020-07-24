<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Consulting_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-consulting' ),
				'family'      => esc_html__( 'Font Family', 'vw-consulting' ),
				'size'        => esc_html__( 'Font Size',   'vw-consulting' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-consulting' ),
				'style'       => esc_html__( 'Font Style',  'vw-consulting' ),
				'line_height' => esc_html__( 'Line Height', 'vw-consulting' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-consulting' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-consulting-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-consulting-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-consulting' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-consulting' ),
        'Acme' => __( 'Acme', 'vw-consulting' ),
        'Anton' => __( 'Anton', 'vw-consulting' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-consulting' ),
        'Arimo' => __( 'Arimo', 'vw-consulting' ),
        'Arsenal' => __( 'Arsenal', 'vw-consulting' ),
        'Arvo' => __( 'Arvo', 'vw-consulting' ),
        'Alegreya' => __( 'Alegreya', 'vw-consulting' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-consulting' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-consulting' ),
        'Bangers' => __( 'Bangers', 'vw-consulting' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-consulting' ),
        'Bad Script' => __( 'Bad Script', 'vw-consulting' ),
        'Bitter' => __( 'Bitter', 'vw-consulting' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-consulting' ),
        'BenchNine' => __( 'BenchNine', 'vw-consulting' ),
        'Cabin' => __( 'Cabin', 'vw-consulting' ),
        'Cardo' => __( 'Cardo', 'vw-consulting' ),
        'Courgette' => __( 'Courgette', 'vw-consulting' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-consulting' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-consulting' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-consulting' ),
        'Cuprum' => __( 'Cuprum', 'vw-consulting' ),
        'Cookie' => __( 'Cookie', 'vw-consulting' ),
        'Chewy' => __( 'Chewy', 'vw-consulting' ),
        'Days One' => __( 'Days One', 'vw-consulting' ),
        'Dosis' => __( 'Dosis', 'vw-consulting' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-consulting' ),
        'Economica' => __( 'Economica', 'vw-consulting' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-consulting' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-consulting' ),
        'Francois One' => __( 'Francois One', 'vw-consulting' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-consulting' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-consulting' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-consulting' ),
        'Handlee' => __( 'Handlee', 'vw-consulting' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-consulting' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-consulting' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-consulting' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-consulting' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-consulting' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-consulting' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-consulting' ),
        'Kanit' => __( 'Kanit', 'vw-consulting' ),
        'Lobster' => __( 'Lobster', 'vw-consulting' ),
        'Lato' => __( 'Lato', 'vw-consulting' ),
        'Lora' => __( 'Lora', 'vw-consulting' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-consulting' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-consulting' ),
        'Merriweather' => __( 'Merriweather', 'vw-consulting' ),
        'Monda' => __( 'Monda', 'vw-consulting' ),
        'Montserrat' => __( 'Montserrat', 'vw-consulting' ),
        'Muli' => __( 'Muli', 'vw-consulting' ),
        'Marck Script' => __( 'Marck Script', 'vw-consulting' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-consulting' ),
        'Open Sans' => __( 'Open Sans', 'vw-consulting' ),
        'Overpass' => __( 'Overpass', 'vw-consulting' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-consulting' ),
        'Oxygen' => __( 'Oxygen', 'vw-consulting' ),
        'Orbitron' => __( 'Orbitron', 'vw-consulting' ),
        'Patua One' => __( 'Patua One', 'vw-consulting' ),
        'Pacifico' => __( 'Pacifico', 'vw-consulting' ),
        'Padauk' => __( 'Padauk', 'vw-consulting' ),
        'Playball' => __( 'Playball', 'vw-consulting' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-consulting' ),
        'PT Sans' => __( 'PT Sans', 'vw-consulting' ),
        'Philosopher' => __( 'Philosopher', 'vw-consulting' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-consulting' ),
        'Poiret One' => __( 'Poiret One', 'vw-consulting' ),
        'Quicksand' => __( 'Quicksand', 'vw-consulting' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-consulting' ),
        'Raleway' => __( 'Raleway', 'vw-consulting' ),
        'Rubik' => __( 'Rubik', 'vw-consulting' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-consulting' ),
        'Russo One' => __( 'Russo One', 'vw-consulting' ),
        'Righteous' => __( 'Righteous', 'vw-consulting' ),
        'Slabo' => __( 'Slabo', 'vw-consulting' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-consulting' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-consulting'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-consulting' ),
        'Sacramento' => __( 'Sacramento', 'vw-consulting' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-consulting' ),
        'Tangerine' => __( 'Tangerine', 'vw-consulting' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-consulting' ),
        'VT323' => __( 'VT323', 'vw-consulting' ),
        'Varela Round' => __( 'Varela Round', 'vw-consulting' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-consulting' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-consulting' ),
        'Volkhov' => __( 'Volkhov', 'vw-consulting' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-consulting' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-consulting' ),
			'100' => esc_html__( 'Thin',       'vw-consulting' ),
			'300' => esc_html__( 'Light',      'vw-consulting' ),
			'400' => esc_html__( 'Normal',     'vw-consulting' ),
			'500' => esc_html__( 'Medium',     'vw-consulting' ),
			'700' => esc_html__( 'Bold',       'vw-consulting' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-consulting' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-consulting' ),
			'normal'  => esc_html__( 'Normal', 'vw-consulting' ),
			'italic'  => esc_html__( 'Italic', 'vw-consulting' ),
			'oblique' => esc_html__( 'Oblique', 'vw-consulting' )
		);
	}
}
