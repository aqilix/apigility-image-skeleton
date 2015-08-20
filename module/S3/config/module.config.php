<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'S3\\SharedEventListener' => 'S3\\Service\\SharedEventListener',
        ),
    ),
    's3' => array(
        'client' => array(
            'key' => '',
            'secret' => ''
        ),
        'bucket' => array(
            'name' => '',
            'acl'  => '',
            'key_prefix'   => '',
            'thumb_prefix' => '',
        )
    )
);
