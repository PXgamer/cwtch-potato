<h1>Login</h1>
<?= form_open("auth/login/") ?>

<div class="form-group">
    <?= form_label('Username', 'username') ?> <span class="text-danger">*</span>
    <?= form_input('username', set_value('username'), ['class' => 'form-control', 'required' => '']) ?>
</div>

<div class="form-group">
    <?= form_label('Password', 'password') ?> <span class="text-danger">*</span>
    <?= form_password('password', '', ['class' => 'form-control', 'required' => '']) ?>
</div>

<?php if (isset($data->error)): ?>
    <div class="form-group">
        <div class="alert alert-warning">
            <p>Warning: <?= $data->error ?></p>
        </div>
    </div>
<?php endif ?>

<div class="form-group">
    <?= form_submit('log-in-submit', 'Log In', ['class' => 'btn btn-default']) ?>
</div>

<?= form_close() ?>