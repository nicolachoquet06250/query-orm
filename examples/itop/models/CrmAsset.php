<?php

namespace examples\itop\models;

use QueryOrm\Accessors;
use QueryOrm\StatusEnum;

class CrmAsset extends FunctionalCI
{
    #[Accessors(
        getter: 'getBillingCode',
        setter: 'setBillingCode'
    )]
    private ?string $billing_code = null;
    private StatusEnum $status = StatusEnum::IMPLEMENTATION;
    #[Accessors(
        getter: 'getCrmReference',
        setter: 'setCrmReference'
    )]
    private ?string $crm_reference = null;
    #[Accessors(
        getter: 'getFunctionalcisList',
        setter: 'setFunctionalcisList'
    )]
    /**
     * @var array<array{
     *     functionalci_id: string,
     *     friendlyname: string,
     *     functionalci_id_friendlyname: string,
     *     functionalci_id_finalclass_recall: string,
     *     functionalci_id_obsolescence_flag: string,
     * }> $functionalcis_list
     */
    private array $functionalcis_list = [];
    #[Accessors(
        getter: 'getLocationId',
        setter: 'setLocationId'
    )]
    private ?int $location_id = null;
    public string $finalclass = 'CrmAssets';
    #[Accessors(
        getter: 'getObsolescenceFlag',
        setter: 'setObsolescenceFlag'
    )]
    private ?string $obsolescence_flag = null;
    #[Accessors(
        getter: 'getLocationIdFriendlyname',
        setter: 'setLocationIdFriendlyname'
    )]
    private ?string $location_id_friendlyname = null;
    #[Accessors(
        getter: 'getLocationIdObsolescenceFlag',
        setter: 'setLocationIdObsolescenceFlag'
    )]
    private ?string $location_id_obsolescence_flag = null;
}