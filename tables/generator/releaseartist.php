<?php
echo json_encode(array(
    'columns'   =>  array(
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
    'primary'   =>  'fk_release, fk_artist',
)) . PHP_EOL;
