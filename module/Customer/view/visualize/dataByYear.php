<?php

use Framework\Translator\SimpleTranslator as Translator;
?>

<script>
    window.onload = function() {

        var chartRevenue = new CanvasJS.Chart("chartContainerRevenue", {
            animationEnabled: true,
            title: {
                text: "<?= Translator::translate("Revenue by year") ?>"
            },
            axisY: {
                title: "<?= Translator::translate("Revenue") ?> (VND)",
                prefix: "",
                suffix: "k"
            },
            data: [{
                type: "bar",
                yValueFormatString: "$#,##0K",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bold",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($this->data['revenue'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        chartRevenue.render();

        var chartCustomer = new CanvasJS.Chart("chartContainerCustomer", {
            animationEnabled: true,
            title: {
                text: "<?= Translator::translate("Attendance by year") ?>"
            },
            axisY: {
                title: "<?= Translator::translate("Attendances") . ' (' .  Translator::translate("visits") . ')' ?>",
                prefix: "",
                suffix: ""
            },
            data: [{
                type: "bar",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bold",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($this->data['customer'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        chartCustomer.render();

    }
</script>

<br />
<div class='container-fluid'>
    <div class='row'>

        <div class='col-lg-2 col-md-4 col-sm-12 col-xs-12'>
            <div class="btn-group" style='margin-top:5px; width: 100%;'>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= ucwords(Translator::translate('manage customer')) ?>
                </button>
                <div class="dropdown-menu" style='width: 100%;'>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/addCustomer' ?>" role="button"><i class="fa fa-plus" aria-hidden="true"> <?= ucwords(Translator::translate('add customer')) ?></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/checkAttendance' ?>" role="button"><i class="fa fa-check-square-o" aria-hidden="true"> <?= ucwords(Translator::translate('check attendance')) ?></i></a>
                </div>
            </div>
        </div>

        <div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>
            <div class="btn-group" style='margin-top:5px; width: 100%;'>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= ucwords(Translator::translate('view lists')) ?>
                </button>
                <div class="dropdown-menu" style='width: 100%;'>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/getCustomers' ?>" role="button"><i class="fa fa-search" aria-hidden="true"><?= ucwords(Translator::translate('customer list')) ?></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/getAttendances' ?>" role="button"><i class="fa fa-search" aria-hidden="true"> <?= ucwords(Translator::translate('attendance list')) ?></i></a>
                </div>
            </div>
        </div>

        <div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>
            <div class="btn-group" style='margin-top:5px; width: 100%;'>
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= ucwords(Translator::translate('view summaries')) ?>
                </button>
                <div class="dropdown-menu" style='width: 100%;'>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/visualize/dataByMonth/current' ?>"><i class="fa fa-bar-chart" aria-hidden="true"> <?= ucwords(Translator::translate('monthly report')) ?></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/visualize/dataByYear/current' ?>"><i class="fa fa-pie-chart" aria-hidden="true"> <?= ucwords(Translator::translate('anually report')) ?></i></a>
                </div>
            </div>
        </div>

        <div class='col-lg-6 col-md-12 col-sm-12 col-xs-12'>
            <form style="display: inline-flex; width:100%;" method="POST" action="<?= Customer['paths']['url'] . '/visualize/dataByYear/current' ?>">
                <input type='hidden' name='token' value='<?= $token ?>'>
                <div class="form-group mx-sm-3 mb-2" style='width:80%; margin-top:5px'>
                    <input type="number" class="form-control" name="year" min='2020' max='2050' placeholder="<?= ucwords(Translator::translate('enter')) . " " . ucwords(Translator::translate('year')) . " 2020 - 2050" ?>">
                </div>
                <button style='width:20%;margin-top:5px;' type="submit" name='apply' class="btn btn-primary mb-2"><?= ucwords(Translator::translate('apply')) ?></button>
            </form>
        </div>

    </div>
</div>

<hr />

<div class='row'>

    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
        <div id="chartContainerRevenue" style="height: 70vh;width:100%"></div>
    </div>

    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
        <div id="chartContainerCustomer" style="height: 70vh;width:100%"></div>
    </div>

</div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>