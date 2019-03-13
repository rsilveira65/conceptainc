<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 13/03/19
 * Time: 17:33
 */

class ConceptaincAPICaller
{
    static public function init()
    {
        self::requireClasses();
    }

    /**
     * @return bool|string
     */
    static public function requestTickets()
    {
        $configs = self::getConfigs();

        $content = [
            'language' => 'ENG',
            'Currency' => 'USD',
            'destination' => 'MCO',
            'DateFrom' => '3/13/2019',
            'DateTO' => '11/29/2016',
            'Occupancy' => [
                'AdultCount' => '1',
                'ChildCount' => '1',
                'ChildAges' => ['10']
            ],
        ];

        $headers = [
            'Content-type: application/json',
            sprintf('Authorization: Bearer %s', self::requestAuthorizationToken())
        ];

        $response = self::request(
            $configs['ticketSearchEndpoint'],
            json_encode($content, true),
            $headers
        );

        return json_decode($response, true);
    }

    /**
     * @return bool|string
     */
    static private function requestAuthorizationToken()
    {
        $configs = self::getConfigs();

        $content = sprintf(
            'grant_type=password&username=%s&password=%s',
            $configs['user'],
            $configs['password']
        );

        $endpoint = $configs['tokenEndpoint'];

        $response = self::request(
            $endpoint,
            $content,
            "Content-type: application/x-www-form-urlencoded\r\n"
        );

        return json_decode($response , true)['access_token'];
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
                CONCEPTAINC__PLUGIN_DIR . '/API/configs.json'
            ),
            true
        );
    }

    static public function requireClasses()
    {

    }
}
