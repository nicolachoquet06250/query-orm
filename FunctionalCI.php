<?php

use QueryOrm\itop\ItopModel;
use QueryOrm\BinaryEnum;
use QueryOrm\CriticityEnum;

class FunctionalCI extends ItopModel
{
    public string $alias {
        get => 'CI';
    }

    public function __construct(
        protected(set) int $id,
        protected(set) ?string $name = null,
        protected(set) ?string $description = null,
        protected(set) ?string $friendlyname = null,
        protected(set) ?string $org_id = null,
        protected(set) ?string $organization_name = null,
        protected(set) CriticityEnum $business_criticity = CriticityEnum::LOW,
        protected(set) ?string $move2production = null,
        protected(set) array $contacts_list = [],
        protected(set) array $documents_list = [],
        protected(set) array $applicationsolution_list = [],
        protected(set) array $softwares_list = [],
        protected(set) array $providercontracts_list = [],
        protected(set) array $services_list = [],
        protected(set) array $tickets_list = [],
        protected(set) array $accesspermissions_list = [],
        protected(set) ?string $overview_list = null,
        protected(set) BinaryEnum $needmonitoring = BinaryEnum::YES,
        protected(set) array $backups_list = [],
        protected(set) ?string $uniq_name = null,
        protected(set) array $crmassetss_list = [],
        protected(set) string $finalclass = 'FunctionalCI',
        protected(set) ?string $obsolescence_date = null,
        protected(set) ?string $org_id_friendlyname = null,
        protected(set) ?string $org_id_obsolescence_flag = null,
    )
    {}
}