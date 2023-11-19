<?php
class Stncl_flashmessage
{
    public $admin_notices;
    public $transient_name = 'stncl_flashmessage';
    public function __construct()
    {
        add_action('admin_head', array( &$this, 'admin_header' ));
        $this->admin_notices = get_transient($this->transient_name);
        if (!is_array($this->admin_notices)) {
            $this->admin_notices = array();
        } $this->admin_notices = array_unique($this->admin_notices);
    } public function admin_header()
    {
        if (count($this->admin_notices) > 0) {
            add_action('admin_notices', array( &$this, 'print_admin_notice' ));
        }
    } public function print_admin_notice()
    { ?>
		<?php foreach((array) $this->admin_notices as $notice) {
		    if (strpos($notice, 'ERROR|') === false) {
		        $class = "updated";
		    } else {
		        $notice = str_replace("ERROR|", "", $notice);
		        $class = "error";
		    } ?>
			<div class="<?php echo $class; ?>">	
				<p><?php echo $notice ?></p>
			</div>	
		<?php } ?>
	
	<?php
 $this->admin_notices = array();
        delete_transient($this->transient_name);
    } public function add($message)
    {
        $this->admin_notices[] = $message;
        set_transient($this->transient_name, $this->admin_notices, 3600);
    }
}
