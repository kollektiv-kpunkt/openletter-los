<?php
global $wpdb;
global $lang;
if ($_ENV["EXTERNAL"] == 1) {
} else {
    $signatures = $wpdb->get_results("SELECT * FROM `pn27_openletter` WHERE ol_status = 1");
}
?>

<div id="ol-los-container" class="mt-8">
    <h2 class="text-5xl"><?= $lang["title"] ?></h2>
    <p><?= $lang["description"] ?></p>
    <p class="text-sm">
        <?php
        $i = 1;
        foreach ($signatures as $signature):
        ?>
        <b><?= $signature->ol_fname ?> <?= $signature->ol_lname ?>,</b> <?= $signature->ol_plz ?> <?= $signature->ol_ort ?><?php ($i < count($signatures)) ? print("; ") : "" ?>
        <?php
        $i++;
        endforeach;
        ?>
    </p>
    <div id="ol-los-cta-container" class="p-6 mt-16">
        <div class="ol-los-cta-step" data-ol-step="1">
            <h3 class="text-3xl text-white mt-0 mb-0"><?= $lang["cta"] ?></h3>
            <p class="font-semibold text-lg text-white mt-2 mb-3"><?= str_replace("{NUMSIGN}", count($signatures), $lang["cta-desc"]) ?></p>
            <form action="#" id="ol-los-form" class="flex justify-end gap-6">
                <div class="input-group">
                    <label for="fname"><?= $lang["fname"] ?></label>
                    <input type="text" id="fname" name="fname" required>
                </div>
                <div class="input-group">
                    <label for="lname"><?= $lang["lname"] ?></label>
                    <input type="text" id="lname" name="lname" required>
                </div>
                <div class="input-group">
                    <label for="plz"><?= $lang["plz"] ?></label>
                    <input type="text" id="plz" name="plz" required>
                </div>
                <div class="input-group">
                    <label for="place"><?= $lang["place"] ?></label>
                    <input type="text" id="place" name="place" required>
                </div>
                <div class="input-group fullwidth">
                    <label for="email"><?= $lang["email"] ?></label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit"><?= $lang["sign"]?></button>
            </form>
        </div>
    </div>
</div>