<?php
echo json_encode(array(
    'columns'   =>  array(
        array(
            'name'              =>      'id',
            'type'              =>      'int',
            'null'              =>      false,
            'auto_increment'    =>      true
        ),
        array(
            'name'              =>      'url',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'year',
            'type'              =>      'int',
            'null'              =>      false,
            'default'           =>      0
        ),
        array(
            'name'              =>      'quality',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'thumbnail',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'title',
            'type'              =>      'text',
            'null'              =>      false
        ),
        array(
            'name'              =>      'master',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'country',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'format',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        )
    ),
    'primary'   =>  'id',
)) . PHP_EOL;
