<?php
if (!function_exists('shortcode_chasseralSnow_neige')){
    function shortcode_chasseralSnow_neige(){
        global $wpdb;
        $query = <<<SQL
        SELECT
	            `n`.`etat_nge`
            FROM 
                 `{$wpdb->prefix}bs_bulletin` 
                     AS `b`
            LEFT JOIN 
                     `{$wpdb->prefix}bs_neige` 
                         AS `n` 
                         ON `b`.`id_nge` = `n`.`id_nge`
            ORDER BY 
                     `id_bul` 
                     DESC  LIMIT 1
                     
SQL;
        $result_nge = $wpdb->get_var($query);

        return "<div>
            <label for='heure'> Enneigement :  $result_nge </label>
        </div>
        ";
    }
    add_shortcode('shortcode_chasseralSnow_nge', 'shortcode_chasseralSnow_neige');
}
