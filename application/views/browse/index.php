<h1>Browse</h1>
<hr/>
<?php if ($_data['movies']) { ?>
    <a href="/browse/movies/">
        <div class="alert alert-danger">
            Movies <span class="pull-right fa fa-fw fa-film"></span>
        </div>
    </a>
<?php } ?>
<?php if ($_data['tv']) { ?>
    <a href="/browse/tv/">
        <div class="alert alert-danger">
            TV Shows <span class="pull-right fa fa-fw fa-video-camera"></span>
        </div>
    </a>
<?php } ?>
<?php if ($_data['games']) { ?>
    <a href="/browse/games/">
        <div class="alert alert-danger">
            Games <span class="pull-right fa fa-fw fa-gamepad"></span>
        </div>
    </a>
<?php } ?>
