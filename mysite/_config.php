<?php

global $project;
$project = 'mysite';

global $databaseConfig;
$databaseConfig = array(
	"type" => 'MySQLDatabase',
	"server" => 'localhost',
	"username" => 'root',
	"password" => 'omega',
	"database" => 'card2013',
	"path" => '',
);

// Set the site locale
i18n::set_locale('en_US');

Security::setDefaultAdmin('admin','password'); 
Director::set_environment_type("dev");
GD::set_default_quality(85);
SpamProtectorManager::set_spam_protector('InvisibleSpamProtector');