<?php
/**
 * Fields main class
 *
 * @package calderawp\input
 * @author    David Cramer <david@digilab.co.za>
 * @license   GPL-2.0+
 * @link
 * @copyright 2014 David Cramer
 */

namespace calderawp\input;
use calderawp\filter;

/**
 * Class fields
 *
 * @package calderawp\input
 */
class fields {

	/**
	 * file path
	 *
	 * @since 1.0.0
	 *
	 * @var      string
	 */
	protected $path;
	
	/**
	 * fields url
	 *
	 * @since 1.0.0
	 *
	 * @var      string
	 */
	protected $url;

	/**
	 * Text domain for this instance
	 *
	 * @since 1.0.0
	 *
	 * @var      string
	 */
	protected $text_domain = 'caldera-fields';

	/**
	 * magic tags
	 *
	 * @since 1.0.0
	 *
	 * @var      object
	 */
	protected $magic_tags;

	/**
	 * registered fields list.
	 *
	 * @since 1.0.0
	 *
	 * @var      array
	 */
	public $fields = array();

	/**
	 * version number
	 *
	 * @since 1.0.0
	 *
	 * @var      string
	 */
	public $version = '1.0.0';
	
	/**
	 * Constructor for class. Sets up the default filters.
	 */
	function __construct( $text_domain = null) {

		// set URL
		$this->url 	= plugin_dir_url( __FILE__ );
		$this->path = plugin_dir_path( __FILE__ );

		// if text domain specified set it up here.
		if( null !== $text_domain ){
			$this->text_domain = $text_domain;
		}

		// register fields
		$this->fields = $this->get_fields();

		// init magic
		$this->magic_tags = new filter\magictag();

	}


