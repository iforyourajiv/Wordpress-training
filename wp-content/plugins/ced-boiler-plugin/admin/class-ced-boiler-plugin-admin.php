<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://cedcoss.com/
 * @since      1.0.0
 *
 * @package    Ced_Boiler_Plugin
 * @subpackage Ced_Boiler_Plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ced_Boiler_Plugin
 * @subpackage Ced_Boiler_Plugin/admin
 * @author     Cedcommerce <rajivranjanshrivastav@cedcoss.com>
 */
class Ced_Boiler_Plugin_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ced_Boiler_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_Boiler_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ced-boiler-plugin-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ced_Boiler_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_Boiler_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ced-boiler-plugin-admin.js', array('jquery'), $this->version, false);
	}

	// Adding New Menu 

	public function Ced_new_menu()
	{
		add_menu_page(
			"New Menu", // Menu Title
			"New Menu For Boilerplate", // Menu Name
			'manage_options', //Capabilities
			"menu-bolier", //Slug
			"new_menu_html", //Function
			"dashicons-buddicons-friends", //Icon
			30
		);


		// Callback Function For Menu
		function new_menu_html()
		{
			echo "<h1>Hello</h1>";
		}
	}

	//Adding Custom Meta Box For Brand
	/**
	 * Set up and add the meta box.
	 */
	public function add()
	{
		$screens = ['post', 'ced_meta_box'];
		foreach ($screens as $screen) {
			add_meta_box(
				'ced_metabox_brand',          // Unique ID
				'Brand', // Box title
				'html',  // Content callback, must be of type callable
				$screen, // Post type
				'side'
			);
		}

		function html($post)
		{
			$valueforBrand = get_post_meta($post->ID, 'ced_metabox_brand', true);
?>
			<label for="ced_meta_box_field">Brand</label>
			<input type="text" id="ced_meta_brand" name="ced_meta_brand" value="<?php echo $valueforBrand ?>">
<?php
		}
	}


	public function save(int $post_id)
	{

		if (array_key_exists('ced_meta_brand', $_POST)) {
			update_post_meta(
				$post_id,
				'ced_metabox_brand',
				$_POST['ced_meta_brand']
			);
		}
	}

	// Adding Column In Post Table Having a Name Brand

	// Fetching Value For Every Post in this Column (Brand)
	function fetch_value_col_brand($column_key, $post_id)
	{
		if ($column_key == 'brand') {
			$value = get_post_meta($post_id, 'ced_metabox_brand', true);
			if ($value) {
				echo '<span>';
				_e($value, 'ced-boiler-plugin');
				echo '</span>';
			} else {
				echo '<span>';
				_e(' __', 'ced-boiler-plugin');
				echo '</span>';
			}
		}
	}
	//Adding Column in post Table (brand)
	function add_col_brand($columns)
	{
		return array_merge($columns, ['brand' => __('brand', 'ced-boiler-plugin')]);
	}


	// Adding Column In Post Table Having a Name Color

	// Fetching Value For Every Post in this Column (Color)
	function fetch_value_col_color($column_key, $post_id)
	{
		if ($column_key == 'color') {
			$value = get_post_meta($post_id, 'ced_meta_box_metakey', true);
			if ($value) {
				echo '<span>';
				_e($value, 'ced-boiler-plugin');
				echo '</span>';
			} else {
				echo '<span>';
				_e('__', 'ced-boiler-plugin');
				echo '</span>';
			}
		}
	}
	//Adding Column in post Table (color)
	function add_col_color($columns)
	{
		return array_merge($columns, ['color' => __('color', 'ced-boiler-plugin')]);
	}
}
