<h1>Cwtch Potato Configurations</h1>
<?= form_open("admin/") ?>

<?= form_fieldset('Trakt Settings <a href="https://trakt.tv/oauth/applications" target="blank" class="small"><span class="fa fa-fw fa-external-link-square"></span></a>') ?>
<div class="form-group">
    <?= form_label('Client ID', 'username') ?>
    <?= form_input('username', set_value('username'), ['class' => 'form-control']) ?>
</div>
<div class="form-group">
    <?= form_label('Client Secret', 'email') ?>
    <?= form_input('email', set_value('email'), ['class' => 'form-control']) ?>
</div>
<?= form_fieldset_close() ?>

<?= form_fieldset('The Movie Database Settings <a href="https://www.themoviedb.org/documentation/api" target="blank" class="small"><span class="fa fa-fw fa-external-link-square"></span></a>') ?>
<div class="form-group">
    <?= form_label('API Key (v3 auth)', 'email') ?>
    <?= form_input('email', set_value('email'), ['class' => 'form-control']) ?>
</div>
<?= form_fieldset_close() ?>

<?= form_fieldset('The Internet Game Database Settings <a href="https://www.igdb.com/api" target="blank" class="small"><span class="fa fa-fw fa-external-link-square"></span></a>') ?>
<div class="form-group">
    <?= form_label('Mashape API Key', 'email') ?>
    <?= form_input('email', set_value('email'), ['class' => 'form-control']) ?>
</div>
<?= form_fieldset_close() ?>

<div class="form-group">
    <?= form_submit(null, 'Save Config Settings', ['class' => 'btn btn-default']) ?>
</div>

<?= form_close() ?>