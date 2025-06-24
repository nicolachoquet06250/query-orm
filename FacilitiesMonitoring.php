<?php

use QueryOrm\BinaryEnum;
use QueryOrm\CriticityEnum;
use QueryOrm\StatusEnum;

class FacilitiesMonitoring extends FunctionalCI
{
    public string $alias {
        get => 'FM';
    }

    public function __construct(
        int $id,
        ?string $name = null,
        ?string $description = null,
        ?string $friendlyname = null,
        ?string $org_id = null,
        ?string $organization_name = null,
        CriticityEnum $business_criticity = CriticityEnum::LOW,
        ?string $move2production = null,
        array $contacts_list = [],
        array $documents_list = [],
        array $applicationsolution_list = [],
        array $softwares_list = [],
        array $providercontracts_list = [],
        array $services_list = [],
        array $tickets_list = [],
        array $accesspermissions_list = [],
        ?string $overview_list = null,
        BinaryEnum $needmonitoring = BinaryEnum::YES,
        array $backups_list = [],
        ?string $uniq_name = null,
        array $crmassetss_list = [],
        string $finalclass = 'FacilitiesMonitoring',
        ?string $obsolescence_date = null,
        ?string $org_id_friendlyname = null,
        ?string $org_id_obsolescence_flag = null,
        protected(set) ?string $organization_euclyde_id = null,
        protected(set) ?StatusEnum $status = null,
        protected(set) ?string $functional_id = null,
        protected(set) ?string $functionalci_name = null,
        protected(set) ?string $modele_id = null,
        protected(set) ?string $modele_name = null,
        protected(set) ?string $monitoring_id = null,
        protected(set) ?string $monitoring_url = null,
        protected(set) ?string $etiquettes = null,
        protected(set) ?string $monitoring_box_id = null,
        protected(set) ?string $monitoring_box_name = null,
        protected(set) ?string $controle_id = null,
        protected(set) ?string $controle_name = null,
        protected(set) ?string $seuil_control_alerte = null,
        protected(set) ?string $seuil_control_critique = null,
        protected(set) ?string $category = null,
        protected(set) ?string $monitoring_host_standard_account = null,
        protected(set) ?string $monitoring_host_snmp = null,
        protected(set) ?string $monitoring_collecte_elect = null,
        protected(set) ?string $appsmonitoring_list = null,
        protected(set) ?string $obsolescence_flag = null,
        protected(set) ?string $functionalci_id = null,
        protected(set) ?string $functionalci_id_friendlyname = null,
        protected(set) ?string $functionalci_id_finalclass_recall = null,
        protected(set) ?string $functionalci_id_obsolescence_flag = null,
        protected(set) ?string $modele_id_friendlyname = null,
        protected(set) ?string $monitoring_box_id_friendlyname = null,
        protected(set) ?string $monitoring_box_id_finalclass_recall = null,
        protected(set) ?string $monitoring_box_id_obsolescence_flag = null,
        protected(set) ?string $controle_id_friendlyname = null,
    )
    {
        parent::__construct(
            $id,
            $name,
            $description,
            $friendlyname,
            $org_id,
            $organization_name,
            $business_criticity,
            $move2production,
            $contacts_list,
            $documents_list,
            $applicationsolution_list,
            $softwares_list,
            $providercontracts_list,
            $services_list,
            $tickets_list,
            $accesspermissions_list,
            $overview_list,
            $needmonitoring,
            $backups_list,
            $uniq_name,
            $crmassetss_list,
            $finalclass,
            $obsolescence_date,
            $org_id_friendlyname,
            $org_id_obsolescence_flag,
        );
    }
}