<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 14/03/19
 * Time: 19:38
 */

namespace Concepta\APIFetcherModules\Service;

/**
 * Class TokenValidatorService
 *
 * @package Concepta\APIFetcherModules\Service
 * @author Rafael Silveira <me@rsilveira.dev>
 */
class TokenValidatorService
{
    /**
     * @param $token
     */
    public function setToken($token)
    {
        update_option('concepta_token', $token);
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        $token = get_option('concepta_token');

        return $token['access_token'];
    }

    /**
     * @return bool
     */
    public function isTokenValid()
    {
        $token = get_option('concepta_token');

        if (!$token) {
            return false;
        }

        //Checking if the token get expired
        if ((new \DateTime('now'))->getTimestamp() > strtotime($token['.expires'])) {
            return false;
        }

        return true;
    }
}
