<?php return array(
    'root' => array(
        'name' => 'daniel-km/omeka-s-module-log',
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'reference' => '8f57df8d4cabaa972fa4bebf85df4e6ce5d01b43',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v2.2.0',
            'version' => '2.2.0.0',
            'reference' => 'c29dc4b93137acb82734f672c37e029dfbd95b35',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'daniel-km/omeka-s-module-log' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => '8f57df8d4cabaa972fa4bebf85df4e6ce5d01b43',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'grimmlink/webui-popover' => array(
            'pretty_version' => '1.2.18',
            'version' => '1.2.18.0',
            'reference' => null,
            'type' => 'omeka-addon-asset',
            'install_path' => __DIR__ . '/../../asset/vendor/webui-popover-full',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'laminas/laminas-db' => array(
            'pretty_version' => '2.15.1',
            'version' => '2.15.1.0',
            'reference' => 'a03d8df79c36c07b9031d05bfd605dfed3ddf9a3',
            'type' => 'library',
            'install_path' => __DIR__ . '/../laminas/laminas-db',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'laminas/laminas-log' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '2.15',
            ),
        ),
        'laminas/laminas-stdlib' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'oomphinc/composer-installers-extender' => array(
            'pretty_version' => '2.0.1',
            'version' => '2.0.1.0',
            'reference' => 'cbf4b6f9a24153b785d09eee755b995ba87bd5f9',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/../oomphinc/composer-installers-extender',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
