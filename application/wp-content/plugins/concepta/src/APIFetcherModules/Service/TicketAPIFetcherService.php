<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 14/03/19
 * Time: 17:23
 */

namespace Concepta\APIFetcherModules\Service;

/**
 * Class TicketAPIFetcherService
 *
 * @package Concepta\APIFetcherModules\Service
 * @author Rafael Silveira <me@rsilveira.dev>
 */
class TicketAPIFetcherService
{
    /**
     * @return array|mixed|object
     * @throws \Exception
     */
    static public function requestTickets()
    {
        try {
            $configs = self::getConfigs();

            $today = new \DateTime('now');
            $nextWeek = clone $today;
            $nextWeek->add(new \DateInterval('P7D'));

            $content = [
                'language'    => 'ENG',
                'Currency'    => 'USD',
                'destination' => 'MCO',
                'DateFrom'    => $today->format('m/d/Y'),
                'DateTO'      => $nextWeek->format('m/d/Y'),
                'Occupancy' => [
                    'AdultCount' => '1',
                    'ChildCount' => '1',
                    'ChildAges'  => ['10']
                ],
            ];

            $headers = [
                'Content-type: application/json',
                sprintf('Authorization: Bearer %s', self::requestAuthorizationToken())
            ];

            $response = self::request(
                $configs['endpoints']['ticketSearchEndpoint'],
                json_encode($content, true),
                $headers
            );

            return (new ResponsePrettifyService())->formatResponse($response);

        } catch (\Exception $ex) {
            return (new ResponsePrettifyService())->formatErrorResponse($ex);
        }
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    static private function requestAuthorizationToken()
    {
        $tokenValidatorService = new TokenValidatorService();

        if ($tokenValidatorService->isTokenValid()) {
            return $tokenValidatorService->getToken();
        }

        $configs = self::getConfigs();

        $content = sprintf(
            'grant_type=password&username=%s&password=%s',
            $configs['user'],
            $configs['password']
        );

        $endpoint = $configs['endpoints']['tokenEndpoint'];

        $response = self::request(
            $endpoint,
            $content,
            "Content-type: application/x-www-form-urlencoded"
        );

        $response = json_decode($response, true);

        if (!$response['access_token']) {
            throw new \Exception('Invalid access token.', 400);
        }

        $tokenValidatorService->setToken($response);

        return $response['access_token'];
    }

    /**
     * @param $endpoint
     * @param $content
     * @param $header
     * @return bool|string
     */
    static private function request($endpoint, $content, $header)
    {
        $options = [
            'http' => [
                'header'  => $header,
                'method'  => 'POST',
                'content' => $content
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($endpoint, false, $context);

        return $response;
    }

    /**
     * @return array|mixed|object
     */
    static private function getConfigs()
    {
        return json_decode(
            file_get_contents(
                CONCEPTA__PLUGIN_DIR . 'src/APIFetcherModules/Configs/configs.json'
            ),
            true
        );
    }
}
