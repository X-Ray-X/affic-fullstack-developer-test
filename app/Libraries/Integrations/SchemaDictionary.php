<?php

namespace App\Libraries\Integrations;

class SchemaDictionary
{
    const VENDOR_PMS1 = 'PMS1';
    const VENDOR_PMS2 = 'PMS2';

    const MAP = [
        [
            'vendor' => self::VENDOR_PMS1,
            'id' => 'http://api.example.com/Pms1SchemaConfig.json',
            'file' => '/var/www/html/app/Libraries/Integrations/Schemas/Pms1SchemaConfig.json'
        ],
        [
            'vendor' => self::VENDOR_PMS2,
            'id' => 'http://api.example.com/Pms2SchemaConfig.json',
            'file' => '/var/www/html/app/Libraries/Integrations/Schemas/Pms2SchemaConfig.json'
        ]
    ];
}
