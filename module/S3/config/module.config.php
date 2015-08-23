<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'S3\\SharedEventListener' => 'S3\\Service\\SharedEventListener',
            'S3\\Stdlib\\Hydrator\\Strategy\\S3LinkStrategy' => 'S3\\Stdlib\\Hydrator\\Strategy\\S3LinkStrategy',
        ),
        'shared' => array(
            'S3\\Stdlib\\Hydrator\\Strategy\\S3LinkStrategy' => false
        )
    ),
    's3' => array(
        'client' => array(
            'key' => '',
            'secret' => ''
        ),
        'bucket' => array(
            'name' => '',
            'acl'  => '',
        ),
        'fields' => array(
            'path'  => array('key_prefix' => ''),
            'thumbPath' => array('key_prefix' => '')
        )
    )
);
