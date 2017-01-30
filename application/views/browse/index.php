<h2><?= $_data['title'] ?></h2>
<div class="panel-group">
    <?= $this->paginator->create_links() ?>
</div>
<?php
if ($_data['tmdb'] ?? false) {
    foreach ($_data['tmdb']['results'] as $categories) { ?>
        <div class="panel-group">
            <ul class="list-inline">
                <?php foreach ($categories['results'] as $result) { ?>
                    <li class="list-unstyled">
                        <img class="img-rounded padding-tb-5px"
                             src="<?= (isset($result['poster_path'])) ? $_data['tmdb']['config']['images']['secure_base_url'] .
                                 $_data['tmdb']['config']['images']['poster_sizes'][$this->config->item('tmdb_poster_size') ?? 1] .
                                 $result['poster_path'] : '/assets/img/no_poster.png' ?>"
                    </li>
                    <?php
                } ?>
            </ul>
        </div>
    <?php }
} else { ?>
    <div class="alert alert-danger">
        <p>No results found.</p>
    </div>
<?php } ?>
<div class="panel-group">
    <?= $this->paginator->create_links() ?>
</div>
