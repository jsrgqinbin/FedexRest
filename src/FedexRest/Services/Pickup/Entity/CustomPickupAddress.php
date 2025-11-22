<?php

namespace FedexRest\Services\Pickup\Entity;

class CustomPickupAddress
{
    /** @var string[] */
    protected array $streetLines = [];
    protected ?string $urbanizationCode = null;
    protected ?string $city = null;
    protected ?string $stateOrProvinceCode = null;
    protected string $postalCode;
    protected string $countryCode;
    protected ?bool $residential = null;
    protected ?string $addressClassification = null;

    /**
     * @return array
     */
    public function getStreetLines(): array
    {
        return $this->streetLines;
    }

    /**
     * @param string ...$streetLines
     * @return CustomPickupAddress
     */
    public function setStreetLines(...$streetLines): CustomPickupAddress
    {
        $this->streetLines = $streetLines;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrbanizationCode(): ?string
    {
        return $this->urbanizationCode;
    }

    /**
     * @param string|null $urbanizationCode
     * @return CustomPickupAddress
     */
    public function setUrbanizationCode(?string $urbanizationCode): CustomPickupAddress
    {
        $this->urbanizationCode = $urbanizationCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return CustomPickupAddress
     */
    public function setCity(?string $city): CustomPickupAddress
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStateOrProvinceCode(): ?string
    {
        return $this->stateOrProvinceCode;
    }

    /**
     * @param string|null $stateOrProvinceCode
     * @return CustomPickupAddress
     */
    public function setStateOrProvinceCode(?string $stateOrProvinceCode): CustomPickupAddress
    {
        $this->stateOrProvinceCode = $stateOrProvinceCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return CustomPickupAddress
     */
    public function setPostalCode(string $postalCode): CustomPickupAddress
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return CustomPickupAddress
     */
    public function setCountryCode(string $countryCode): CustomPickupAddress
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getResidential(): ?bool
    {
        return $this->residential;
    }

    /**
     * @param bool|null $residential
     * @return CustomPickupAddress
     */
    public function setResidential(?bool $residential): CustomPickupAddress
    {
        $this->residential = $residential;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddressClassification(): ?string
    {
        return $this->addressClassification;
    }

    /**
     * @param string|null $addressClassification
     * @return CustomPickupAddress
     */
    public function setAddressClassification(?string $addressClassification): CustomPickupAddress
    {
        $this->addressClassification = $addressClassification;
        return $this;
    }

    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function prepare(): array
    {
        if (empty($this->postalCode)) {
            throw new \InvalidArgumentException('postalCode is required');
        }
        if (empty($this->countryCode)) {
            throw new \InvalidArgumentException('countryCode is required');
        }

        $data = [
            'postalCode' => $this->postalCode,
            'countryCode' => $this->countryCode,
        ];

        if (!empty($this->streetLines)) {
            $data['streetLines'] = $this->streetLines;
        }

        if (!empty($this->urbanizationCode)) {
            $data['urbanizationCode'] = $this->urbanizationCode;
        }

        if (!empty($this->city)) {
            $data['city'] = $this->city;
        }

        if (!empty($this->stateOrProvinceCode)) {
            $data['stateOrProvinceCode'] = $this->stateOrProvinceCode;
        }

        if ($this->residential !== null) {
            $data['residential'] = $this->residential;
        }

        if (!empty($this->addressClassification)) {
            $data['addressClassification'] = $this->addressClassification;
        }

        return $data;
    }
}
