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
            <div class='row'>
                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <form style="display: inline-flex; width:100%;" method="POST" action="<?= Customer['paths']['url'] . '/customer/checkAttendance/current' ?>">
                        <input type='hidden' name='token' value='<?= $token ?>'>
                        <div class="form-group mx-sm-3 mb-2" style='width:70%; margin-top:5px'>
                            <input type="date" class="form-control" name="date" required='required' placeholder="<?= ucwords(Translator::translate('enter')) . " " . ucwords(Translator::translate('date')) . "..." ?>">
                        </div>
                        <button style='width:30%;margin-top:5px;' type="submit" name='search-date' class="btn btn-primary mb-2"><?= ucwords(Translator::translate('apply')) ?></button>
                    </form>
                </div>

                <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
                    <form style="display: inline-flex; width:100%;" method="POST" action="<?= Customer['paths']['url'] . '/customer/search' ?>">
                        <input type='hidden' name='token' value='<?= $token ?>'>
                        <input type='hidden' name='request' value='<?= 'customer/checkAttendance' ?>'>
                        <input type='hidden' name='from' value='<?= $_SESSION['query']['checkAttendance'] ?>'>
                        <div class="form-group mx-sm-3 mb-2" style='width:70%; margin-top:5px'>
                            <input type="text" class="form-control" name="pattern" placeholder="<?= ucwords(Translator::translate('enter')) . " " . ucwords(Translator::translate('name')) . "..." ?>">
                        </div>
                        <button style='width:30%;margin-top:5px;' type="submit" name='search' class="btn btn-primary mb-2"><?= ucwords(Translator::translate('search')) ?></button>
                    </form>
                </div>
            </div>

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
                    <th class='display-tablet-small'>ID</th>
                    <th class='display-mobile-small'><?= ucwords(Translator::translate('name')) ?></th>
                    <th class='display-desktop'><?= ucwords(Translator::translate('gender')) ?></th>
                    <th class='display-desktop'><?= ucwords(Translator::translate('age')) ?></th>
                    <th class='display-mobile-small'><?= ucwords(Translator::translate('cost')) ?></th>
                    <th class='display-mobile-small'><?= ucwords(Translator::translate('time')) ?></th>
                    <th class='display-mobile-small'>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $from = new \DateTimeZone('GMT');
                $to   = new \DateTimeZone('Asia/Ho_Chi_Minh');
                $currDate     = new \DateTime('now', $from);
                $currDate->setTimezone($to);

                if (!empty($this->data['customers']))

                    foreach ($this->data['customers'] as $customer) {

                        $customer_id = $customer['customer_id'];

                        $date = ($this->data['date'] != 'CURDATE()') ? $this->data['date'] : $currDate->format('Y-m-d');
                        
                        $stm = "SELECT * FROM customer_service WHERE customer_id = '$customer_id' AND date = '$date'";

                        $db = new Database(Customer['db']['user'], Customer['db']['pass'], Customer['db']['dbname'], Customer['db']['host']);

                        $count_row = Database::countRow($db->query($stm));

                        if ($count_row == 0) {
                ?>

                        <tr>
                            <form class='form-inline' action='<?= Customer['paths']['url'] . '/customer/addAttendance/' . $customer['customer_id'] ?>' method='post' enctype='multipart/form-data'>
                                <td class='display-tablet-small' scope="row"><?= $customer['customer_id'] ?></td>
                                <td style='padding: 0.75rem 5px 0.75rem 5px;' class='display-mobile-small'><?= $customer['name'] ?></td>
                                <td class='display-desktop'><?= $customer['gender'] ?></td>
                                <td class='display-desktop'><?= $customer['age'] ?></td>
                                <td style='padding: 0.75rem 5px 0.75rem 5px;' class='display-mobile-small'>
                                    <input type='number' class='form-control' name='cost' min='0' required='required' value='10'>
                                </td>
                                <td style='padding: 0.75rem 5px 0.75rem 5px;' class='display-mobile-small'>
                                    <input type='number' class='form-control' name='duration' min='30' step='30' required='required' value='60'>
                                </td>
                                <td style='vertical-align: center;width:80px; padding: 0.75rem 10px 0.75rem 0px;' class='display-mobile-small' style="width:80px;padding:5px;">
                                    <input type='hidden' name='token' value='<?= $token ?>'>
                                    <input type="hidden" name='date' value='<?= $date; ?>'>
                                    <input type="hidden" name='customer_id' value='<?= $customer['customer_id'] ?>'>
                                    <input type="hidden" name='service_id' value='1'>
                                    <button type="submit" name='add_attendance' class="btn btn-info"><?= ucwords(Translator::translate('check')) ?></button>
                                </td>
                            </form>
                        </tr>

                    <?php
                        } else {
                    ?>
                        <tr>
                            <td class='display-tablet-small' scope="row"><?= $customer['customer_id'] ?></td>
                            <td style='padding: 0.75rem 5px 0.75rem 5px;' class='display-mobile-small'><?= $customer['name'] ?></td>
                            <td class='display-desktop'><?= $customer['gender'] ?></td>
                            <td class='display-desktop'><?= $customer['age'] ?></td>
                            <td class='display-mobile-small'></td>
                            <td class='display-mobile-small'></td>
                            <td style='vertical-align: center;width:80px; padding: 0.75rem 10px 0.75rem 0px;' class='display-mobile-small' style="width:80px;padding:5px;">
                                <button name='check_attendance' class="btn btn-warning" disabled><?= ucwords(Translator::translate('checked')) ?></button>
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