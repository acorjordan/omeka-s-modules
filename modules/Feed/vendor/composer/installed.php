<?php return array(
    'root' => array(
        'name' => 'daniel-km/omeka-s-module-feed',
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'reference' => 'c9a8346127fed46d84c56901be599cf402cc086f',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'daniel-km/omeka-s-module-feed' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => 'c9a8346127fed46d84c56901be599cf402cc086f',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'laminas/laminas-escaper' => array(
            'dev_requirement' => false,
            'provided' => array(
                0 => '*',
            ),
        ),
        'laminas/laminas-feed' => array(
            'pretty_version' => '2.18.2',
            'version' => '2.18.2.0',
            'reference' => 'a57fdb9df42950d5b7f052509fbdab0d081c6b6d',
            'type' => 'library',
            'install_path' => __DIR__ . '/../laminas/laminas-feed',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'laminas/laminas-servicemanager' => array(
            'dev_requirement' => false,
            'provided' => array(
                0 => '^3.16',
            ),
        ),
        'laminas/laminas-stdlib' => array(
            'dev_requirement' => false,
            'provided' => array(
                0 => '*',
            ),
        ),
        'psr/container' => array(
            'dev_requirement' => false,
            'provided' => array(
                0 => '*',
            ),
        ),
    ),
);
