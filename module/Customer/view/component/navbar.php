<?php

use Framework\Translator\SimpleTranslator as Translator;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= PUBLICS['url'] ?>">
        <img src='<?= PUBLICS['img'] . '/favicon/logo.png' ?>' height='28px;'>
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

            <li class="nav-item">
                <a class="nav-link" href="https://www.i-impression.co.jp/ias30000_vn/" target="_blank"><i class="fa fa-group" aria-hidden="true"> <?= ucwords(Translator::translate('activities')) ?></i></a>
            </li>

            <?php if (isset($_SESSION['login'])) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-list" aria-hidden="true"> <?= ucwords(Translator::translate('list')) ?></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId3">
                        <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/getCustomers' ?>" role="button"><i class="fa fa-search" aria-hidden="true"><?= ucwords(Translator::translate('customer list')) ?></i></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/getAttendances' ?>" role="button"><i class="fa fa-search" aria-hidden="true"> <?= ucwords(Translator::translate('attendance list')) ?></i></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-tasks" aria-hidden="true"> <?= ucwords(Translator::translate('manage')) ?></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId2">
                        <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/getCustomers' ?>"><i class="fa fa-address-book" aria-hidden="true"> <?= ucwords(Translator::translate('customer')) ?></i></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/checkAttendance/current' ?>"><i class="fa fa-check-square-o" aria-hidden="true"> <?= ucwords(Translator::translate('attendance')) ?></i></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-line-chart" aria-hidden="true"> <?= ucwords(Translator::translate('summaries')) ?></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/visualize/dataByMonth/current' ?>"><i class="fa fa-bar-chart" aria-hidden="true"> <?= ucwords(Translator::translate('monthly report')) ?></i></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/visualize/dataByYear/current' ?>"><i class="fa fa-pie-chart" aria-hidden="true"> <?= ucwords(Translator::translate('anually report')) ?></i></a>
                    </div>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.i-impression.co.jp/ias30000_vn/" target="_blank"><i class="fa fa-star" aria-hidden="true"> IAS-30000</i></a>
                </li>
            <?php } ?>




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