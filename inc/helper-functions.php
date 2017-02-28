<?php
namespace ggi\helper_functions;

function ggi_include($url)
{
    // Initialize a cURL session
    $curl = curl_init($url);

    // TRUE to follow any "Location: " header that the server sends as part of the HTTP header (note this is recursive,
    //PHP will follow as many "Location: " headers that it is sent, unless CURLOPT_MAXREDIRS is set).
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // Execute the given cURL session.
    $file = curl_exec($curl);

    $info = curl_getinfo($curl);

    // Closes a cURL session and frees all resources. The cURL handle, curl, is also deleted.
    curl_close($curl);

    if ($file === false || $info['http_code'] == 404) {
        return;
    }

    return $file;
}
