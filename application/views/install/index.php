<h1>Cwtch Potato Installer</h1>
<?= form_open("install/") ?>

<?= form_fieldset('Main User Setup') ?>
<div class="form-group">
    <?= form_label('Username', 'username') ?> <span class="text-danger">*</span>
    <?= form_input('username', set_value('username'), ['class' => 'form-control', 'required' => '']) ?>
</div>

<div class="form-group">
    <?= form_label('Email', 'email') ?> <span class="text-danger">*</span>
    <?= form_input('email', set_value('email'), ['class' => 'form-control', 'required' => '']) ?>
</div>

<div class="form-group">
    <?= form_label('Password', 'password') ?> <span class="text-danger">*</span>
    <?= form_password('password', '', ['class' => 'form-control', 'required' => '']) ?>
</div>
<?= form_fieldset_close() ?>

<div class="form-group">
    <?= form_submit(null, 'Set up site', ['class' => 'btn btn-default']) ?>
</div>

<?= form_close() ?>