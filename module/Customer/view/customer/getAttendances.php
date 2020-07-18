<?php

use Framework\Core\Middleware\csrfPreventer as csrfPreventer;;

use Framework\Core\Database\MySQLI_DB as Database;

use Framework\Translator\SimpleTranslator as Translator;

$token = csrfPreventer::generateToken();

?>

<div class='container-fluid'>

    <br />

    <div class='row'>

        <div class='col-lg-2 col-md-4 col-sm-12 col-xs-12'>
            <div class="btn-group" style='margin-top:5px; width: 100%;'>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= ucwords(Translator::translate('manage customer')) ?>
                </button>
                <div class="dropdown-menu" style='width: 100%;'>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/addCustomer' ?>" role="button"><i class="fa fa-plus" aria-hidden="true"> <?= ucwords(Translator::translate('add customer')) ?></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= Customer['paths']['url'] . '/customer/checkAttendance/current' ?>" role="button"><i class="fa fa-check-square-o" aria-hidden="true"> <?= ucwords(Translator::translate('check attendance')) ?></i></a>
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
            <form style="display: inline-flex; width:100%;" method="POST" action="<?= Customer['paths']['url'] . '/customer/getAttendances' ?>">
                <input type='hidden' name='token' value='<?= $token ?>'>
                <div class="form-group mx-sm-3 mb-2" style='width:80%; margin-top:5px'>
                    <input type="text" class="form-control" name="pattern" placeholder="<?= ucwords(Translator::translate('enter')) . " " . ucwords(Translator::translate('name')) . "..." ?>">
                </div>
                <button style='width:20%;margin-top:5px;' type="submit" name='search' class="btn btn-primary mb-2"><?= ucwords(Translator::translate('search')) ?></button>
            </form>
        </div>

    </div>

    <hr />

    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 75vh;
            overflow: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>


    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-striped table-hover text-center">
            <thead class='thead-dark'>
                <tr>
                    <th class='display-mobile-small'><?= ucwords(Translator::translate('date')) ?></th>
                    <th class='display-tablet-small'>ID</th>
                    <th class='display-mobile-small'><?= ucwords(Translator::translate('name')) ?></th>
                    <th class='display-desktop'><?= ucwords(Translator::translate('gender')) ?></th>
                    <th class='display-desktop'><?= ucwords(Translator::translate('age')) ?></th>
                    <th class='display-tablet-small'><?= ucwords(Translator::translate('time')) ?></th>
                    <th class='display-mobile-small'><?= ucwords(Translator::translate('cost')) ?></th>
                    <th class='display-mobile-small'>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $pattern = $this->data['pattern'];

                foreach ($this->data['dates'] as $date) {

                    $date = $date['date'];

                    $db = new Database(Customer['db']['user'], Customer['db']['pass'], Customer['db']['dbname'], Customer['db']['host']);

                    $num_rows = Database::countRow($db->query("SELECT * FROM customer_service WHERE date = '$date'"));

                    $stm = "SELECT DISTINCT cs.customer_id , c.name, c.gender, c.age, cs.duration, cs.cost 
                            FROM customer_service AS cs
                                JOIN customer AS c ON c.id=cs.customer_id
                            WHERE cs.date = '$date' AND c.name LIKE '%$pattern%'";

                    $num_rows = Database::countRow($db->query($stm));

                    $customers = Database::fetchAll($db->query($stm));

                ?>

                    <tr>
                        <td class='display-mobile-small' style="vertical-align: middle; font-size: 1.25em;" rowspan='<?= $num_rows + 1 ?>' scope="row"><?= $date ?></td>
                    </tr>
                    <?php
                    foreach ($customers as $customer) {
                    ?>

                        <tr>
                            <td class='display-tablet-small'><?= $customer['customer_id'] ?></td>
                            <td class='display-mobile-small'><?= $customer['name'] ?></td>
                            <td class='display-desktop'><?= $customer['gender'] ?></td>
                            <td class='display-desktop'><?= $customer['age'] ?></td>
                            <td class='display-tablet-small'><?= $customer['duration'] . ' minutes' ?></td>
                            <td class='display-mobile-small'><?= $customer['cost'] . 'K VND' ?></td>
                            <td class='display-mobile-small' style="width:170px;padding:5px;">
                                <form class='form-inline' action='<?= Customer['paths']['url'] . '/customer/deleteAttendance' ?>' method='post' enctype='multipart/form-data'>
                                    <input type='hidden' name='token' value='<?= $token ?>'>
                                    <input type="hidden" name='customer_id' value='<?= $customer['customer_id'] ?>'>
                                    <input type="hidden" name='service_id' value='1'>
                                    <input type="hidden" name='date' value='<?= $date ?>'>
                                    <a class="btn btn-info mr-md-2" href="<?= Customer['paths']['url'] .
                                        '/customer/updateAttendance/' . $customer['customer_id'] . '/1/' . $date  ?>" role="button">
                                        <?= ucwords(Translator::translate('update')) ?>
                                    </a>
                                    <button type="submit" name='delete_attendance' class="btn btn-danger"><?= ucwords(Translator::translate('delete')) ?></button>
                                </form>
                            </td>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</div>