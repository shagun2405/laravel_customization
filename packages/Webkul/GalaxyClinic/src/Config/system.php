<?php

$customer_groups = \DB::table('customer_groups')->select('*')->get();
$options = array();
foreach($customer_groups as $customer_group) {
    $options[] = [
        'title' => $customer_group->name,
        'value' => $customer_group->id
    ];
}

return [
    [
        'key'       => 'galaxyclinic',
        'name'      => 'galaxyclinic::app.admin.system.galaxyclinic',
        'sort'      => 1
    ], [
        'key'       => 'galaxyclinic.settings',
        'name'      => 'galaxyclinic::app.admin.system.settings',
        'sort'      => 1,
    ], [
        'key'       => 'galaxyclinic.settings.general',
        'name'      => 'galaxyclinic::app.admin.system.general',
        'sort'      => 1,
        'fields'    => [
            [
                'name' => 'buffer_time',
                'title' => 'galaxyclinic::app.admin.system.buffer-time',
                'type' => 'text',
                'validation' => 'required|min_value:0|max_value:100',
                'channel_based' => true,
                'locale_based' => false
            ], [
                'name' => 'default_therapists_group',
                'title' => 'galaxyclinic::app.admin.system.default-therapists-group',
                'type' => 'select',
                'options' => $options
            ], [
                'name' => 'default_company_group',
                'title' => 'galaxyclinic::app.admin.system.default-company-group',
                'type' => 'select',
                'options' => $options
            ]
        ]
    ],
];