<?php if ($_user->id > 0) { ?>
    <h2>Available Services:</h2>
    <ul>
        <?php foreach ($_data['services'] as $service) { ?>
            <li class="list-unstyled"><span class="fa fa-fw <?= ($service->configured) ? 'fa-check' : 'fa-times' ?>"></span> <a href="<?= $service->base_url ?>"><?= $service->title ?></a></li>
        <?php } ?>
    </ul>
<?php } else { ?>
<?php }