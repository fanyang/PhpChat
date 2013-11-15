<?php
error_reporting(E_ALL | E_STRICT);
set_time_limit(180);
define("MAX_COUNT", 60);
define("USLEEP_TIME", 1000000);

$config['db']['host'] = "localhost";
$config['db']['username'] = "root";
$config['db']['password'] = "";
$config['db']['dbname'] = "chat_room";