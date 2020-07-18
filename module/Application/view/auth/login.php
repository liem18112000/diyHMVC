<?php
    use Framework\Translator\SimpleTranslator as Translator;
?>

<div class='auth'>

    <div class='container'>

        <div class='row'>

            <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 auth-login-form'>

                <h1 class='text-center'><?= $this->data['title']; ?></h1>

                <?php

                echo $this->data['form'];

                ?>

                <br />

                <a href='<?= Application['paths']['url'] . '/auth/register' ?>'>
                    <?= Translator::translate('Having no account! Register here') ?></a>

            </div>

        </div>

    </div>

</div>