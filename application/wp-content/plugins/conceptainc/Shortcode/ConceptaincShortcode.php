<?php

if (!function_exists('Conceptainc_Shortcode')) {
    function Conceptainc_Shortcode($attr, $content = null)
    {
        $tickets = ConceptaincAPICaller::requestTickets();

        //TODO embed React App.

        return ConceptaincShortcodeRender::view(
            'shortcode',
            compact('tickets')
        );
    }
}

add_shortcode('conceptainc_shortcode', 'Conceptainc_Shortcode');

