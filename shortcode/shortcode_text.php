<?php
if (!function_exists('shortcode_chasseralSnow_text')){
    function shortcode_chasseralSnow_text(){
        global $wpdb;
        $query = <<<SQL
            SELECT text_bul FROM {$wpdb->prefix}bs_bulletin ORDER BY id_bul DESC LIMIT 1
SQL;
        $result_bul = $wpdb->get_var($query);


        return "<div>
            <img src='$result_bul'>
            
     </div>
        ";
    }
    add_shortcode('shortcode_chasseralSnow_txt', 'shortcode_chasseralSnow_text');
}
