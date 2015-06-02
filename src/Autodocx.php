<?php

/**
 * Interface to the Autodocx API
 */
class Autodocx
{
    /**
     * The URL to the API
     * @var string
     */
    public static $url;
    
    /**
     * Additional guzzle options
     * @var array
     */
    public static $guzzleOptions = [];
    
    /**
     * Processes mustache-like content with the data given 
     * 
     * @param string $content
     * @param array $data
     * @return string
     */
    public static function process($content, $data)
    {
        $options = static::$guzzleOptions;
        $options['base_url'] = static::$url;
        
        if (!isset($options['defaults'])) $options['defaults'] = [];
        if (!isset($options['defaults']['headers'])) $options['defaults']['headers'] = [];
        $options['defaults']['headers']['Content-Type'] = 'application/json';
        
        $client = new GuzzleHttp\Client($options);


        $payload = [
            'body' => $content,
            'data' => $data
        ];

        $request = $client->createRequest('POST', '/');
        $request->setBody(GuzzleHttp\Stream\Stream::factory(json_encode($payload)));
        $response = $client->send($request);
        $body = $response->getBody();
        return (string)$body;
    }
}
