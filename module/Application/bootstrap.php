<?php

namespace Application;

use Framework\Core\Module\Module as Module;
use Framework\Core\Registry\Registry;

// Init module + Load config & model
$module = new Module('Application');

// Registry module
Registry::setInstance('ApplicationModule', $module);

?>
