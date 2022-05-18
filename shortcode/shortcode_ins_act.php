<?php
if (!function_exists('shortcode_chasseralSnow_installations_active')) {
    function shortcode_chasseralSnow_installations_active()
    {
        global $wpdb;
        $query = <<< SQL
            SELECT
                `i`.`id_ins`
                , `i`.`nom_ins`
                , IF(`ia`.`date_iac` IS NULL, FALSE, TRUE) AS `isActive`
            FROM `{$wpdb->prefix}bs_installations` AS `i`
            LEFT JOIN (
                SELECT 
                    `id_ins`
                    , IF(
                        max(`date_iac`) = CURRENT_DATE(),
                        CURRENT_DATE(),
                        NULL
                    ) AS `date_iac`
                FROM `{$wpdb->prefix}bs_installations_active`
                GROUP BY `id_ins`
            ) AS `ia`
            ON `i`.`id_ins` = `ia`.`id_ins`;
        
SQL;
// depuit data base à une array
        $result = $wpdb->get_results($query);
        $path = plugin_dir_url(dirname(__FILE__));
        ob_start();
        ?>
        <table class="table">
            <thead>
            <tr>
                <th colspan="2">
                    installation
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result AS $val) { ?>
                <tr>
                    <td><?= $val->nom_ins ?></td>
                    <td><?php
                        if ($val->isActive == 1) {
                            ?>
                            <img class="isActiveImg" src="<?= $path ?>/imageIsActive/green.png">
                            <?php
                        } else { ?>
                            <img class="isActiveImg" src="<?= $path ?>/imageIsActive/red.png">
                            <?php
                        }
                        ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
        $output = ob_get_clean();
    return $output;
    }

    add_shortcode('shortcode_chasseralSnow_ins_act', 'shortcode_chasseralSnow_installations_active');
}
