<?php

use Framework\Translator\SimpleTranslator as Translator;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= PUBLICS['url'] ?>">
        <img src='<?= PUBLICS['img'] . '/favicon/logo.png' ?>' height='32px;'>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?= PUBLICS['url'] ?>">
                    <i class="fa fa-home" aria-hidden="true"> <?= ucwords(Translator::translate('home')) ?></i>
                    <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">

            <form action="<?= Application['paths']['url'] . '/index/language' ?>" method="POST" role="form">
                <input type="hidden" name='language' value='<?= $_SESSION['language'] ?>'>
                <input type="hidden" name='link' value='<?= $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>'>
                <button type="submit" class="btn btn-outline-light mr-sm-2" style="padding: 2px">
                    <img style='height: 34px' src="<?= $_SESSION['language_img'] ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="<?= $_SESSION['language'] ?>">
                </button>
            </form>

            <?php if (!isset($_SESSION['login'])) { ?>
                <a name="" id="" class="btn btn-outline-info mr-sm-2" href="<?= Application['paths']['url'] . '/auth/login' ?>" role="button">&nbsp;<i class="fa fa-user" aria-hidden="true">
                        <?= ucwords(Translator::translate('login')) ?>
                    </i></a>
                <a name="" id="" class="btn btn-outline-info mr-sm-2" href="<?= Application['paths']['url'] . '/auth/register' ?>" role="button"><i class="fa fa-sign-in" aria-hidden="true"> <?= ucwords(Translator::translate('sign up')) ?></i></a>
            <?php } else { ?>
                <a name="" id="" class="btn btn-outline-success mr-sm-2" href="#" role="button">&nbsp;<i class="fa fa-user" aria-hidden="true"> <?= $_SESSION['username'] ?></i></a>
                <a name="" id="" class="btn btn-outline-danger mr-sm-2" href="<?= Application['paths']['url'] . '/auth/logout' ?>" role="button"><i class="fa fa-sign-out" aria-hidden="true"> <?= ucwords(Translator::translate('logout')) ?></i></a>
            <?php } ?>

        </div>
    </div>
</nav>