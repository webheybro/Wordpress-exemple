<?php
/*
add_action('my_import_content', function () {
    touch(__DIR__ . '/demo-' . time());
});

if (!wp_next_scheduled('my_import_content')) {
    wp_schedule_event(time(), 'ten_seconds', 'my_import_content');
}

/* if ($timestamp = wp_next_scheduled('my_import_content')) {
    wp_unschedule_event($timestamp, 'my_import_content');
}
echo '<pre>';
var_dump(_get_cron_array());
echo '</pre>'; */

/*
add_filter('cron_schedules', function ($schedules) {
    $schedules['ten_seconds'] = [
        'interval' => 10,
        'display' => 'Toutes les 10 secondes'
    ];
    return $schedules;
});
