<?php
if ($_data['tmdb'] ?? false) {
    foreach ($_data['tmdb']['results'] as $categories) { ?>
        <div class="panel-group">
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