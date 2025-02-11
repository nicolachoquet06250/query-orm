<?php

use QueryOrm\StatusEnum;

class CrmAsset extends FunctionalCI
{
    private ?string $billing_code = null;
    private StatusEnum $status = StatusEnum::IMPLEMENTATION;
    private ?string $crm_reference = null;
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
    private ?int $location_id = null;
    public string $finalclass = 'CrmAssets';
    private ?string $obsolescence_flag = null;
    private ?string $location_id_friendlyname = null;
    private ?string $location_id_obsolescence_flag = null;

    public function getBillingCode(): ?string
    {
        return $this->billing_code;
    }
    public function setBillingCode(?string $billing_code): self
    {
        $this->billing_code = $billing_code;
        return $this;
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }
    public function setStatus(StatusEnum|string $status): self
    {
        if (is_string($status)) {
            $status = StatusEnum::from($status);
        }
        $this->status = $status;
        return $this;
    }

    public function getCrmReference(): ?string
    {
        return $this->crm_reference;
    }
    public function setCrmReference(?string $crm_reference): self
    {
        $this->crm_reference = $crm_reference;
        return $this;
    }

    /**
     * @return array<array{
     *     functionalci_id: string,
     *     friendlyname: string,
     *     functionalci_id_friendlyname: string,
     *     functionalci_id_finalclass_recall: string,
     *     functionalci_id_obsolescence_flag: string,
     * }>
     */
    public function getFunctionalcisList(): array
    {
        return $this->functionalcis_list;
    }
    public function setFunctionalcisList(array $functionalcis_list): self
    {
        $this->functionalcis_list = $functionalcis_list;
        return $this;
    }

    public function getLocationId(): ?int
    {
        return $this->location_id;
    }
    public function setLocationId(?int $location_id): self
    {
        $this->location_id = $location_id;
        return $this;
    }

    public function getObsolescenceFlag(): ?string
    {
        return $this->obsolescence_flag;
    }
    public function setObsolescenceFlag(?string $obsolescence_flag): self
    {
        $this->obsolescence_flag = $obsolescence_flag;
        return $this;
    }

    public function getLocationIdFriendlyname(): ?string
    {
        return $this->location_id_friendlyname;
    }
    public function setLocationIdFriendlyname(?string $location_id_friendlyname): self
    {
        $this->location_id_friendlyname = $location_id_friendlyname;
        return $this;
    }

    public function getLocationIdObsolescenceFlag(): ?string
    {
        return $this->location_id_obsolescence_flag;
    }
    public function setLocationIdObsolescenceFlag(?string $location_id_obsolescence_flag): self
    {
        $this->location_id_obsolescence_flag = $location_id_obsolescence_flag;
        return $this;
    }
}