<?php

return [

    'imagen-banner-home' => [
        'value' => (object)['setting::mainimage' => null],
        'name' => 'medias_single',
        'fakeFieldName' => 'icustom::imagen-banner-home',
        'type' => 'media',
        'groupName' => 'banner-home',
        'groupTitle' => 'icustom::common.title-banner-home',
        'props' => [
            'label' => 'icustom::common.image-banner-home',
            'zone' => 'setting::mainimage',
            'entity' => "Modules\Setting\Entities\Setting",
            'entityId' => null
        ]
    ],
];