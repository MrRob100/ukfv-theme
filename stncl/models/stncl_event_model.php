<?php
class Stncl_event_model extends Stncl_model
{
    public const POST_NAME = 'event';
    public const POST_NAME_PLURAL = 'events';
    public const POST_NAME_SENTENCE = 'Event';
    public const POST_NAME_PLURAL_SENTENCE = 'Events';
    public function __construct()
    {
        parent::__construct();
        add_action('add_meta_boxes', array(&$this, 'add_meta_box'), 1);
        add_action('add_meta_boxes', array(&$this, 'add_content_box'), 1);
        add_action('save_post', array(&$this, 'save_postdata'));
        add_filter('pre_get_posts', array(&$this, 'pre_get_posts'));
        $this->post_type_config = array( 'public' => true, 'exclude_from_search' => false, 'show_ui' => true, 'menu_icon' => 'dashicons-calendar', 'menu_position' => 30, 'capability_type' => 'custom', 'hierarchical' => false, 'has_archive' => 'events', 'rewrite' => array('slug' => 'events', 'with_front' => false), 'query_var' => true, 'supports' => array('title', 'editor') );
    } public function pre_get_posts($query)
    {
        global $wp_query;
        if (! is_admin() and is_archive() and $query->is_main_query() and isset($query->query_vars['post_type']) and ($query->query_vars['post_type'] == "event")) {
            $query->set('meta_key', '_stncl_event_date_start_field');
            $query->set('orderby', 'meta_value_num');
            if (! isset($_GET['past'])) {
                $query->set('order', 'ASC');
                $query->set('meta_query', array( array( 'key' => '_stncl_event_date_start_field', 'value' => strtotime('today midnight') - 1, 'type' => 'numeric', 'compare' => '>' ) ));
            } else {
                $query->set('order', 'DESC');
                $query->set('meta_query', array( array( 'key' => '_stncl_event_date_start_field', 'value' => strtotime('today midnight') - 1, 'type' => 'numeric', 'compare' => '<' ) ));
            }
        }
    } public function filter_columns($columns)
    {
        $columns = array( "cb" => "<input type=\"checkbox\" />", "event__id" => "ID", "title" => "Title", "event__date_start" => "Start Date", "event__date_end" => "End Date", "event__venue" => "Venue", "date" => "Published Date" );
        return $columns;
    } public function post_columns($column)
    {
        global $post;
        $custom_fields = get_post_custom($post->ID);
        switch($column) {
            case 'event__id': echo $post->ID;
                break;
            case 'event__date_start': echo ($custom_fields['_stncl_event_date_start_field'][0]) ? date('d/m/Y', intval($custom_fields['_stncl_event_date_start_field'][0])) : 'N/A';
                break;
            case 'event__date_end': echo ($custom_fields['_stncl_event_date_end_field'][0]) ? date('d/m/Y', intval($custom_fields['_stncl_event_date_end_field'][0])) : 'N/A';
                break;
            case 'event__venue': echo $custom_fields['_stncl_event_venue_field'][0];
                break;
        }
    } public function add_meta_box()
    {
        global $post;
        add_meta_box('stncl-'.self::POST_NAME.'-section', self::POST_NAME_SENTENCE.' Options', array(&$this, 'meta_box'), self::POST_NAME, 'normal', 'high');
    } public function add_content_box()
    {
        global $_wp_post_type_features, $post;
        unset($_wp_post_type_features[self::POST_NAME]['editor']);
        add_meta_box('stncl-'.self::POST_NAME.'-content', self::POST_NAME_SENTENCE.' Details', array(&$this, 'content_box'), self::POST_NAME, 'normal', 'high');
    } public function meta_box()
    {
        global $post;
        $post_id = $post->ID;
        $custom_fields = get_post_custom($post->ID);
        $date_start = _is($custom_fields['_stncl_event_date_start_field'][0]);
        $date_end = _is($custom_fields['_stncl_event_date_end_field'][0]);
        $time = _is($custom_fields['_stncl_event_time'][0]);
        $venue = _is($custom_fields['_stncl_event_venue_field'][0]);
        $address = _is($custom_fields['_stncl_event_address_field'][0]);
        $city = _is($custom_fields['_stncl_event_city_field'][0]);
        $postcode = _is($custom_fields['_stncl_event_postcode_field'][0]);
        $contact_name = _is($custom_fields['_stncl_event_contact_name_field'][0]);
        $contact_email = _is($custom_fields['_stncl_event_contact_email_field'][0]);
        $contact_phone = _is($custom_fields['_stncl_event_contact_phone_field'][0]);
        $is_international = _is($custom_fields['_stncl_event_is_international_field'][0]);
        if (strpos($postcode, " ") !== false) {
            list($postcode_part_1, $postcode_part_2) = explode(" ", $postcode);
        } else {
            $postcode_part_1 = $postcode;
            $postcode_part_2 = "";
        } ?>
		
		<script>
			jQuery(document).ready(function($)
			{	
				// Dates --------------------------------------------------------------------------
				$("input.datepicker").datepicker({
					inline: true,
					showAnim: "fadeIn"
				});
			});
		</script>


		<input type="hidden" name="stncl_<?php echo self::POST_NAME; ?>_nonce" id="stncl_<?php echo self::POST_NAME; ?>_nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />

		<h4>Date and Time</h4>
		<ul class="stncl-form">
			<li>
				<label for="_stncl_event_date_start_field">Start</label>
				<input type="text" class="datepicker" id="_stncl_event_date_start_field" name="_stncl_event_date_start_field" value="<?php echo ($date_start) ? date('d/m/Y', intval($date_start)) : ''; ?>" />
			</li>
			<li class="hr">
				<label for="_stncl_event_date_end_field">End (if applicable)</label>
				<input type="text" class="datepicker" id="_stncl_event_date_end_field" name="_stncl_event_date_end_field" value="<?php echo ($date_end) ? date('d/m/Y', intval($date_end)) : ''; ?>" />
			</li>
			<li>
				<label for="_stncl_event_time">Time</label>
				<input type="text" id="_stncl_event_time" name="_stncl_event_time" value="<?php echo esc_attr($time); ?>" />
			</li>
		</ul>

		<h4>Location</h4>
		<ul class="stncl-form">
			<li>
				<label for="stncl_event_is_international_field">Is this an international event?</label>
				<input type="checkbox" id="stncl_event_is_international_field" 
									   name="stncl_event_is_international_field" <?php echo ($is_international) ? "checked" : ""; ?> value="1" />
			</li>
			<li>
				<label for="_stncl_event_venue_field">Venue Name</label>
				<input type="text" id="_stncl_event_venue_field" name="_stncl_event_venue_field" value="<?php echo esc_attr($venue); ?>" />
			</li>
			<li>
				<label for="_stncl_event_address_field">Address</label>
				<input type="text" id="_stncl_event_address_field" name="_stncl_event_address_field" value="<?php echo esc_attr($address); ?>" />
			</li>
			<li>
				<label for="_stncl_event_city_field">City</label>
				<input type="text" id="_stncl_event_city_field" name="_stncl_event_city_field" value="<?php echo esc_attr($city); ?>" />
			</li>
			<li>
				<label for="_stncl_event_postcode_part_1_field">Post Code</label>
				<input class="tiny" type="text" id="_stncl_event_postcode_part_1_field" name="_stncl_event_postcode_part_1_field" value="<?php echo esc_attr($postcode_part_1); ?>" />
				<input class="tiny" type="text" id="_stncl_event_postcode_part_2_field" name="_stncl_event_postcode_part_2_field" value="<?php echo esc_attr($postcode_part_2); ?>" />
			</li>
		</ul>
		
		<h4>Contact</h4>
		<ul class="stncl-form">
			<li>
				<label for="_stncl_event_contact_name_field">Name</label>
				<input type="text" id="_stncl_event_contact_name_field" name="_stncl_event_contact_name_field" value="<?php echo esc_attr($contact_name); ?>" />
			</li>
			<li>
				<label for="_stncl_event_contact_email_field">Email</label>
				<input type="text" id="_stncl_event_contact_email_field" name="_stncl_event_contact_email_field" value="<?php echo esc_attr($contact_email); ?>" />
			</li>
			<li>
				<label for="_stncl_event_contact_phone_field">Phone</label>
				<input type="text" id="_stncl_event_contact_phone_field" name="_stncl_event_contact_phone_field" value="<?php echo esc_attr($contact_phone); ?>" />
			</li>
		</ul>

		<hr />

		<?php ?>
		
	<?php  } public function content_box($post)
	{
	    $wp_editor_settings = array( 'media_buttons' => false, 'textarea_rows' => 5, 'tinymce' => array( "toolbar1" => "bold,italic,bullist,numlist,link,unlink,removeformat,undo,redo", "toolbar2" => "", "autoresize_min_height" => 40, "autoresize_max_height" => 400, "paste_as_text" => true, "content_css" => get_stylesheet_directory_uri() . "/editor-style.css?7" ) ); ?>
		<style>
		/*	#stncl-event-content iframe {
				background: #fff;
			}
			#stncl-event-content .inside {
				margin: 10px -1px -1px!important;
			}

			#stncl-event-content.postbox .inside,
			#stncl-event-content.stuffbox .inside {
				padding: 0!important;
			}

			#stncl-event-content.postbox #wp-content-media-buttons { padding: 0 0 0 0.9em; }*/

		</style>
		<?php
 wp_editor($post->post_content, 'content', $wp_editor_settings);
	} public function save_postdata($post_id)
	{
	    if (!isset($_POST['stncl_'.self::POST_NAME.'_nonce'])) {
	        return $post_id;
	    } if (!wp_verify_nonce($_POST['stncl_'.self::POST_NAME.'_nonce'], plugin_basename(__FILE__))) {
	        return $post_id;
	    } if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	        return $post_id;
	    } if ('page' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post_id)) {
	            return $post_id;
	        }
	    } else {
	        if (!current_user_can('edit_post', $post_id)) {
	            return $post_id;
	        }
	    } $date_start = _is($_POST['_stncl_event_date_start_field']);
	    $date_start = strtotime(str_replace("/", "-", $date_start));
	    _spd($post_id, '_stncl_event_date_start_field', $date_start);
	    $date_end = _is($_POST['_stncl_event_date_end_field']);
	    $date_end = strtotime(str_replace("/", "-", $date_end));
	    _spd($post_id, '_stncl_event_date_end_field', $date_end);
	    $time = _is($_POST['_stncl_event_time']);
	    _spd($post_id, '_stncl_event_time', $time);
	    $is_international = _is($_POST['stncl_event_is_international_field']);
	    _spd($post_id, '_stncl_event_is_international_field', $is_international);
	    $venue = _is($_POST['_stncl_event_venue_field']);
	    _spd($post_id, '_stncl_event_venue_field', $venue);
	    $address = _is($_POST['_stncl_event_address_field']);
	    _spd($post_id, '_stncl_event_address_field', $address);
	    $city = _is($_POST['_stncl_event_city_field']);
	    _spd($post_id, '_stncl_event_city_field', $city);
	    $postcode_part_1 = strtoupper(trim(_is($_POST['_stncl_event_postcode_part_1_field'])));
	    $postcode_part_2 = strtoupper(trim(_is($_POST['_stncl_event_postcode_part_2_field'])));
	    $postcode = trim($postcode_part_1 . " " . $postcode_part_2);
	    _spd($post_id, '_stncl_event_postcode_field', $postcode);
	    $contact_name = _is($_POST['_stncl_event_contact_name_field']);
	    _spd($post_id, '_stncl_event_contact_name_field', $contact_name);
	    $contact_email = _is($_POST['_stncl_event_contact_email_field']);
	    _spd($post_id, '_stncl_event_contact_email_field', $contact_email);
	    $contact_phone = _is($_POST['_stncl_event_contact_phone_field']);
	    _spd($post_id, '_stncl_event_contact_phone_field', $contact_phone);
	    return true;
	}
}
