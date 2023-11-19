<?php

class Stncl
{
    public $flashmessage;
    public $viewscounter;
    public $settings = array();
    public $template_filename;
    public $template;
    public function __construct()
    {
        add_action('after_setup_theme', array( $this, 'init_constants' ), 1);
        add_action('after_setup_theme', array( $this, 'init_core' ), 2);
        add_action('template_include', array( $this, 'init_template' ), 999);
    } public function init_constants()
    {
        if (!defined('STNCL_VERSION')) {
            define('STNCL_VERSION', '0.2');
        } if (!defined('STNCL_CLASS_PREFIX')) {
            define('STNCL_CLASS_PREFIX', 'Stncl_');
        } if (!defined('STNCL_DATE_FORMAT')) {
            define('STNCL_DATE_FORMAT', get_option('date_format'));
        } if (!defined('THEME_DIR')) {
            define('THEME_DIR', get_template_directory());
        } if (!defined('THEME_URI')) {
            define('THEME_URI', get_template_directory_uri());
        } if (!defined('CHILD_THEME_DIR')) {
            define('CHILD_THEME_DIR', get_stylesheet_directory());
        } if (!defined('CHILD_THEME_URI')) {
            define('CHILD_THEME_URI', get_stylesheet_directory_uri());
        } if (!defined('STNCL_DIR')) {
            define('STNCL_DIR', trailingslashit(THEME_DIR) . basename(dirname(__FILE__)));
        } if (!defined('STNCL_URI')) {
            define('STNCL_URI', trailingslashit(THEME_URI) . basename(dirname(__FILE__)));
        } if (!defined('STNCL_CONFIG')) {
            define('STNCL_CONFIG', trailingslashit(STNCL_DIR) . 'config');
        } if (!defined('STNCL_CORE')) {
            define('STNCL_CORE', trailingslashit(STNCL_DIR) . 'core');
        } if (!defined('STNCL_HELPERS')) {
            define('STNCL_HELPERS', trailingslashit(STNCL_DIR) . 'helpers');
        } if (!defined('STNCL_LIBRARIES')) {
            define('STNCL_LIBRARIES', trailingslashit(STNCL_DIR) . 'libraries');
        } if (!defined('STNCL_LOGS')) {
            define('STNCL_LOGS', trailingslashit(STNCL_DIR) . 'logs');
        } if (!defined('STNCL_MODELS')) {
            define('STNCL_MODELS', trailingslashit(STNCL_DIR) . 'models');
        } if (!defined('STNCL_CONTROLLERS')) {
            define('STNCL_CONTROLLERS', trailingslashit(STNCL_DIR) . 'controllers');
        } if (!defined('STNCL_VIEWS')) {
            define('STNCL_VIEWS', trailingslashit(THEME_DIR) . 'views');
        } if (!defined('STNCL_ASSETS')) {
            define('STNCL_ASSETS', trailingslashit(STNCL_URI) . 'assets');
        }
    } public function init_core()
    {
        require_once(trailingslashit(STNCL_MODELS) . 'stncl_model.php');
        require_once(trailingslashit(STNCL_CORE) . 'stncl_template.php');
        require_once(trailingslashit(STNCL_CORE) . 'stncl_flashmessage.php');
        $this->flashmessage = new Stncl_flashmessage();
    } public function init_template($template)
    {
        $this->template_filename = basename($template);
        $this->template = str_replace('.php', '', $this->template_filename);
        return $template;
    } public function load($type, $files)
    {
        $files = (array)$files;
        switch($type) {
            case 'config': $path = STNCL_CONFIG;
                break;
            case 'helper': $path = STNCL_HELPERS;
                break;
            case 'model': $path = STNCL_MODELS;
                break;
        } if ($type == 'model') {
            foreach($files as $file) {
                $request = trailingslashit($path) . strtolower(STNCL_CLASS_PREFIX) . $file . '_model.php';
                if (is_file($request)) {
                    require_once($request);
                    $class = STNCL_CLASS_PREFIX . $file . '_model';
                    $this->{$file.'_model'} = new $class();
                } else {
                }
            }
        } if ($type == 'config') {
            foreach($files as $file) {
                $request = trailingslashit($path) . $file . '.php';
                if (is_file($request)) {
                    require_once($request);
                } else {
                }
            }
        } if ($type == 'helper') {
            foreach($files as $file) {
                $request = trailingslashit($path) . $file . '_helper.php';
                if (is_file($request)) {
                    require_once($request);
                } else {
                }
            }
        }
    } public function load_view($view, $vars = array(), $return = false)
    {
        extract($vars);
        ob_start();
        $path = trailingslashit(STNCL_VIEWS) . $view . '.php';
        if (file_exists($path)) {
            include($path);
            if ($return === true) {
                $buffer = ob_get_contents();
                @ob_end_clean();
                return $buffer;
            }
        } ob_end_flush();
    } public function load_library($name, $filename, $classname, $config)
    {
        $request = trailingslashit(STNCL_LIBRARIES) . $filename;
        if (is_file($request)) {
            require_once($request);
            $this->{$name} = new $classname($config);
        } else {
        }
    } public function log($str)
    {
        if($fh = @fopen(trailingslashit(STNCL_LOGS)."log-".date('Y-m-d').".txt", "a")) {
            $time = date('Y-m-d H:i:s');
            fwrite($fh, "$time $str". "\n");
            fclose($fh);
            return true;
        } else {
            return false;
        }
    }
} function stncl_log($user_id, $post_id, $message)
{
    global $stncl;
    $stncl->log("User ID: $user_id / Post ID: $post_id / $message");
}
