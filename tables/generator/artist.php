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
            'name'              =>      'name',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'discogs_id',
            'type'              =>      'int',
            'null'              =>      false,
            'default'           =>      0
        )
    ),
    'primary'   =>  'id',
)) . PHP_EOL;
