<?php
if (!function_exists('shortcode_chasseralSnow_webcam')) {
    function shortcode_chasseralSnow_webcam()
    {
        global $wpdb;
        $query = <<<SQL
            SELECT 
                   `url_web`,
                   `nom_web`,
                   `def_web`
            FROM 
                 `{$wpdb->prefix}bs_webcam` 
                    AS `w`
            LEFT JOIN 
                `{$wpdb->prefix}bs_bulletin` 
                    AS `b` 
                    ON 
                        `b`.`id_web` = `w`.`id_web`
            ORDER BY 
                     `b`.`id_bul` 
                     DESC LIMIT 1
SQL;

        $result_web = $wpdb->get_results($query);
        ob_start();
        foreach ($result_web as $val) {
                ?>
                <div>
                    <label><?= $val->nom_web ?></label>
                    <br>
                    <img width='450' height='250' src='<?= $val->url_web ?>'>
                </div>
                <?php
            $output = ob_get_clean();
            return $output;
        }
    }

    add_shortcode('shortcode_chasseralSnow_web', 'shortcode_chasseralSnow_webcam');
}
