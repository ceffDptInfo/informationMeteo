<?php
if (!function_exists('shortcode_chasseralSnow_pistes')){
    function shortcode_chasseralSnow_pistes(){
        global $wpdb;
        $query = <<<SQL
SELECT
	            `p`.`etat_pst`
            FROM 
                 `wp_bs_bulletin` 
                     AS `b`
            LEFT JOIN 
                     `wp_bs_pistes` 
                         AS `p` 
                         ON `b`.`id_pst` = `p`.`id_pst`
            ORDER BY 
                     `id_bul` 
                     DESC  LIMIT 1
SQL;
        $result_pst = $wpdb->get_var($query);

        return "<div>
            <label for='heure'> État des pistes :  $result_pst </label>
        </div>
        ";
    }
    add_shortcode('shortcode_chasseralSnow_pst', 'shortcode_chasseralSnow_pistes');
}
