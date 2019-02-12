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
            'name'              =>      'fk_work',
            'type'              =>      'int',
            'null'              =>      false
        ),
        array(
            'name'              =>      'fk_release',
            'type'              =>      'int',
            'null'              =>      false
        ),
        array(
            'name'              =>      'trackrange',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        )
    ),
    'primary'   =>  'id',
)) . PHP_EOL;