	/**
	 * Get core form fields
	 *
	 * @since 1.0.0
	 *
	 *
	 * @return array|void array of registered fields
	 */
	public function get_fields() {


		$internal_fields = array(
			'calculation' => array(
				"field"		=>	__("Calculation", $this->text_domain ),
				"file"		=>	$this->path . "/fields/calculation/field.php",
				"category"	=>	__("Special", $this->text_domain ).', '.__("Math", $this->text_domain ),
				"description" => __('Calculate values', $this->text_domain ),				
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/calculation/config.php",
					"preview"	=>	$this->path . "/fields/calculation/preview.php",
					"default"	=> array(
						'element'	=>	'h3',
						'classes'	=> 	'total-line',
						'before'	=>	__('Total', $this->text_domain ).':',
						'after'		=> ''
					),
					"styles" => array(
						$this->url . "/fields/calculation/style.css",
					)
				),
				"scripts" => array(
					//'jquery'
				)
			),
			'range_slider' 	=> array(
				"field"		=>	__("Range Slider", $this->text_domain ),
				"file"		=>	$this->path . "/fields/range_slider/field.php",
				"category"	=>	__("Special", $this->text_domain ),
				"description" => __('Range Slider input field',$this->text_domain ),
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/range_slider/config.php",
					"preview"	=>	$this->path . "/fields/range_slider/preview.php",
					"default"	=> array(
						'default'	=>	1,
						'step'		=>	1,
						'min'		=>	0,
						'max'		=> 100,
						'showval'	=> 1,
						'suffix'	=> '',
						'prefix'	=> '',
						'color'		=> '#00ff00',
						'handle'	=> '#ffffff',
						'handleborder'	=> '#cccccc',
						'trackcolor' => '#e6e6e6'
					),
					"scripts" => array(
						//'jquery',
						$this->url . "/fields/range_slider/rangeslider.js",
					),
					"styles" => array(
						$this->url . "/fields/range_slider/rangeslider.css",
					)
				),
				"scripts" => array(
					//'jquery',
					$this->url . "/fields/range_slider/rangeslider.js",
				),
				"styles" => array(
					$this->url . "/fields/range_slider/rangeslider.css",
				)
			),
			'star_rating' 	=> array(
				"field"		=>	__("Star Rating", $this->text_domain ),
				"file"		=>	$this->path . "/fields/star-rate/field.php",
				"category"	=>	__("Feedback", $this->text_domain ).', '.__("Special", $this->text_domain ),
				"description" => __('Star rating input for feedback',$this->text_domain ),
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/star-rate/config.php",
					"preview"	=>	$this->path . "/fields/star-rate/preview.php",
					"default"	=> array(
						'number'	=>	5,
						'space'		=>	3,
						'size'		=>	13,
						'color'		=> '#FFAA00',
						'track_color'=> '#AFAFAF',
						'type'=> 'star',
					),
					"scripts" => array(
						//'jquery',
						$this->url . "/fields/star-rate/jquery.raty.js",
					),
					"styles" => array(
						$this->url . "/fields/star-rate/jquery.raty.css",
						$this->url . "/fields/star-rate/cf-raty.css",
					)
				),
				"scripts" => array(
					'jquery',
					$this->url . "/fields/star-rate/jquery.raty.js",
				),
				"styles" => array(
					$this->url . "/fields/star-rate/jquery.raty.css",
					$this->url . "/fields/star-rate/cf-raty.css",
				)
			),
			'phone' => array(
				"field"		=>	__('Phone Number', $this->text_domain ),
				"description" => __('Phone number with masking', $this->text_domain ),
				"file"		=>	$this->path . "/fields/phone/field.php",
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Basic", $this->text_domain ).', '.__("User", $this->text_domain ),
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/phone/config.php",
					"preview"	=>	$this->path . "/fields/phone/preview.php",
					"default"	=>	array(
						'default'	=> '',
						'type'	=>	'local',
						'custom'=> '(999)999-9999'
					),
					"scripts"	=> array(
						$this->url . "/fields/phone/masked-input.js"
					)
				),
				"scripts"	=> array(
					//"jquery",
					$this->url . "/fields/phone/masked-input.js"
				)
			),
			'text' => array(
				"field"		=>	__("Single Line Text", $this->text_domain ),
				"description" => __('Single Line Text', $this->text_domain ),
				"file"		=>	$this->path . "/fields/text/field.php",
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/text/config.php",
					"preview"	=>	$this->path . "/fields/text/preview.php"
				),
				"scripts"	=> array(
					//"jquery",
					$this->url . "/fields/phone/masked-input.js"
				)
			),
			'file' => array(
				"field"		=>	__("File", $this->text_domain ),
				"description" => __('File Uploader', $this->text_domain ),
				"file"		=>	$this->path . "/fields/file/field.php",
				"category"	=>	__("Basic", $this->text_domain ).', '.__("File", $this->text_domain ),
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/file/preview.php",
					"template"	=>	$this->path . "/fields/file/config_template.php"
				)
			),
			'recaptcha' => array(
				"field"		=>	__("reCAPTCHA", $this->text_domain ),
				"description" => __('reCAPTCHA anti-spam field', $this->text_domain ),
				"file"		=>	$this->path . "/fields/recaptcha/field.php",
				"category"	=>	__("Special", $this->text_domain ),
				"capture"	=>	false,
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/recaptcha/config.php",
					"preview"	=>	$this->path . "/fields/recaptcha/preview.php",
					"not_supported"	=>	array(
						'hide_label',
						'caption',
						'required'
					),
					"scripts"	=> array(
						"https://www.google.com/recaptcha/api.js"
					)
				),
				"scripts"	=> array(
					"https://www.google.com/recaptcha/api.js"
				),
				"styles"	=> array(
					$this->url . "/fields/recaptcha/style.css"
				),
			),
			'html' => array(
				"field"		=>	__("HTML", $this->text_domain ),
				"description" => __('Add text/html content', $this->text_domain ),
				"file"		=>	$this->path . "/fields/html/field.php",
				"category"	=>	__("Content", $this->text_domain ),
				"icon"		=>	$this->url . "/html/icon.png",
				"capture"	=>	false,
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/html/preview.php",
					"template"	=>	$this->path . "/fields/html/config_template.php",
					"not_supported"	=>	array(
						'hide_label',
						'caption',
						'required',
						'entry_list'
					)
				)
			),
			'hidden' => array(
				"field"		=>	__("Hidden", $this->text_domain ),
				"description" => __('Hidden', $this->text_domain ),
				"file"		=>	$this->path . "/fields/hidden/field.php",
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"static"	=> true,
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/hidden/preview.php",
					"template"	=>	$this->path . "/fields/hidden/setup.php",
					"not_supported"	=>	array(
						'hide_label',
						'caption',
						'required',
					)
				)
			),
			'button' => array(
				"field"		=>	__("Button", $this->text_domain ),
				"description" => __('Button, Submit and Reset types', $this->text_domain ),
				"file"		=>	$this->path . "/fields/button/field.php",
				"category"	=>	__("Buttons", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"capture"	=>	false,
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/button/config_template.php",
					"preview"	=>	$this->path . "/fields/button/preview.php",
					"default"	=> array(
						'class'	=>	'btn btn-default',
						'type'	=>	'submit'
					),
					"not_supported"	=>	array(
						'hide_label',
						'caption',
						'required',
						'entry_list'
					)
				)
			),
			'email' => array(
				"field"		=>	__("Email Address", $this->text_domain ),
				"description" => __('Email Address', $this->text_domain ),
				"file"		=>	$this->path . "/fields/email/field.php",
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/email/preview.php",
					"template"	=>	$this->path . "/fields/email/config.php"
				)
			),
			'paragraph' => array(
				"field"		=>	__("Paragraph Textarea", $this->text_domain ),
				"description" => __('Paragraph Textarea', $this->text_domain ),
				"file"		=>	$this->path . "/fields/paragraph/field.php",
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/paragraph/config_template.php",
					"preview"	=>	$this->path . "/fields/paragraph/preview.php",
					"default"	=> array(
						'rows'	=>	'4'
					),
				)
			),
			'toggle_switch' => array(
				"field"		=>	__("Toggle Switch", $this->text_domain ),
				"description" => __('Toggle Switch', $this->text_domain ),
				"category"	=>	__("Select Options", $this->text_domain ).', '.__("Special", $this->text_domain ),
				"file"		=>	$this->path . "/fields/toggle_switch/field.php",
				"options"	=>	"single",
				"static"	=> true,
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/toggle_switch/config_template.php",
					"preview"	=>	$this->path . "/fields/toggle_switch/preview.php",
					"default"	=> array(
					),
					"scripts"	=>	array(
						$this->url . "/fields/toggle_switch/js/setup.js"
					),
					"styles"	=>	array(
						$this->url . "/fields/toggle_switch/css/setup.css"
					),
				),
				"scripts"	=>	array(
					"jquery",
					$this->url . "/fields/toggle_switch/js/toggle.js"
				),
				"styles"	=>	array(
					$this->url . "/fields/toggle_switch/css/toggle.css"
				)
			),
			'dropdown' => array(
				"field"		=>	__("Dropdown Select", $this->text_domain ),
				"description" => __('Dropdown Select', $this->text_domain ),
				"file"		=>	$this->path . "/fields/dropdown/field.php",
				"category"	=>	__("Select Options", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"options"	=>	"single",
				"static"	=> true,
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/dropdown/config_template.php",
					"preview"	=>	$this->path . "/fields/dropdown/preview.php",
					"default"	=> array(

					),
					"scripts"	=>	array(
						$this->url . "/fields/dropdown/js/setup.js"
					)
				)
			),
			'checkbox' => array(
				"field"		=>	__("Checkbox", $this->text_domain ),
				"description" => __('Checkbox', $this->text_domain ),
				"file"		=>	$this->path . "/fields/checkbox/field.php",
				"category"	=>	__("Select Options", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"options"	=>	"multiple",
				"static"	=> true,
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/checkbox/preview.php",
					"template"	=>	$this->path . "/fields/checkbox/config_template.php",
					"default"	=> array(

					),
					"scripts"	=>	array(
						$this->url . "/fields/checkbox/js/setup.js"
					)
				),
			),
			'radio' => array(
				"field"		=>	__("Radio", $this->text_domain ),
				"description" => __('Radio', $this->text_domain ),
				"file"		=>	$this->path . "/fields/radio/field.php",
				"category"	=>	__("Select Options", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"options"	=>	true,
				"static"	=> true,
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/radio/preview.php",
					"template"	=>	$this->path . "/fields/radio/config_template.php",
					"default"	=> array(
					),
					"scripts"	=>	array(
						$this->url . "/fields/radio/js/setup.js"
					)
				)
			),
			'date_picker' => array(
				"field"		=>	__("Date Picker", $this->text_domain ),
				"description" => __('Date Picker', $this->text_domain ),
				"file"		=>	$this->path . "/fields/date_picker/datepicker.php",
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Pickers", $this->text_domain ),
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/date_picker/preview.php",
					"template"	=>	$this->path . "/fields/date_picker/setup.php",
					"default"	=> array(
						'format'	=>	'yyyy-mm-dd'
					),
					"scripts"	=>	array(
						$this->url . "/fields/date_picker/js/bootstrap-datepicker.js",
						$this->url . "/fields/date_picker/js/setup.js"
					),
					"styles"	=>	array(
						$this->url . "/fields/date_picker/css/datepicker.css"
					),
				),
				"scripts"	=>	array(
					//"jquery",
					$this->url . "/fields/date_picker/js/bootstrap-datepicker.js"
				),
				"styles"	=>	array(
					$this->url . "/fields/date_picker/css/datepicker.css"
				)
			),
			'color_picker' => array(
				"field"		=>	__("Color Picker", $this->text_domain ),
				"description" => __('Color Picker', $this->text_domain ),
				"category"	=>	__("Text Fields", $this->text_domain ).', '.__("Pickers", $this->text_domain ),
				"file"		=>	$this->path . "/fields/color_picker/field.php",
				"setup"		=>	array(
					"preview"	=>	$this->path . "/fields/color_picker/preview.php",
					"template"	=>	$this->path . "/fields/color_picker/setup.php",
					"default"	=> array(
						'default'	=>	'#FFFFFF'
					),
					"scripts"	=>	array(
						$this->url . "/fields/color_picker/minicolors.js",
						$this->url . "/fields/color_picker/setup.js"
					),
					"styles"	=>	array(
						$this->url . "/fields/color_picker/minicolors.css"
					),
				),
				"scripts"	=>	array(
					//"jquery",
					$this->url . "/fields/color_picker/minicolors.js",
					$this->url . "/fields/color_picker/setup.js"
				),
				"styles"	=>	array(
					$this->url . "/fields/color_picker/minicolors.css"
				)
			),
			'states' => array(
				"field"		=>	__("State/ Province Select", $this->text_domain ),
				"description" => __('Dropdown select for US states and Canadian provinces.', $this->text_domain ),
				"file"		=>	$this->path . "/fields/states/field.php",
				"category"	=>	__("Select Options", $this->text_domain ).', '.__("Basic", $this->text_domain ),
				"placeholder" => false,
			
				"setup"		=>	array(
					"template"	=>	$this->path . "/fields/states/config_template.php",
					"preview"	=>	$this->path . "/fields/states/preview.php",
					"default"	=> array(

					),
				)
			),
		);
		
		/**
		 * Filter the list before returning
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'caldera_fields_get_field_types', $internal_fields );

	}

	/**
	 * get a field type
	 *
	 * @since 1.0.0
	 * @param string $type field type slug
	 *
	 * @return array|WP_Error $field structure of requested field or error object
	 */
	public function get_field_type( $type ) {

		// check if its a valid type
		if( !isset( $this->fields[ $type ] ) ){
			return new \WP_Error( 'invalid_field_type', __( 'Invalid field type', $this->text_domain ) );
		}

		/**
		 * Filter the field config before using
		 *
		 * @since 1.0.0
		 */
		$field = apply_filters( 'caldera_fields_get_field', $this->fields[ $type ] );

		// add type
		$field['type'] = $type;

		/**
		 * Filter the specific field type config before using
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'caldera_fields_get_field-' . $type, $field );

	}

	/**
	 * get the field classes and filter for rendering
	 *
	 * @since 1.0.0
	 * @param array $field field structure
	 *
	 * @return array $field_classes field classes array
	 */
	private function get_field_classes( $field ) {

		// default field classes
		$field_classes = array(
			"control_wrapper"	=> array("form-group"),
			"field_label"		=> array("control-label"),
			"field_required_tag"=> array("field_required"),
			"field_wrapper"		=> array(),
			"field"				=> array("form-control"),
			"field_caption"		=> array("help-block"),
			"field_error"		=> array("has-error"),
		);

		/**
		 * Filter the field classes before returning
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'caldera_fields_render_field_classes', $field_classes, $field );		

	}

	/**
	 * get the field structure parts
	 *
	 * @since 1.0.0
	 *
	 * @return array field structure parts
	 */
	private function get_field_structure_parts( $config, $field_classes, $field ) {
		
		$field_structure_parts = array(
			"id"				=>	$config['id'],
			"name"				=>	$config['id'],
			"label_before"		=>	null,
			"label"				=>	null,
			"label_required"	=>	null,
			"label_after"		=>	null,
			"field_placeholder" =>	null,
			"field_required"	=>	null,
			"field_value"		=>	null,
			"field_caption"		=>	null,
		);

		$structure_optional_parts = array(
			'required'		=>	array(
				"label_required"	=>	" <span class=\"" . esc_attr( implode(' ', $field_classes['field_required_tag'] ) ) . "\" style=\"color:#ff2222;\">*</span>",
				"field_required"	=>	'required="required"',
			),
			'label'			=>	array(
				"label_before"		=>	"<label for=\"" . esc_attr( $config['id'] ) . "\" class=\"" . esc_attr( implode(' ', $field_classes['field_label'] ) ) . "\">",
				"label"				=>	'%s',
				"label_after"		=>	"</label>",		
			),
			'placeholder'	=> array(
				"field_placeholder" =>	'placeholder="%s"',
			),
			'caption' 		=>	array(
				"field_caption"		=>	"<span class=\"" . esc_attr( implode(' ', $field_classes['field_caption'] ) ) . "\">%s</span>\r\n",
			)
		);

		// add optionals
		foreach( $config as $config_field=>$config_value ){
			if( isset( $structure_optional_parts[ $config_field ] ) ){

				// add values in
				foreach ($structure_optional_parts[ $config_field ] as &$part_string) {
					$part_string = sprintf( $part_string, esc_attr( $config_value ) );
				}
				//add to main structure array
				$field_structure_parts = array_merge( $field_structure_parts, $structure_optional_parts[ $config_field ] );
			}
		}

		/**
		 * Filter the field structure parts before returning
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'caldera_fields_field_structure_parts', $field_structure_parts, $config, $field );
	}

	/**
	 * get the field classes and filter for rendering
	 *
	 * @since 1.0.0
	 * @param array $field field structure
	 *
	 * @return array $field_classes field classes array
	 */
	private function get_field_structure( $field, $config ) {


		// get the field classes
		$field_classes = $this->get_field_classes( $field );
		
		/**
		 * Filter the specific field classes before using
		 *
		 * @since 1.0.0
		 */
		$field_classes = apply_filters( 'caldera_fields_render_field_classes_type-' . $field['type'], $field_classes, $field );

		// setup wrapper classes
		$field_wrapper_class = implode(' ',$field_classes['control_wrapper']);
		$field_input_class = implode(' ',$field_classes['field_wrapper']);		

		// get structure parts
		$field_structure = $this->get_field_structure_parts( $config, $field_classes, $field );

		// add field wrappers
		$field_structure = array_merge( $field_structure, array(
			"field_classes"		=> 	$field_classes,
			"wrapper_before"	=>	sprintf( '<div class="%s">', $field_wrapper_class ),
			"field_before"		=>	sprintf( '<div class="%s">', $field_input_class ),
			"field_after"		=>	'</div>',
			"wrapper_after"		=>	'</div>',
		) );

		// apply value 
		if( isset( $field['value'] ) ){
			$field_structure['field_value'] = $this->magic_tags->do_magic_tag( $field['config']['default'] );
		}elseif( isset( $field['config']['default'] ) ){
			$field_structure['field_value'] = $this->magic_tags->do_magic_tag( $field['config']['default'] );
		}

		/**
		 * Filter the field structure before using
		 *
		 * @since 1.0.0
		 */
		$field_structure = apply_filters( 'caldera_fields_render_field_structure', $field_structure, $field);
		
		/**
		 * Filter the specific field structure before returning
		 *
		 * @since 1.0.0
		 */		
		return apply_filters( 'caldera_fields_render_field_structure_type-' . $field['type'], $field_structure, $field);


	}


	/**
	 * Render a field
	 *
	 * @since 1.0.0
	 * @param string $type field type to render
	 * @param array $config field config structure
	 *
	 * @return string|wp_error rendered html string or wp_error object
	 */
	public function render_field( $type, $config = array() ) {

		// get the field type
		$field = $this->get_field_type( $type );

		// check if its a valid field
		if( is_wp_error( $field ) ){
			return $field->get_error_message();
		}

		// defaults
		$default_config = array(
			'id'		=>	uniqid( 'fld' ),
		);
		// merge with defaults
		$config = array_merge( $default_config, $config );

		// get field structure
		$field_structure = $this->get_field_structure( $field, $config );

		// set field class
		$field_class = implode(' ', $field_structure['field_classes']['field']);

		$field_name = $field_structure['name'];
		$field_id = $field_structure['id'];
		$wrapper_before = $field_structure['wrapper_before'];
		$field_before = $field_structure['field_before'];
		$field_label = $field_structure['label_before'] . $field_structure['label'] . $field_structure['label_required'] . $field_structure['label_after']."\r\n";
		$field_placeholder = $field_structure['field_placeholder'];
		$field_required = $field_structure['field_required'];
		$field_caption = $field_structure['field_caption'];
		$field_after = $field_structure['field_after'];
		$wrapper_after = $field_structure['wrapper_after'];
		// blank default
		$field_value = $field_structure['field_value'];
		// setup base instance ID
		$field_base_id = $config['id'];

		ob_start();
		include $field['file'];

		/**
		 * Filter the field html
		 *
		 * @since 1.0.0
		 */
		$field_html = apply_filters( 'caldera_fields_render_field', ob_get_clean(), $field, $config );
		/**
		 * Filter the specific field type html
		 *
		 * @since 1.0.0
		 */
		$field_html = apply_filters( 'caldera_fields_render_field_type-' . $field['type'], $field_html, $field, $config );

		// conditional wrapper
		if(!empty($field['conditions']['group']) && !empty($field['conditions']['type'])){


			// wrap it up
			$conditions_templates[$config['id']] = "<script type=\"text/html\" id=\"conditional-" . $config['id'] . "-tmpl\">\r\n" . $field_html . "</script>\r\n";
			// add in instance number
			if(!empty($field['conditions']['group'])){
				foreach($field['conditions']['group'] as &$group_row){
					foreach( $group_row as &$group_line){
						// add instance value
						$group_line['instance'] = 1;
					}
				}
			}
			$conditions_configs[$config['id']] = $field['conditions'];
			if($field['conditions']['type'] == 'show' || $field['conditions']['type'] == 'disable'){
				// show if indicates hidden by default until condition is matched.
				$field_html = null;
			}
			// wrapp it up
			$field_html = '<span class="caldera-forms-conditional-field" id="conditional_' . $config['id'] . '">' . $field_html . '</span>';
		}

		//enqueue scripts if any
		if( !empty( $field['scripts'])){
			// check for jquery deps
			$depts[] = 'jquery';
			foreach( $field['scripts'] as $script ){
				if( filter_var( $script, FILTER_VALIDATE_URL ) ){
					wp_enqueue_script( 'caldera-field-' . sanitize_key( basename( $script ) ), $script, $depts, $this->version );
				}else{
					wp_enqueue_script( $script );
				}
			}
		}


		/**
		 * Filter the final field html before returning
		 *
		 * @since 1.0.0
		 */		
		return apply_filters( 'caldera_fields_field_html', $field_html, $field, $config );

	}

}







