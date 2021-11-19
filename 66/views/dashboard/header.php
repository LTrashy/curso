

<link rel="stylesheet" href="<?= constant('URL')?>public/css/default.css">
<link rel="stylesheet" href="<?= constant('URL')?>public/css/dashboard.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


<div id="header">
    <ul>
        <li><a href="<?= constant('URL')?>dashboard">Home</a></li>
        <li><a href="<?= constant('URL')?>expenses">Expenses</a></li>
        <li><a href="<?= constant('URL')?>logout">Logout</a></li>
    </ul>

    <div id="profile-container">
        <a href="<?= constant('URL')?>user">
            <div class="name"><?= $user->getName()?></div>
            <div class="photo">
                <?php if($user->getPhoto() == ''){?>
                    <i class="material-icons">account_circle</i>
                <?php }else{ ?>
                    <img src="<?= constant('URL')?>public/img/photos/<?= $user->getPhoto()?>" width="32" alt="">
                <?php } ?>
            </div>
        </a>
        <div id="submenu">
            <ul>
                <li><a href="<?= constant('URL')?>user">Ver perfil</a></li>
                <li class='divisor'></li>
                <li><a href="<?= constant('URL')?>logout">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</div>