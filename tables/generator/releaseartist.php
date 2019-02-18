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
            'name'              =>      'fk_release',
            'type'              =>      'int',
            'null'              =>      false
        ),
        array(
            'name'              =>      'fk_artist',
            'type'              =>      'int',
            'null'              =>      false
        ),
    ),
    'primary'   =>  'id',
)) . PHP_EOL;
