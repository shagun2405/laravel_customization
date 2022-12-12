<?php

return [
    [
        'key' => 'galaxyclinic',
        'name' => 'galaxyclinic::app.acl.galaxyclinic',
        'route' => 'admin.galaxyclinic.index',
        'sort' => 2
    ], [
        'key' => 'galaxyclinic.services',
        'name' => 'galaxyclinic::app.acl.services',
        'route' => 'admin.galaxyclinic.catalog.services.index',
        'sort' => 1,
    ], [
        'key' => 'galaxyclinic.assigned-services',
        'name' => 'galaxyclinic::app.acl.assigned-services',
        'route' => 'admin.galaxyclinic.catalog.assigned-services.index',
        'sort' => 2,
    ], [
        'key' => 'galaxyclinic.therapists',
        'name' => 'galaxyclinic::app.acl.therapists',
        'route' => 'admin.galaxyclinic.catalog.therapists.index',
        'sort' => 2,
    ]
];