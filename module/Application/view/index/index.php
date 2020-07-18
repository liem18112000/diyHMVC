<?php 
    use Framework\Translator\SimpleTranslator as Translator;
?>

<!-- Banner content -->
<div id='banner' class='text-center'>

    <img id='banner-img' src='<?=PUBLICS['img'] . '/index/cross.png'?>'>

    <p class='font-style-title display-3' style='color: darkred; text-shadow: 2px 2px white'>
        <?=Translator::translate('TokyoHealth Club');?>
    </p>
    <p class='font-style-title display-4' style='color: black;'>
        <?=Translator::translate('Your health is our pleasure')?>
    </p>

    <br />

    <div class=' container'>

        <div class='row'>

            <div class='col-lg-3 display-desktop display-tablet'></div>

            <div class='col-lg-3 col-md-6 col-sm-6 col-xs-12' style='margin-bottom: 20px'>

                <a class="btn btn-outline-light btn-block btn-lg" href="#service" role="button">
                    <?=Translator::translate('Our service')?>
                </a>

            </div>

            <div class='col-lg-3 col-md-6 col-sm-6 col-xs-12'>

                <a name="" id="" class="btn btn-outline-light btn-block btn-lg" href="#story" role="button">
                    <?=Translator::translate('IAS 30000 information')?>
                </a>

            </div>

        </div>

    </div>

</div>
<!-- Banner content -->

<!-- Story container -->
<div class='holder text-center'>
    <div class='holder-content'>
        <p class='font-style-title'>
            <?=Translator::translate('Forming development ideas')?>
        </p>
    </div>
</div>

