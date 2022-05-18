<?php
if (!function_exists('shortcode_chasseralSnow_heure')){
    function shortcode_chasseralSnow_heure(){
        global $wpdb;
        $query = <<<SQL
            SELECT heure_bul FROM {$wpdb->prefix}bs_bulletin ORDER BY id_bul DESC LIMIT 1
SQL;
        $result_hr = $wpdb->get_var($query);
        $hr = date('H:i', strtotime($result_hr));
        return "<div>
            <label for='heure'>Météo à  $hr </label>
        </div>
        ";
    }
    add_shortcode('shortcode_chasseralSnow_hr', 'shortcode_chasseralSnow_heure');
}
