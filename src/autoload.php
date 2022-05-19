<?php

namespace Endsides;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

return Autoloader::register(__DIR__, __NAMESPACE__, pathinfo(__FILE__, PATHINFO_EXTENSION));
