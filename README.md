Legal Things - Autodocx client
==================

Autodocx can process Mustache templates using [Ractive.js](http://www.ractivejs.org/).

**[API documentation](http://docs.autodocx.apiary.io)**

## Requirements

- [PHP](http://www.php.net) >= 5.5.0

_Required PHP extensions are marked by composer_

## Installation

The library can be installed using composer. Add the following to your `composer.json`:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/legalthings/autodocx-client"
        }
    ],
    require: {
        "legalthings/autodocx-client": "~0.1.0"
    }


## Usage

    LegalThings\Autodocx::process($content, $data);

type   | parameter    | description
------ | ------------ | --------------- 
string | $content     | The template
array  | $data        | Associative array with values


### Configuration (do this only once)

    LegalThings\LegalMail::$url = App::config()->legalmail->url;


## Testing

You may use the [Guzzle Mock Handler](http://guzzle.readthedocs.org/en/latest/testing.html#mock-handler) when performing
tests that include Autodocx.

    use LegalThings\Autodocx;
    use GuzzleHttp\Handler\MockHandler;
    use GuzzleHttp\HandlerStack;
    use GuzzleHttp\Psr7\Response;

    $mock = new MockHandler([
        new Response(200)
    ]);

    $handler = HandlerStack::create($mock);
    Autodocx::$guzzleOptions = ['handler' => $mock];
    
    // Request is intercepted
    Autodocx::process($content, $data);
