<?php

namespace Customer;

use Framework\Core\Module\Module as Module;
use Framework\Core\Registry\Registry;

// Init module + Load config & model
$module = new Module('Customer');

// Registry module
Registry::setInstance('CustomerModule', $module);

?>
