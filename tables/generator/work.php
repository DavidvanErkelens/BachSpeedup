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
            'type'              =>      'text',
            'null'              =>      false
        )
    ),
    'primary'   =>  'id',
)) . PHP_EOL;
