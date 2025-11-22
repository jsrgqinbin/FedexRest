<?php

namespace FedexRest\Services\Pickup;

use FedexRest\Services\AbstractRequest;
use FedexRest\Services\Pickup\Entity\CustomPickupAddress;

class CustomCreatePickupAvailability extends AbstractRequest
{
    // Required
    protected CustomPickupAddress $pickupAddress;
    protected array $pickupRequestType;
    protected array $carriers;
    protected string $countryRelationship;

    // Optional
    protected ?string $dispatchDate = null;
    protected ?string $packageReadyTime = null;
    protected ?string $customerCloseTime = null;
    protected ?string $pickupType = null;
    protected ?array $shipmentAttributes = null;
    protected ?int $numberOfBusinessDays = null;
    protected ?array $packageDetails = null;
    protected ?string $associatedAccountNumber = null;
    protected ?string $associatedAccountNumberType = null;
    protected ?array $version = null;

    public function getPickupAddress(): CustomPickupAddress
    {
        return $this->pickupAddress;
    }

    public function setPickupAddress(CustomPickupAddress $pickupAddress): CustomCreatePickupAvailability
    {
        $this->pickupAddress = $pickupAddress;
        return $this;
    }

    public function getPickupRequestType(): array
    {
        return $this->pickupRequestType;
    }

    public function setPickupRequestType(array $pickupRequestType): CustomCreatePickupAvailability
    {
        $this->pickupRequestType = $pickupRequestType;
        return $this;
    }


    public function getCarriers(): array
    {
        return $this->carriers;
    }

    public function setCarriers(array $carriers): CustomCreatePickupAvailability
    {
        $this->carriers = $carriers;
        return $this;
    }

    public function getCountryRelationship(): string
    {
        return $this->countryRelationship;
    }

    public function setCountryRelationship(string $countryRelationship): CustomCreatePickupAvailability
    {
        $this->countryRelationship = $countryRelationship;
        return $this;
    }

    public function getDispatchDate(): ?string
    {
        return $this->dispatchDate;
    }

    public function setDispatchDate(?string $dispatchDate): CustomCreatePickupAvailability
    {
        $this->dispatchDate = $dispatchDate;
        return $this;
    }

    public function getPackageReadyTime(): ?string
    {
        return $this->packageReadyTime;
    }

    public function setPackageReadyTime(?string $packageReadyTime): CustomCreatePickupAvailability
    {
        $this->packageReadyTime = $packageReadyTime;
        return $this;
    }

    public function getCustomerCloseTime(): ?string
    {
        return $this->customerCloseTime;
    }

    public function setCustomerCloseTime(?string $customerCloseTime): CustomCreatePickupAvailability
    {
        $this->customerCloseTime = $customerCloseTime;
        return $this;
    }

    public function getPickupType(): ?string
    {
        return $this->pickupType;
    }

    public function setPickupType(?string $pickupType): CustomCreatePickupAvailability
    {
        $this->pickupType = $pickupType;
        return $this;
    }

    public function getShipmentAttributes(): ?array
    {
        return $this->shipmentAttributes;
    }

    public function setShipmentAttributes(?array $shipmentAttributes): CustomCreatePickupAvailability
    {
        $this->shipmentAttributes = $shipmentAttributes;
        return $this;
    }

    public function getNumberOfBusinessDays(): ?int
    {
        return $this->numberOfBusinessDays;
    }

    public function setNumberOfBusinessDays(?int $numberOfBusinessDays): CustomCreatePickupAvailability
    {
        $this->numberOfBusinessDays = $numberOfBusinessDays;
        return $this;
    }

    public function getPackageDetails(): ?array
    {
        return $this->packageDetails;
    }

    public function setPackageDetails(?array $packageDetails): CustomCreatePickupAvailability
    {
        $this->packageDetails = $packageDetails;
        return $this;
    }

    public function getAssociatedAccountNumber(): ?string
    {
        return $this->associatedAccountNumber;
    }

    public function setAssociatedAccountNumber(?string $associatedAccountNumber): CustomCreatePickupAvailability
    {
        $this->associatedAccountNumber = $associatedAccountNumber;
        return $this;
    }

    public function getAssociatedAccountNumberType(): ?string
    {
        return $this->associatedAccountNumberType;
    }

    public function setAssociatedAccountNumberType(?string $associatedAccountNumberType): CustomCreatePickupAvailability
    {
        $this->associatedAccountNumberType = $associatedAccountNumberType;
        return $this;
    }

    public function getVersion(): ?array
    {
        return $this->version;
    }

    public function setVersion(?array $version): CustomCreatePickupAvailability
    {
        $this->version = $version;
        return $this;
    }

    public function setApiEndpoint(): string
    {
        return '/pickup/v1/pickups/availabilities';
    }


    public function prepare(): array
    {
        if (empty($this->pickupAddress)) {
            throw new \InvalidArgumentException('pickupAddress is required');
        }
        if (empty($this->pickupRequestType)) {
            throw new \InvalidArgumentException('pickupRequestType is required');
        }
        if (empty($this->carriers)) {
            throw new \InvalidArgumentException('carriers is required');
        }
        if (empty($this->countryRelationship)) {
            throw new \InvalidArgumentException('countryRelationship is required');
        }

        $data = [
            'pickupAddress' => $this->pickupAddress->prepare(),
            'pickupRequestType' => $this->pickupRequestType,
            'carriers' => $this->carriers,
            'countryRelationship' => $this->countryRelationship,
        ];

        if (!empty($this->dispatchDate)) {
            $data['dispatchDate'] = $this->dispatchDate;
        }
        if (!empty($this->packageReadyTime)) {
            $data['packageReadyTime'] = $this->packageReadyTime;
        }
        if (!empty($this->customerCloseTime)) {
            $data['customerCloseTime'] = $this->customerCloseTime;
        }
        if (!empty($this->pickupType)) {
            $data['pickupType'] = $this->pickupType;
        }
        if (!empty($this->shipmentAttributes)) {
            $data['shipmentAttributes'] = $this->shipmentAttributes;
        }
        if (!empty($this->numberOfBusinessDays)) {
            $data['numberOfBusinessDays'] = $this->numberOfBusinessDays;
        }
        if (!empty($this->packageDetails)) {
            $data['packageDetails'] = $this->packageDetails;
        }
        if (!empty($this->associatedAccountNumber)) {
            $data['associatedAccountNumber'] = $this->associatedAccountNumber;
        }
        if (!empty($this->associatedAccountNumberType)) {
            $data['associatedAccountNumberType'] = $this->associatedAccountNumberType;
        }
        if (!empty($this->version)) {
            $data['version'] = $this->version;
        }

        return $data;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface|string|void
     * @throws \FedexRest\Exceptions\MissingAccessTokenException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request()
    {
        parent::request();
        try {
            $query = $this->http_client->post($this->getApiUri($this->api_endpoint), [
                'json' => $this->prepare(),
                'http_errors' => FALSE,
            ]);
            return ($this->raw === true) ? $query : json_decode($query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
