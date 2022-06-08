<?php
date_default_timezone_set("Europe/Zurich");

$path = plugin_dir_url(dirname(__FILE__));

//Faire des requêtes pour ramener les informations depuis la base des données
global $wpdb;
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
            ON `i`.`id_ins` = `ia`.`id_ins`
            ORDER BY `i`.`id_ins`;
SQL;

$result_ins = $wpdb->get_results($query1);
?>
<form method="post" action="" id="installationsEtatForm">
    <div class="row">
        <h2 class="bulletinInstallationTitreClass">Installations</h2>
        <?php
        foreach ($result_ins as $val) { ?>
            <div class="row">
                <div class="form-check form-switch col">
                    <label id="installationText<?= $val->id_ins ?>" class="form-check-label installationTextClass"
                           for="<?= $val->id_ins ?>"><?= $val->nom_ins ?></label>
                </div>
                <div class="col-2">
                    <?php if ($val->isActive != 1) { ?>
                        <input class="form-check-input checkBoxInstallationInput" type="checkbox"
                               id="<?= $val->id_ins ?>">
                        <?php
                    } else { ?>
                        <input class="form-check-input checkBoxInstallationInput" type="checkbox"
                               id="<?= $val->id_ins ?>" checked>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</form>
</div>


