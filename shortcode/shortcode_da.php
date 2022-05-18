<?php
setlocale (LC_TIME, 'fr_FR.utf8','fra');
if (!function_exists('shortcode_chasseralSnow_date')){
    function shortcode_chasseralSnow_date(){
        global $wpdb;
        $query =<<<SQL
            SELECT date_bul FROM {$wpdb->prefix}bs_bulletin ORDER BY id_bul DESC LIMIT 1
SQL;

        $result_da = $wpdb->get_var($query);
        $da = strftime('%A %d %B ', strtotime($result_da));
        return "<div>
            <label for='heure'> $da </label>
        </div>
        ";
    }
    add_shortcode('shortcode_chasseralSnow_da', 'shortcode_chasseralSnow_date');
}
