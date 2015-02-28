<?php
return array(
	'controllers' => array(
        'factories' => array(
            'AsRobotsTxt' => '\AsRobotsTxt\Controller\RobotsControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'asrobotstxt' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/robots.txt',
                    'defaults' => array(
                        'controller' => 'AsRobotsTxt',
                        'action' => 'robots-txt'
                    )
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'AsRobotsTxtOptions' => '\AsRobotsTxt\Options\OptionsFactory'
        )
    )
);