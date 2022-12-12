<?php

return [
    [
        'key' => 'galaxyclinic',
        'name' => 'galaxyclinic::app.admin-menu.galaxyclinic',
        'route' => 'admin.galaxyclinic.catalog.services.index',
        'sort' => 2,
        'icon-class' => 'marketplace-icon',
    ], [
        'key' => 'galaxyclinic.services',
        'name' => 'galaxyclinic::app.admin-menu.services',
        'route' => 'admin.galaxyclinic.catalog.services.index',
        'sort' => 1,
    ], [
        'key' => 'galaxyclinic.assigned-services',
        'name' => 'galaxyclinic::app.admin-menu.assigned-services',
        'route' => 'admin.galaxyclinic.catalog.assigned-services.index',
        'sort' => 2,
    ], [
        'key' => 'galaxyclinic.therapists',
        'name' => 'galaxyclinic::app.admin-menu.therapists',
        'route' => 'admin.galaxyclinic.catalog.therapists.index',
        'sort' => 2,
    ],[
        'key' => 'galaxyclinic.company',
        'name' => 'galaxyclinic::app.admin-menu.company',
        'route' => 'admin.galaxyclinic.catalog.company.index',
        'sort' => 2,
    ],[
        'key' => 'galaxyclinic.setting',
        'name' => 'galaxyclinic::app.admin.system.settings',
        'route' => 'admin.galaxyclinic.catalog.therapists.settings',
        'sort' => 2,
    ]
];