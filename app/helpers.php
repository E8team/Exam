<?php  /* 辅助函数 */

function isSameHost( $url )
{
    return app(\Illuminate\Http\Request::class)->getHost() == parse_url($url, PHP_URL_HOST);
}