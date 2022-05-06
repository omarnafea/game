

<?php


?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="<?=isset($_GET['game_id']) ? '../': 'index.php'?>">
        <img src="<?=$logoPath?>" width="45" height="45" alt="logo" class="img-fluid"/>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?=isset($_GET['game_id']) ? '../': 'index.php'?>"><?=$lang['games']?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?=$langLink?>"><?=$langText?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>