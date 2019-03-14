<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 14/03/19
 * Time: 17:31
 */

namespace Concepta\APIModules\Action;

use Concepta\APIFetcherModules\Service\TicketAPIFetcherService;
use Concepta\Core\AbstractClass\AbstractAction;

/**
 * Class RestEndpointAction
 *
 * @package Concepta\APIModules\Action
 * @author Rafael Silveira <me@rsilveira.dev>
 */

class RestEndpointAction extends AbstractAction
{
    /**
     * @var string
     */
    protected $action = 'rest_api_init';

    /**
     * @var int
     */
    protected $priority = 10;

    public function run()
    {
        register_rest_route(
            'concepta/v1', '/tickets', [
            'methods' => 'POST',
            'callback' =>  __NAMESPACE__ . '\\RestEndpointAction::handleAPIResponse',
        ] );
    }

    /**
     * @param \WP_REST_Request $request
     * @return array|mixed|object
     * @throws \Exception
     */
    static function handleAPIResponse(\WP_REST_Request $request)
    {
        return TicketAPIFetcherService::requestTickets();
    }
}
