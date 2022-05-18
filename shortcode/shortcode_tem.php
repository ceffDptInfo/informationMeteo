<?php
if (!function_exists('shortcode_chasseralSnow_temperature')){
    function shortcode_chasseralSnow_temperature(){
        global $wpdb;
        $query = <<<SQL
            SELECT temperature_bul FROM {$wpdb->prefix}bs_bulletin ORDER BY id_bul DESC LIMIT 1
SQL;
        $result_bul= $wpdb->get_var($query);


        return "<div>
            <label> $result_bul ° </label>
        </div>
        ";
    }
    add_shortcode('shortcode_chasseralSnow_tem', 'shortcode_chasseralSnow_temperature');
}
