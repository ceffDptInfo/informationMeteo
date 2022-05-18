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
            ON `i`.`id_ins` = `ia`.`id_ins`;
SQL;

$result_ins = $wpdb->get_results($query1);
?>
<form method="post" action="" id="installationsEtatForm">
    <div class="row">
        <h2 class="bulletinInstallationTitreClass">Installations</h2>

<!--    Le nom des installations avec un checkBox de chaque une    -->
        <div class="row">
            <div class="col">
                <label id="installationText" class="form-check-label">Toutes les installations</label>
            </div>
            <div class="col-2">
                <input class="form-check-input checkBoxInstallationInput" type="checkbox" id="0" value="0">
            </div>
            <div><label>&nbsp;</label></div>
        </div>
        <?php
        foreach ($result_ins as $val) {
            ?>
            <div class="row">
                <div class="form-check form-switch col">
                    <label id="installationText" class="form-check-label"
                           for="<?= $val->id_ins ?>"><?= $val->nom_ins ?></label>
                    <div><label>&nbsp;</label></div>
                </div>
                <div class="col-2">
                    <?php
                    if ($val->isActive == 1) {
                        ?>
                        <input class="form-check-input checkBoxInstallationInput" type="checkbox"
                               id="<?= $val->id_ins ?>" checked>
                        <?php
                    } else { ?>
                        <input class="form-check-input checkBoxInstallationInput" type="checkbox"
                               id="<?= $val->id_ins ?>">
                        <?php
                    }
                    ?>
                    <div><label>&nbsp;</label></div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</form>
</div>


