<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">
                Cwtch Potato
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/browse/">
                        <i class="fa fa-list fa-fw"></i>
                        <span class="menuItem">Browse</span></a>
                </li>
                <?php if ($_user->id > 0): ?>
                    <li class="dropdown">
                        <a href="#"
                           class="dropdown-toggle"
                           data-toggle="dropdown"
                           role="button"
                           aria-expanded="false">
                            <span><?= $_user->username ?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="profile" href="/admin/">
                                    Admin
                                    <span class="pull-right fa fa-user fa-fw"></span>
                                </a>
                            </li>
                            <li>
                                <a class="logout" href="/auth/logout/">
                                    Log Out
                                    <span class="pull-right glyphicon glyphicon-log-out"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/auth/login/">
                            <i class="fa fa-user fa-fw"></i>
                            <span class="menuItem">Log In</span></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>