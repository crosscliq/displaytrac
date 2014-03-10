<?php
$app = require('../vendor/bcosca/fatfree/lib/base.php');

$app->set('PATH_ROOT', __dir__ . '/../');
$app->set('AUTOLOAD',
        $app->get('PATH_ROOT') . 'lib/;' .
        $app->get('PATH_ROOT') . 'apps/;'
);
// common config
$app->config( $app->get('PATH_ROOT') . 'config/common.config.ini');

require $app->get('PATH_ROOT') . 'vendor/autoload.php';

$app->set('APP_NAME', 'api');

$logger = new \Log( $app->get('application.logfile') );
\Registry::set('logger', $logger);

if ($app->get('DEBUG')) {
    ini_set('display_errors',1);
}

\Dsc\Apps::instance()->bootstrap();

\Dsc\System::instance()->preflight();


$app->run();

?>
