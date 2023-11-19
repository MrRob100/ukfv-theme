<?php
class Stncl_person_model extends Stncl_model
{
    public const POST_NAME = 'person';
    public const POST_NAME_PLURAL = 'persons';
    public const POST_NAME_SENTENCE = 'Player';
    public const POST_NAME_PLURAL_SENTENCE = 'Players';
    public function __construct()
    {
        parent::__construct();
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save_postdata'));
        $this->post_type_config = array( 'public' => true, 'exclude_from_search' => false, 'show_ui' => true, 'menu_icon' => 'dashicons-businessman', 'menu_position' => 30, 'capability_type' => 'custom', 'hierarchical' => false, 'has_archive' => false, 'rewrite' => array('slug' => self::POST_NAME, 'with_front' => false), 'query_var' => true, 'supports' => array('title', 'editor', 'thumbnail', 'page-attributes') );
    } public function register_group_taxonomy()
    {
        $labels = array( 'name' => _x('Group', 'taxonomy general name'), 'singular_name' => _x('Group', 'taxonomy singular name'), 'search_items' => __('Search Groups'), 'all_items' => __('All Groups'), 'parent_item' => __('Parent Group'), 'parent_item_colon' => __('Parent Group:'), 'edit_item' => __('Edit Group'), 'update_item' => __('Update Group'), 'add_new_item' => __('Add New Group'), 'new_item_name' => __('New Group Name'), 'menu_name' => __('Group'), );
        register_taxonomy('stncl_group', array('person'), array( 'hierarchical' => true, 'labels' => $labels, 'show_ui' => true, 'query_var' => true, 'rewrite' => false ));
    } public function pre_get_posts($query)
    {
        if (! is_admin()) {
            if (isset($query->query_vars['post_type']) and $query->query_vars['post_type'] == "person" or $query->is_archive and isset($query->query_vars['stncl_group'])) {
                if (! isset($query->query_vars['posts_per_page'])) {
                    $query->set('posts_per_page', -1);
                } $query->set('orderby', 'title');
                $query->set('order', 'ASC');
                return $query;
            }
        } return $query;
    } public function filter_columns($columns)
    {
        $columns = array( "cb" => "<input type=\"checkbox\" />", "person__id" => "ID", "title" => "Name", "person__role" => "Role" );
        return $columns;
    } public function post_columns($column)
    {
        global $post;
        $custom_fields = get_post_custom($post->ID);
        switch($column) {
            case 'person__id': echo $post->ID;
                break;
            case 'person__role': echo esc_attr($custom_fields['_stncl_person_role_field'][0]);
                break;
        }
    } public function add_meta_box()
    {
        add_meta_box('stncl-'.self::POST_NAME.'-section', self::POST_NAME_SENTENCE.' Options', array($this, 'meta_box'), self::POST_NAME, 'normal');
    } public function meta_box()
    {
        global $post;
        $custom_fields = get_post_custom($post->ID);
        $role = _is($custom_fields['_stncl_person_role_field'][0]); ?>
				
		<input type="hidden" 
				name="stncl_<?php echo self::POST_NAME; ?>_nonce" 
				id="stncl_<?php echo self::POST_NAME; ?>_nonce" 
				value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
		
		<table class="form-table">

			<tr>
				<th scope="row">
					<label for="_stncl_person_role_field">Role</label>
				</th>
				<td>
					<input type="text" class="large-text" id="_stncl_person_role_field" name="_stncl_person_role_field" value="<?php echo esc_attr($role); ?>" />
				</td>
			</tr>

		</table>
		
	<?php  } public function save_postdata($post_id)
	{
	    if (!isset($_POST['stncl_'.self::POST_NAME.'_nonce'])) {
	        return $post_id;
	    } if (!wp_verify_nonce($_POST['stncl_'.self::POST_NAME.'_nonce'], plugin_basename(__FILE__))) {
	        return $post_id;
	    } if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	        return $post_id;
	    } if (!current_user_can('edit_'.self::POST_NAME, $post_id)) {
	        return $post_id;
	    } _spd($post_id, '_stncl_person_role_field', _is($_POST['_stncl_person_role_field']));
	    return true;
	}
}
