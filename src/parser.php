<?php
function http_parse_headers ($raw_headers) {
        $headers = array(); // $headers = [];
  
        foreach (explode("\n", $raw_headers) as $i => $h) {
            $h = explode(':', $h, 2);
           
            if (isset($h[1])) {
                if(!isset($headers[$h[0]])) {
                    $headers[$h[0]] = trim($h[1]);
                } else if(is_array($headers[$h[0]])) {
                    $tmp = array_merge($headers[$h[0]],array(trim($h[1])));
                    $headers[$h[0]] = $tmp;
                } else {
                    $tmp = array_merge(array($headers[$h[0]]),array(trim($h[1])));
                    $headers[$h[0]] = $tmp;
                }
            }
        }
       
        return $headers;
}