<div class='wrapper' id='story'>
    <div class='container'>
        <div class='row'>

            <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center' style='display: table-cell;vertical-align: middle;'>

                <h1 class='font-style-title display-4'>Our Story</h1>

            </div>

            <div class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>
                <p class='content'>
                    <?=Translator::translate('In recent years many diseases have appeared. 
                        With modern treatment is only treated through the diagnosis. 
                        But it is very difficult to diagnose the body with semi-healthy 
                        condition such as headache, insomnia, chronic constipation, etc.
                        So we have created high voltage treatment device .')?>
                </p>

                <p class='content'>
                    <?=Translator::translate('It is IAS 30000')?> ( <a href='https://www.i-impression.co.jp/ias30000_vn/'>https://www.i-impression.co.jp</a> )</p>
            </div>

        </div>
    </div>
</div>
<!-- Story container -->

<!-- Overview container -->

<div class='holder text-center'>
    <div class='holder-content'>
        <p class='font-style-title'><?=Translator::translate('IAS 30000 is a magical device')?></p>
    </div>
</div>

<div class='wrapper' id='overview'>
    <div class='card-bg'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-9 col-md-12 col-sm-12 col-xs-12' style='padding-top: 10%;'>

                    <h2 class='content font-style-title text-center'>
                        <?=Translator::translate('IAS30000 is a high voltage treatment device')?></h1>

                        <p class='content'>
                            <?=Translator::translate('Certified by the Ministry of Health, 
                        Labor and Social Welfare as a health care support device.')?>
                        </p>

                        <p class='content'>
                            <?=Translator::translate('Manufacturing factory: in Japanese medical equipment factory in Gunma, Takasaki.')?>
                            ( <a href='https://www.i-impression.co.jp/ias30000_vn/'>https://www.i-impression.co.jp</a> )
                        </p>
                </div>
                <div class='col-lg-3 col-md-12 col-sm-12 col-xs-12'>
                    <img class='img-responsive' id='img-las' src='https://www.i-impression.co.jp/ias30000_vn/images/img_ias.png'>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Overview container -->

<!-- More container -->

<div class='holder text-center'>
    <div class='holder-content'>
        <p class='font-style-title'><?=Translator::translate('Our service and IAS 30000')?></p>
    </div>
</div>

<div class='wrapper' id='service'>

    <div class='container card-box'>

        <div class='row'>

            <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12 card' style='padding: 0; margin: 0;'>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d244.91227695366555!2d106.76371468701676!3d10.842164325782301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527a5cedf719b%3A0xfcb4b57c4d4fd5e7!2zNTgsIDEgQsOhYyDDgWksIELDrG5oIFRo4buNLCBUaOG7pyDEkOG7qWMsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1585021624825!5m2!1svi!2s" frameborder="1px" style="border:0;" allowfullscreen="true" aria-hidden="false" tabindex="0" id='map'></iframe>
            </div>

            <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12 card' style='margin: 0; padding: 5% 3% 5% 3%'>

                <h1 class='font-style-title display-4 text-center'>TokyoHealth</h1>

                <br />

                <p class='content'><?=Translator::translate('Our club is located at ')?>
                    <a target='_blank' href='https://www.google.com/maps/place/58,+1+B%C3%A1c+%C3%81i,+B%C3%ACnh+Th%E1%BB%8D,+Th%E1%BB%A7+%C4%90%E1%BB%A9c,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.8421643,106.7637147,21z/data=!4m5!3m4!1s0x317527a5cedf719b:0xfcb4b57c4d4fd5e7!8m2!3d10.842311!4d106.76372?hl=vi-VN'>
                        58/1 Đăng Văn Bi, phường Bình thọ, quận Thủ Đức TPHCM
                    </a>(<?=Translator::translate('Click here for more details')?>).
                </p>

                <p class='content'>
                    <?=Translator::translate('Our facility is fully equipped with 2 IAS 30000 units 
                        that operate continuously with a variety of treatment 
                        regimes from 6 am - 9 pm every day from Monday to Sunday')?></p>

                <p class='content'><?=Translator::translate('Besides, rooms are air-conditioned and hygienic.')?></p>

            </div>

        </div>

    </div>


</div>

<!-- More container -->

<!-- Contact container -->

<div class='holder text-center'>
    <div class='holder-content'>
        <p class='font-style-title'><?= Translator::translate('Contact us now')?></p>
    </div>
</div>

<div class='wrapper' id='contact'>

    <div class='container card-box'>

        <div class='row'>

            <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12' style='padding: 0; margin: 0'>
                <img class='img-responsive' src='https://images.unsplash.com/photo-1512626120412-faf41adb4874?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80'>
            </div>

            <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12 card' style='margin: 0; padding: 2%'>
                <h1 class='font-style-title display-4 text-center'><?=Translator::translate('Contact information')?></h1>

                <br />

                <p class='content'><i class="fa fa-envelope" aria-hidden="true"> Email</i> :
                    <a href="mailto:liemdev18112000@gmail.com?Subject=Liên lạc với câu lạc bộ TokyoHealth" target="_top">liemdev18112000@gmail.com</a>
                </p>

                <p class='content'><i class="fa fa-phone-square" aria-hidden="true"> 
                     <?=Translator::translate('Phone number')?></i> :
                    <a href="tel:+84816668219">0816668219</a> -
                    <a href="tel:+84898405382">0898405382</a> -
                    <a href="tel:+84909975528">0909975528</a>
                </p>

                <p class='content'>
                    <i class="fa fa-youtube-play" aria-hidden="true"> Youtube</i> :
                    <a target="_blank" href='https://www.youtube.com/channel/UC0TbfodEju9ApyKKla5ivGg'> TokyoHealth</a>
                </p>

                <p class='content'>
                    <i class="fa fa-facebook-square" aria-hidden="true"> Facebook</i>
                    :
                    <a target="_blank" href='https://www.facebook.com/TokyoHealth-Th%E1%BB%A7-%C4%90%E1%BB%A9c-111806027126333'>
                        TokyoHealth Thủ Đức
                    </a>
                </p>

                <p class='content'> <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <?=Translator::translate('TokyoHealth was built by Liem Doan')?>
                </p>

                <p class='content'>
                    <i> 
                        <?= Translator::translate('Note: click on the link to send a email or call us')?>
                    </i>
                </p>


            </div>

        </div>

    </div>


</div>

<!-- Contact container -->