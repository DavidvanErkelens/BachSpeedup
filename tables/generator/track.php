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
            'name'              =>      'duration',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'position',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'type',
            'type'              =>      'varchar(255)',
            'null'              =>      false
        ),
        array(
            'name'              =>      'title',
            'type'              =>      'text',
            'null'              =>      false
        )
    ),
    'primary'   =>  'id',
)) . PHP_EOL;
