<?php
if (!function_exists('shortcode_chasseralSnow_meteo')){
    function shortcode_chasseralSnow_meteo(){
        global $wpdb;
        $query = <<< SQL
            SELECT
	            `m`.`id_met`
            FROM 
                 `{$wpdb->prefix}bs_bulletin` 
                     AS `b`
            LEFT JOIN 
                     `{$wpdb->prefix}bs_meteo` 
                         AS `m` 
                         ON `b`.`id_met` = `m`.`id_met`
            ORDER BY 
                     `id_bul` 
                     DESC  LIMIT 1
SQL;

        $result_met = $wpdb->get_var($query);
        $path = plugin_dir_url( dirname( __FILE__ ));
        return "
        <div>
        <img src=\"$path/imageMeteo/$result_met.png\">
        </div>
        "
        ;
    }
    add_shortcode('shortcode_chasseralSnow_met', 'shortcode_chasseralSnow_meteo');
}
