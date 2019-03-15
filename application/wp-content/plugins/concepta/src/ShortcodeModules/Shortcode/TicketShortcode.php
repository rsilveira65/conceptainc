<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 14/03/19
 * Time: 19:26
 */

namespace Concepta\ShortcodeModules\Shortcode;

use Concepta\Core\AbstractClass\AbstractShortcode;

/**
 * Class TicketShortcode
 *
 * @package Concepta\ShortcodeModules\Shortcode
 * @author Rafael Silveira <me@rsilveira.dev>
 */
class TicketShortcode extends AbstractShortcode
{
    protected $name = 'concepta_ticket_shortcode';

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     */
    public function run($attributes, $content)
    {
        foreach ($attributes as $key => $attr) {

            if (preg_match('/\.js$/i', $attr)) {
                wp_enqueue_script("concepta-$key", $attr);
            }

            if  (preg_match('/\.css$/i', $attr)) {
                wp_enqueue_style("concepta-$key", $attr);
            }
        }

        return "<div id='root'></div>";
    }
}
