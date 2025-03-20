<?php

if (!function_exists('mobile')) {
    function mobile() {
        $agent = new \Jenssegers\Agent\Agent;
        return $agent->isMobile();
    }
} 