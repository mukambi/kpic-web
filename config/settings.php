<?php

return [
    'pagination_length' => [
        [20, 35, 50, -1],
        [20, 35, 50, "All"]
    ],
    'live_data' => boolval(env('LIVE_DATA', true))
];
