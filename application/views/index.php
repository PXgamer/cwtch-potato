<?php
if ($_data['tmdb'] ?? false) {
    foreach ($_data['tmdb']['results'] as $cat_name => $categories) { ?>
        <div class="panel-group">
            <h2><?= ucwords(str_replace('_', ' ', $cat_name)) ?></h2>
            <ul class="list-inline">
                <?php foreach ($categories['results'] as $result) { ?>
                    <li class="list-unstyled">
                        <img class="img-rounded padding-tb-5px"
                             src="<?= $_data['tmdb']['config']['images']['secure_base_url'] .
                             $_data['tmdb']['config']['images']['poster_sizes'][$this->config->item('tmdb_poster_size') ?? 1] .
                             $result['poster_path'] ?>"
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php }
} ?>