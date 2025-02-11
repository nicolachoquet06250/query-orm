<?php

use QueryOrm\CriticityEnum;
use QueryOrm\StatusEnum;

class FacilitiesMonitoring extends FunctionalCI
{
    public string $alias {
        get => 'FM';
    }

    public function __construct(
        protected(set) ?string $organization_euclyde_id = null,
        protected(set) CriticityEnum $business_criticity = CriticityEnum::LOW,
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
        protected(set) string $finalclass = 'FacilitiesMonitoring',
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
    {}
}