<h2><?= $_data['title'] ?></h2>
<div class="panel-group">
    <?= $this->paginator->create_links() ?>
</div>
<?php
if ($_data['tmdb'] ?? false) {
    foreach ($_data['tmdb']['results'] as $cat_name => $categories) { ?>
        <div class="panel-group">
            <ul class="list-inline">
                <?php foreach ($categories['results'] as $result) { ?>
                    <li class="list-unstyled">
                        <a href="/info/info/<?= $cat_name[0] . $result['id'] ?>"
                           data-id="<?= $cat_name[0] . $result['id'] ?>"
                           data-title="<?= $result['title'] ?? $result['name'] ?? '' ?>"
                           data-release="<?= $result['release_date'] ?? $result['first_air_date'] ?? '' ?>"
                           data-votes="<?= $result['vote_average'] ?? '' ?>">
                            <img class="img-rounded padding-tb-5px"
                                 src="<?= (isset($result['poster_path'])) ? $_data['tmdb']['config']['images']['secure_base_url'] .
                                     $_data['tmdb']['config']['images']['poster_sizes'][$this->config->item('tmdb_poster_size') ?? 1] .
                                     $result['poster_path'] : '/assets/img/no_poster.png' ?>"/>
                        </a>
                    </li>
                    <?php
                } ?>
            </ul>
        </div>
    <?php }
} elseif ($_data['igdb'] ?? false) {
    foreach ($_data['igdb']['results'] as $cat_name => $categories) { ?>
        <div class="panel-group">
            <ul class="list-inline">
                <?php foreach ($categories as $result) {
                    $result = (array)$result; ?>
                    <li class="list-unstyled">
                        <a href="/info/info/<?= $cat_name[0] . $result['id'] ?>"
                           data-id="<?= $cat_name[0] . $result['id'] ?>"
                           data-title="<?= $result['title'] ?? $result['name'] ?? '' ?>"
                           data-release="<?= $result['first_release_date'] ?? $result['created_at'] ?? '' ?>"
                           data-votes="<?= $result['popularity'] ?? '' ?>">
                            <img class="img-rounded padding-tb-5px"
                                 src="<?= (isset($result['cover']->url)) ? $result['cover']->url : '/assets/img/no_poster_game.png' ?>"/>
                        </a>
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
