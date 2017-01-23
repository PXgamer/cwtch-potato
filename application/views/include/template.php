<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cwtch Potato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <script src="/assets/js/jquery-2.2.4.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</head>
<body>
<div>
    <?php $this->load->view('include/header', ['_user' => $_user]) ?>
    <div class="container">
        <?= (isset($view)) ? $view : '' ?>
    </div>
</div>
</body>
</html>