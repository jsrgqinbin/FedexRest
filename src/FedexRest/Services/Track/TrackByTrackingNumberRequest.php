<?php


namespace FedexRest\Services\Track;


use FedexRest\Exceptions\MissingTrackingNumberException;
use FedexRest\Services\AbstractRequest;
use GuzzleHttp\Client;

class TrackByTrackingNumberRequest extends AbstractRequest
{
    private array $tracking_number;
    private bool $include_detailed_scans = false;


    /**
     * @return mixed|string
     */
    public function setApiEndpoint()
    {
        return '/track/v1/trackingnumbers';
    }

    /**
     * @param $tracking_number
     * @return $this
     */
    public function setTrackingNumber($tracking_number)
    {
        $this->tracking_number = (array) $tracking_number;
        return $this;
    }

    public function response()
    {
        parent::response();

        if (empty($this->tracking_number)) {
            throw new MissingTrackingNumberException('Please enter at least one tracking number');
        }

        try {
            $httpClient = new Client([
                'headers' => [
                    'Authorization' => "Bearer {$this->access_token}",
                    'Content-Type' => 'application/json'
                ],
            ]);
            $query = $httpClient->post($this->getApiUri($this->api_endpoint), [
                'json' => [
                    'includeDetailedScans' => $this->include_detailed_scans,
                    'trackingInfo' => $this->preparedData(),
                ]
            ]);
            return json_decode(($this->raw === true) ? $query : $query->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return array
     */
    private function preparedData()
    {
        $data = [];
        foreach ($this->tracking_number as $token) {
            array_push($data, [
                'trackingNumberInfo' =>
                    [
                        'trackingNumber' => $token,
                    ],
            ]);
        }

        return $data;
    }

    /**
     * @return $this
     */
    public function includeDetailedScans()
    {
        $this->include_detailed_scans = true;
        return $this;
    }
}
