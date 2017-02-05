<?php
/**
 * Customizer for custom dropdowns, extends the WP customizer
 *
 * @package    Bexley
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return NULL;
}


/**
 *
 */
class Bexley_Category_Dropdown_Custom_control extends WP_Customize_Control {

	/**
	 *
	 * @var type
	 */
	public $params;


	/**
	 *
	 * @param type $manager
	 * @param type $id
	 * @param type $args
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->params = $args['params'];
		parent::__construct( $manager, $id, $args );
	}


	/**
	 *
	 */
	public function render_content() {

		$value = $this->value();
		if ( empty( $value ) ) {
			$value = 0;
		}
?>
	<label>
		<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
		<select <?php $this->link(); ?>>
<?php
	foreach( $this->params as $k => $v ) {
?>
			<option value="<?php echo $k; ?>" <?php echo selected( $value, $k, false ); ?>><?php echo $v; ?></option>
<?php
	}
?>
		</select>
	</label>
<?php
	}

}