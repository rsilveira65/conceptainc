<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 14/03/19
 * Time: 18:36
 */

namespace Concepta\APIFetcherModules\Service;

/**
 * Class ResponsePrettifyService
 *
 * @package Concepta\APIFetcherModules\Service
 * @author Rafael Silveira <me@rsilveira.dev>
 */
class ResponsePrettifyService
{
    /**
     * @param \Exception $ex
     * @return mixed|string
     */
    public function formatErrorResponse(\Exception $ex)
    {
        return json_encode([
            'data' => [
                'Status'     => 'Error',
                'Message'    => $ex->getMessage(),
                'Code'       => $ex->getCode(),
                'Stacktrace' => $ex->getTraceAsString(),
            ]
        ]);
    }


    /**
     * @param $response
     * @return mixed|string
     */
    public function formatResponse($response)
    {
        return $this->filterResponseResults($response);
    }


    /**
     * @param $response
     * @return array
     */
    private function filterResponseResults($response)
    {
        $responseArray = json_decode($response, true);
        $prettyResponse = [];

        //filtering code, destination, name and all photos with type “s”
        foreach ($responseArray['Result'] as $responseItem) {

            $prettyResponse[] = [
                'code'        => $responseItem['TicketInfo']['Code'],
                'destination' => $responseItem['TicketInfo']['Destination']['Code'],
                'name'        => $responseItem['TicketInfo']['Destination']['Code'],
                'photos'      => $this->filterTicketPhotos($responseItem['TicketInfo']['ImageList'])
            ];
        }

        return $prettyResponse;
    }

    /**
     * @param $photos
     * @param string $type
     * @return array
     */
    private function filterTicketPhotos($photos, $type = "s")
    {
        $filteredPhotos = [];
        foreach ($photos as $photo) {

            if (!(strtolower($photo['Type']) === "s")) continue;

            $filteredPhotos[] = $photo;
        }

        return $filteredPhotos;
    }

}
