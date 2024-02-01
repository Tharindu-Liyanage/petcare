<?php

//simple page redirect

function redirect($page){
    header('location: ' . URLROOT . '/' .$page);
}

function getParameterFromUrl($index) {
    // Get the full URL
    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // Parse the URL
    $urlComponents = parse_url($currentURL);

    // Extract the path
    $path = $urlComponents['path'];

    // Split the path into an array
    $pathParts = explode('/', $path);

    // Find the position of the last '/' in the array
    $lastSlashIndex = array_search('', array_reverse($pathParts));

    // Extract parameters starting from the last '/' onward
    $parameters = array_slice($pathParts, $lastSlashIndex);

    // Remove the empty element caused by the trailing '/'
    array_pop($parameters);

    // Return the parameter at the specified index, or null if the index is out of bounds
    return isset($parameters[$index]) ? $parameters[$index] : null;
}

