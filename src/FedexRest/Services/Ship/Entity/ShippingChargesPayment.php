<?php

namespace FedexRest\Services\Ship\Entity;

class ShippingChargesPayment
{
    public ?string $paymentType;
    public ?string $accountNumber;

    /**
     * @param  string  $paymentType
     * @return $this
     */
    public function setPaymentType(string $paymentType): ShippingChargesPayment
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @param  string  $accountNumber
     * @return $this
     */
    public function setThirdPartyAccountNumber(string $accountNumber): ShippingChargesPayment
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    public function prepare(): array
    {
        $data = [];
        if (!empty($this->paymentType)) {
            $data['paymentType'] = $this->paymentType;
        }
        if (!empty($this->accountNumber)) {
            $data['payor'] = $data['payor'] ?? [];
            $data['payor']['responsibleParty'] = $data['payor']['responsibleParty'] ?? [];
            $data['payor']['responsibleParty']['accountNumber'] = $data['payor']['responsibleParty']['accountNumber'] ?? [];
            $data['payor']['responsibleParty']['accountNumber']['value'] = $this->accountNumber ?? '';
        }
        return $data;
    }
}
