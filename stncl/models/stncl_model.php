<?php
class Stncl_model
{
    public $post_type_config;
    public function __construct()
    {
        add_action('init', array($this, 'register_post_type'));
        add_action('admin_init', array($this, 'add_capabilities'));
        add_filter('post_updated_messages', array($this, 'post_messages'));
        add_action('manage_'.static::POST_NAME.'_posts_custom_column', array($this, 'post_columns'));
        add_filter('manage_edit-'.static::POST_NAME.'_columns', array($this, 'filter_columns'), 100);
    } public function register_post_type()
    {
        $labels = array( 'name' => _x(static::POST_NAME_PLURAL_SENTENCE, 'post type general name'), 'singular_name' => _x(static::POST_NAME_SENTENCE, 'post type singular name'), 'add_new' => _x('Add New', static::POST_NAME_PLURAL), 'add_new_item' => __('Add '.static::POST_NAME_SENTENCE), 'edit_item' => __('Edit '.static::POST_NAME_SENTENCE), 'new_item' => __('New '.static::POST_NAME_SENTENCE), 'all_items' => __('All '.static::POST_NAME_PLURAL_SENTENCE), 'view_item' => __('View '.static::POST_NAME_SENTENCE), 'search_items' => __('Search '.static::POST_NAME_PLURAL_SENTENCE), 'not_found' => __('No '.static::POST_NAME_PLURAL.' found'), 'not_found_in_trash' => __('No '.static::POST_NAME_PLURAL.' found in Trash'), 'parent_item_colon' => '', 'menu_name' => __(static::POST_NAME_PLURAL_SENTENCE) );
        $default_config = array( 'labels' => $labels, 'public' => true, 'exclude_from_search' => false, 'show_ui' => true, 'menu_icon' => 'dashicons-admin-site', 'menu_position' => 30, 'capability_type' => 'post', 'hierarchical' => false, 'has_archive' => static::POST_NAME_PLURAL, 'rewrite' => array('slug' => static::POST_NAME, 'with_front' => false), 'query_var' => true, 'supports' => array('title', 'editor', 'excerpt', 'thumbnail') );
        if ($this->post_type_config['capability_type'] != 'post') {
            $default_config['capabilities'] = array( 'create_post' => 'create_'.static::POST_NAME, 'create_posts' => 'create_'.static::POST_NAME_PLURAL, 'edit_posts' => 'edit_'.static::POST_NAME_PLURAL, 'edit_private_post' => 'edit_private_'.static::POST_NAME, 'edit_private_posts' => 'edit_private_'.static::POST_NAME_PLURAL, 'edit_others_posts' => 'edit_other_'.static::POST_NAME_PLURAL, 'publish_posts' => 'publish_'.static::POST_NAME_PLURAL, 'edit_published_posts' => 'edit_published_'.static::POST_NAME_PLURAL, 'read_private_posts' => 'read_private_'.static::POST_NAME_PLURAL, 'delete_posts' => 'delete_'.static::POST_NAME_PLURAL, 'delete_published_posts' => 'delete_published_'.static::POST_NAME_PLURAL, 'delete_private_post' => 'delete_private_'.static::POST_NAME, 'delete_private_posts' => 'delete_private_'.static::POST_NAME_PLURAL, 'delete_others_posts' => 'delete_others_'.static::POST_NAME_PLURAL, );
            $default_config['capability_type'] = array(static::POST_NAME, static::POST_NAME_PLURAL);
            $default_config['map_meta_cap'] = true;
        } register_post_type(static::POST_NAME, array_merge($default_config, $this->post_type_config));
    } public function add_capabilities()
    {
        if ($this->post_type_config['capability_type'] == 'post') {
            return;
        } $admin = get_role('administrator');
        $caps = array( 'create_'.static::POST_NAME, 'create_'.static::POST_NAME_PLURAL, 'edit_'.static::POST_NAME_PLURAL, 'edit_private_'.static::POST_NAME, 'edit_private_'.static::POST_NAME_PLURAL, 'edit_other_'.static::POST_NAME_PLURAL, 'publish_'.static::POST_NAME_PLURAL, 'edit_published_'.static::POST_NAME_PLURAL, 'read_private_'.static::POST_NAME_PLURAL, 'delete_'.static::POST_NAME_PLURAL, 'delete_published_'.static::POST_NAME_PLURAL, 'delete_private_'.static::POST_NAME, 'delete_private_'.static::POST_NAME_PLURAL, 'delete_others_'.static::POST_NAME_PLURAL, );
        foreach ($caps as $cap) {
            $admin->add_cap($cap);
        }
    } public function post_messages($messages)
    {
        global $post;
        $post_ID = $post->ID;
        $messages[static::POST_NAME] = array( 0 => '', 1 => sprintf(__(static::POST_NAME_SENTENCE.' updated. <a href="%s">View '.static::POST_NAME_SENTENCE.'</a>'), esc_url(get_permalink($post_ID))), 2 => __('Custom field updated.'), 3 => __('Custom field deleted.'), 4 => __(static::POST_NAME_SENTENCE.' updated.'), 5 => isset($_GET['revision']) ? sprintf(__('Post restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false, 6 => sprintf(__(static::POST_NAME_SENTENCE.' published. <a href="%s">View '.static::POST_NAME_SENTENCE.'</a>'), esc_url(get_permalink($post_ID))), 7 => __(static::POST_NAME_SENTENCE.' saved.'), 8 => sprintf(__('Post submitted. <a target="_blank" href="%s">Preview post</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))), 9 => sprintf(__('Post scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview post</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))), 10 => sprintf(__(static::POST_NAME_SENTENCE.' draft updated. <a target="_blank" href="%s">Preview '.static::POST_NAME_SENTENCE.'</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))), );
        return $messages;
    } public function filter_columns($column)
    {
    } public function list_tax_alphabetical($tax)
    {
        global $post;
        $tax_terms = wp_get_object_terms($post->ID, $tax);
        if (! count($tax_terms)) {
            $tax_terms = 'N/A';
        } else {
            foreach($tax_terms as $t) {
                $taxes[] = $t->name;
            } asort($taxes);
            $tax_terms = implode(", ", $taxes);
        } return $tax_terms;
    } public function form_row_input($label, $id, $value = null, $placeholder = null, $description = null)
    { ?>
		<tr>
			<th class="compact" scope="row">
				<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
			</th>
			<td>
				<input type="text" class="large-text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>" />
				<?php if ($description) { ?>
					<p><span class="description"><?php echo $description; ?></span></p>
				<?php } ?>
			</td>
		</tr>
		<?php
    } public function form_row_checkbox($label, $id, $value = null, $placeholder = null, $description = null)
    { ?>
		<tr>
			<th class="compact" scope="row">
				<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
			</th>
			<td>
				<?php echo form_checkbox($id, '1', (bool)$value, 'id="'.$id.'"'); ?>
				<?php if ($description) { ?>
					<p><span class="description"><?php echo $description; ?></span></p>
				<?php } ?>
			</td>
		</tr>
		<?php
    } public function form_row_datepicker($label, $id, $value = null, $placeholder = null)
    { ?>
		<tr>
			<th class="compact" scope="row">
				<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
			</th>
			<td>
				<input type="text" class="datepicker" id="<?php echo $id; ?>" name="<?php echo $id; ?>" 
						value="<?php echo ($value) ? date('d/m/Y', intval($value)) : ''; ?>" placeholder="<?php echo $placeholder; ?>" />
			</td>
		</tr>
		<?php
    } public function form_row_select($label, $id, $options = null, $value = null)
    { ?>
		<tr>
			<th class="compact" scope="row">
				<label for="<?php echo $id; ?>"><?php echo $label; ?></label>
			</th>
			<td>
				<?php echo form_dropdown($id, $options, $value); ?>
			</td>
		</tr>
		<?php
    } public function form_select($input_id, $input_name, $selected_value)
    {
        global $post; ?>
		<select id="<?php echo $input_id; ?>" name="<?php echo $input_name; ?>">
			<option value="0"></option>
			<?php
        $person_query = new WP_Query(array( 'post_type' => static::POST_NAME, 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'title' ));
        while ($person_query->have_posts()) {
            $person_query->the_post();
            echo '<option value="' . $post->ID . '" '.($selected_value == $post->ID ? 'selected="selected"' : '').'>' . esc_attr($post->post_title) . '</option>' . "\n";
        } wp_reset_postdata(); ?>
		</select>
	<?php
    }
}
