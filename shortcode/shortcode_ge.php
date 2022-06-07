<?php
if (!function_exists('shortcode_chasseralSnow_general')) {
    function shortcode_chasseralSnow_general()
    {
        global $wpdb;
        $query = <<<SQL
            SELECT
                `b`.`heure_bul`, `b`.`date_bul`, `b`.`temperature_bul`, `b`.`id_met`, `p`.`etat_pst`, `n`.`etat_nge`, `w`.`url_web`, `b`.`texte_bul`
            FROM
                `{$wpdb->prefix}bs_bulletin` AS `b`
            LEFT JOIN
                    `{$wpdb->prefix}bs_meteo` AS `m`
                        ON `b`.`id_met` = `m`.`id_met`
            LEFT JOIN
                    `{$wpdb->prefix}bs_pistes` AS `p`
                        ON `b`.`id_pst` = `p`.`id_pst`
            LEFT JOIN
                    `{$wpdb->prefix}bs_neige` AS `n`
                        ON `b`.`id_nge` = `n`.`id_nge`
            LEFT JOIN
                    `{$wpdb->prefix}bs_webcam` AS `w`
                        ON `b`.`id_web` = `w`.`id_web`
            ORDER BY
                     `b`.`id_bul`
                        DESC LIMIT 1
SQL;

        $query1 = <<< SQL
            SELECT
                `i`.`id_ins`
                , `i`.`nom_ins`
                , IF(`ia`.`date_ins` IS NULL, FALSE, TRUE) AS `isActive`
            FROM `{$wpdb->prefix}bs_installations` AS `i`
            LEFT JOIN (
                SELECT
                    `id_ins`
                    , IF(
                        max(`date_ins`) = CURRENT_DATE(),
                        CURRENT_DATE(),
                        NULL
                    ) AS `date_ins`
                FROM `{$wpdb->prefix}bs_installations_active`
                GROUP BY `id_ins`
            ) AS `ia`
            ON `i`.`id_ins` = `ia`.`id_ins`;
SQL;
        $result = $wpdb->get_results($query);
        $result1 = $wpdb->get_results($query1);

        $path = plugin_dir_url(dirname(__FILE__));

        ob_start();

        foreach ($result as $val) { ?>
            <article class="content-meteo gap-1 d-flex flex-column flex-xl-row">
                <img src="<?= $val->url_web ?>">
                <section class="d-flex flex-column flex-grow-1">
                    <div class="d-flex d-xl-none mb-2 p-1 gap-2 flex-column bg-white">
                        <div class="d-flex flex-row gap-2 justify-content-around">
                            <p><?= "Météo à " . date('H:i', strtotime($val->heure_bul)); ?></p>
                            <p class="d-block d-xl-none"><?= strftime('%A %d %B ', strtotime($val->date_bul)) ?></p>
                        </div>
                        <div class="text-center">
                            <img class="w-auto" src="<?= $path ?>imageMeteo/<?= $val->id_met ?>.png">
                            <span><?= $val->temperature_bul ?>°</span>
                        </div>
                    </div>
                    <section class="d-flex mb-1 p-1 gap-2 flex-row bg-white">
                        <div class="flex-column d-none d-xl-flex">
                            <p class="mb-0"><?= "Météo à " . date('H:i', strtotime($val->heure_bul)); ?></p>
                            <div class="text-center">
                                <img class="w-50" src="<?= $path ?>imageMeteo/<?= $val->id_met ?>.png">
                                <div><?= $val->temperature_bul ?>°</div>
                            </div>
                        </div>
                        <div class="flex-row">
                            <p class="d-none d-xl-block"><?= strftime('%A %d %B ', strtotime($val->date_bul)) ?></p>
                            <p>État des pistes : <?= $val->etat_pst ?></p>
                            <p>Enneigement : <?= $val->etat_nge ?></p>
                        </div>
                        <?php
                        if ($val->texte_bul != "") {
                        ?>
                            <div class="d-flex col col-xl-4">
                                <p class="text-break">Infos : <?= $val->texte_bul ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    </section>
                    <section class="d-flex flex-column flex-xl-row bg-white installation">
                        <div class="d-flex flex-row flex-xl-column">
                            <div>Installations :</div>
                            <img width="75px" height="75px" src="<?= $path ?>/imageIsActive/tsb.png">
                        </div>
                        <table class="flex-grow-1" cellspacing="0">
                            <?php
                            $i = 0;
                            foreach ($result1 as $val) {
                                if ($val->id_ins > 0) {
                            ?>
                                    <?php
                                    if ($i % 2 == 1) {
                                    ?>
                                        <tr>
                                        <?php
                                    }
                                        ?>
                                        <td>
                                            <?php
                                            if ($val->isActive == 1) {
                                            ?>
                                                <img class="isActiveImg" src="<?= $path ?>/imageIsActive/green.png">
                                            <?php
                                            } else { ?>
                                                <img class="isActiveImg" src="<?= $path ?>/imageIsActive/red.png">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $val->nom_ins ?></td>
                                        <?php
                                        if ($i % 2 == 0) {
                                        ?>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                            <?php }
                                $i++;
                            } ?>
                        </table>
                    </section>
                </section>
            </article>
<?php
        }
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode('shortcode_chasseralSnow_ge', 'shortcode_chasseralSnow_general');
}
