<?php

namespace App\Libraries\Integrations;

class SchemaDictionary
{
    const VENDOR_PMS1 = 'PMS1';
    const VENDOR_PMS2 = 'PMS2';

    const MAP = [
        [
            'vendor' => self::VENDOR_PMS1,
            'id' => 'http://api.example.com/pms1-schema.json',
            'file' => '/var/www/html/app/Libraries/Integrations/Schemas/pms1-schema.json'
        ],
        [
            'vendor' => self::VENDOR_PMS2,
            'id' => 'http://api.example.com/pms2-schema.json',
            'file' => '/var/www/html/app/Libraries/Integrations/Schemas/pms2-schema.json'
        ]
    ];
}
