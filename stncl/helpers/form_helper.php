<?php if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
} if (! function_exists('form_dropdown')) {
    function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '', $first = '')
    {
        if (! is_array($selected)) {
            $selected = array($selected);
        } if (count($selected) === 0) {
            if (isset($_POST[$name])) {
                $selected = array($_POST[$name]);
            }
        } if ($extra != '') {
            $extra = ' '.$extra;
        } $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === false) ? ' multiple="multiple"' : '';
        $form = '<select name="'.$name.'"'.$extra.$multiple.">\n";
        if ($first) {
            $form .= '<option value="0" disabled selected>' . $first . '</option>' ."\n";
        } foreach ($options as $key => $val) {
            $key = (string) $key;
            if (is_array($val)) {
                $form .= '<optgroup label="'.$key.'">'."\n";
                foreach ($val as $optgroup_key => $optgroup_val) {
                    $sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';
                    $form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
                } $form .= '</optgroup>'."\n";
            } else {
                $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';
                $form .= '<option value="'.$key.'"'.$sel.'>'.(string) $val."</option>\n";
            }
        } $form .= '</select>';
        return $form;
    }
} if (! function_exists('form_checkbox')) {
    function form_checkbox($data = '', $value = '', $checked = false, $extra = '')
    {
        $defaults = array('type' => 'checkbox', 'name' => ((! is_array($data)) ? $data : ''), 'value' => $value);
        if (is_array($data) and array_key_exists('checked', $data)) {
            $checked = $data['checked'];
            if ($checked == false) {
                unset($data['checked']);
            } else {
                $data['checked'] = 'checked';
            }
        } if ($checked == true) {
            $defaults['checked'] = 'checked';
        } else {
            unset($defaults['checked']);
        } return "<input "._parse_form_attributes($data, $defaults).$extra." />";
    }
} if (! function_exists('form_prep')) {
    function form_prep($str = '', $field_name = '')
    {
        static $prepped_fields = array();
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $str[$key] = form_prep($val);
            } return $str;
        } if ($str === '') {
            return '';
        } if (isset($prepped_fields[$field_name])) {
            return $str;
        } $str = htmlspecialchars($str);
        $str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);
        if ($field_name != '') {
            $prepped_fields[$field_name] = $field_name;
        } return $str;
    }
} if (! function_exists('_parse_form_attributes')) {
    function _parse_form_attributes($attributes, $default)
    {
        if (is_array($attributes)) {
            foreach ($default as $key => $val) {
                if (isset($attributes[$key])) {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            } if (count($attributes) > 0) {
                $default = array_merge($default, $attributes);
            }
        } $att = '';
        foreach ($default as $key => $val) {
            if ($key == 'value') {
                $val = form_prep($val, $default['name']);
            } $att .= $key . '="' . $val . '" ';
        } return $att;
    }
}
