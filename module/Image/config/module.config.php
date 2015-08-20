<?php
return array(
    'router' => array(
        'routes' => array(
            'image.rest.image' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/v1.0/image[/:image_id]',
                    'defaults' => array(
                        'controller' => 'Image\\V1\\Rest\\Image\\Controller',
                    ),
                ),
            ),
            'image.rest.images' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/v1.0/images[/:page]',
                    'defaults' => array(
                        'controller' => 'Image\\V1\\Rest\\Images\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'image.rest.image',
            1 => 'image.rest.images',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'Image\\V1\\Rest\\Image\\ImageResource'  => 'Image\\V1\\Rest\\Image\\ImageResource',
            'Image\\V1\\Rest\\Image\\ImagesResource' => 'Image\\V1\\Rest\\Image\\ImagesResource',
            'Image\\Mapper\\Image'  => 'Image\\Mapper\\Adapter\\Doctrine',
            'Image\\Service\\Image' => 'Image\\Service\\Image',
            'Image\\SharedEventListener' => 'Image\\Service\\SharedEventListener',
        ),
        'factories' => array(
            'Image\\Entity\\Hydrator' => 'Image\\Service\\Factory\DoctrineObjectHydratorFactory'
        )
    ),
    'zf-rest' => array(
        'Image\\V1\\Rest\\Image\\Controller' => array(
            'listener' => 'Image\\V1\\Rest\\Image\\ImageResource',
            'route_name' => 'image.rest.image',
            'route_identifier_name' => 'image_id',
            'collection_name' => 'image',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Image\\Entity\\Image',
            'collection_class' => 'Image\\V1\\Rest\\Image\\ImageCollection',
            'service_name' => 'Image',
        ),
        'Image\\V1\\Rest\\Images\\Controller' => array(
            'listener' => 'Image\\V1\\Rest\\Images\\ImagesResource',
            'route_name' => 'image.rest.images',
            'route_identifier_name' => 'images_id',
            'collection_name' => 'images',
            'entity_http_methods' => array(),
            'collection_http_methods' => array(
                0 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Image\\V1\\Rest\\Images\\ImagesEntity',
            'collection_class' => 'Image\\V1\\Rest\\Images\\ImagesCollection',
            'service_name' => 'Images',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Image\\V1\\Rest\\Image\\Controller' => 'HalJson',
            'Image\\V1\\Rest\\Images\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Image\\V1\\Rest\\Image\\Controller' => array(
                0 => 'application/vnd.image.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Image\\V1\\Rest\\Images\\Controller' => array(
                0 => 'application/vnd.image.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Image\\V1\\Rest\\Image\\Controller' => array(
                0 => 'application/vnd.image.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
                3 => 'image/jpeg',
                4 => 'image/png',
                5 => 'image/jpg',
            ),
            'Image\\V1\\Rest\\Images\\Controller' => array(
                0 => 'application/vnd.image.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Image\\Entity\\Image' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.image',
                'route_identifier_name' => 'image_id',
                'hydrator' => 'DoctrineModule\\Stdlib\\Hydrator\\DoctrineObject',
            ),
            'Image\\V1\\Rest\\Image\\ImageCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.image',
                'route_identifier_name' => 'image_id',
                'is_collection' => true,
            ),
            'Image\\V1\\Rest\\Images\\ImagesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.images',
                'route_identifier_name' => 'images_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Image\\V1\\Rest\\Image\\Controller' => array(
            'input_filter' => 'Image\\V1\\Rest\\Image\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Image\\V1\\Rest\\Image\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => array(),
                    ),
                    1 => array(
                        'name' => 'Zend\\Validator\\NotEmpty',
                        'options' => array(),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'description',
                'description' => 'Image Description',
                'error_message' => 'Description should be filled',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\File\\Extension',
                        'options' => array(
                            0 => 'jpg',
                            1 => 'png',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\File\\RenameUpload',
                        'options' => array(
                            'target' => 'public/images/aqilix',
                            'use_upload_extension' => true,
                            'randomize' => true,
                        ),
                    ),
                ),
                'name' => 'image',
                'description' => 'Image File',
                'type' => 'Zend\\InputFilter\\FileInput',
                'error_message' => 'File should be uploaded',
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'image_db_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\YamlDriver',
                'paths' => array(
                    0 => __DIR__ . '/entity',
                ),
                'cache' => 'array',
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Image\\Entity' => 'image_db_driver',
                ),
            ),
        ),
    ),
    'images' => array(
        'thumb_path' => 'public/images/thumbs',
        'ori_path'   => 'public/images/ori'
    ),
);
