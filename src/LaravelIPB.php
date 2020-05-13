<?php

namespace MBozwood\IPBoardApi;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use MBozwood\IPBoardApi\Endpoints\Calendar\Events;
use MBozwood\IPBoardApi\Endpoints\Forums\Posts;
use MBozwood\IPBoardApi\Endpoints\Forums\Topics;
use MBozwood\IPBoardApi\Endpoints\System\Hello;
use MBozwood\IPBoardApi\Endpoints\System\Members;
use Mockery\CountValidator\Exception;
use Psr\Http\Message\ResponseInterface;

class LaravelIPB
{
    use Hello, Members, Posts, Topics, Events;

    protected $url;
    protected $key;
    protected $ipbRequest;

    /**
     * Map the HTTP status codes to exceptions.
     *
     * @var array
     */
    private $error_exceptions = [
        // General/Unknown
        520       => \Exception::class,
        // Authorization.
        '3S290/7' => Exceptions\IpboardInvalidApiKey::class,
        '2S290/6' => Exceptions\IpboardNoApiKey::class,
        401       => Exceptions\IpboardInvalidApiKey::class,
        429       => Exceptions\IpboardThrottled::class,
        // Core/member
        '1C292/2' => Exceptions\IpboardMemberIdInvalid::class,
        '1C292/3' => Exceptions\IpboardMemberIdInvalid::class,
        '1C292/4' => Exceptions\IpboardMemberUsernameExists::class,
        '1C292/5' => Exceptions\IpboardMemberEmailExists::class,
        '1C292/6' => Exceptions\IpboardMemberInvalidGroup::class,
        '1C292/7' => Exceptions\IpboardMemberIdInvalid::class,
        '1C292/8' => Exceptions\IpboardMemberNoUsernameEmail::class,
        '1C292/9' => Exceptions\IpboardMemberNoPassword::class,
        // forums/posts
        '1F295/1' => Exceptions\IpboardForumTopicIdInvalid::class,
        '1F295/2' => Exceptions\IpboardMemberIdInvalid::class,
        '1F295/3' => Exceptions\IpboardPostInvalid::class,
        '1F295/4' => Exceptions\IpboardForumPostIdInvalid::class,
        '1F295/5' => Exceptions\IpboardForumPostIdInvalid::class,
        '2F295/6' => Exceptions\IpboardForumPostIdInvalid::class,
        '2F295/7' => Exceptions\IpboardMemberIdInvalid::class,
        '2F294/A' => Exceptions\IpboardForumNoPermissionPost::class,
        '2F295/A' => Exceptions\IpboardForumNoPermissionEdit::class,
        '2F295/B' => Exceptions\IpboardForumNoPermissionDelete::class,
        '1F295/B' => Exceptions\IpboardForumCannotDeleteFirstPost::class,
        // torums/topics
        '2F294/9' => Exceptions\IpboardForumTopicIdInvalid::class,
        '1F294/2' => Exceptions\IpboardForumIdInvalid::class,
        '1F294/3' => Exceptions\IpboardMemberIdInvalid::class,
        '1F294/4' => Exceptions\IpboardPostInvalid::class,
        '1F294/5' => Exceptions\IpboardTopicTitleInvalid::class,
        '1F294/7' => Exceptions\IpboardTopicNoForum::class,
        '1F294/8' => Exceptions\IpboardMemberIdInvalid::class,
        '2F294/B' => Exceptions\IpboardForumNoPermissionDelete::class,
    ];

    /**
     * Construct the IPBoard API package.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = config('ipboard_api.url');
        $this->key = config('ipboard_api.key');

        $this->ipbRequest = new GuzzleClient([
            'base_uri' => $this->url,
            'timeout'  => 10,
            'auth' => [
                $this->key, ''
            ]
        ]);
    }

    /**
     * Perform a get request.
     *
     * @param string $function The endpoint to call via GET.
     * @param array $extra Any query string parameters.
     *
     * @return string json return.
     * @throws \Exception
     */
    private function getRequest($function, $extra = [])
    {
        $url = $function.'?'.http_build_query($extra);
        $response = null;

        try {
            $response = $this->ipbRequest->get($url)->getBody();
            return json_decode($response, false);
        } catch (ClientException $e) {
            $this->handleError($e->getResponse());
        }
    }

    /**
     * Perform a post request.
     *
     * @param string $function The endpoint to perform a POST request on.
     * @param array $data The form data to be sent.
     *
     * @return mixed
     * @throws \Exception
     */
    private function postRequest($function, $data)
    {
        $response = null;
        try {
            $response = $this->ipbRequest->post($function, ['form_params' => $data])->getBody();
            return json_decode($response, false);
        } catch (ClientException $e) {
            $this->handleError($e->getResponse());
        }
    }

    /**
     * Perform a put request.
     *
     * @param string $function The endpoint to perform a POST request on.
     * @param array $data The form data to be sent.
     *
     * @return mixed
     * @throws \Exception
     */
    private function putRequest($function, $data)
    {
        $response = null;
        try {
            $response = $this->ipbRequest->put($function, ['form_params' => $data])->getBody();
            return json_decode($response, false);
        } catch (ClientException $e) {
            $this->handleError($e->getResponse());
        }
    }

    /**
     * Perform a delete request.
     *
     * @param string $function The endpoint to perform a DELETE request on.
     *
     * @return mixed
     * @throws \Exception
     */
    private function deleteRequest($function)
    {
        $response = null;
        try {
            $response = $this->ipbRequest->delete($function)->getBody();
            return json_decode($response, false);
        } catch (ClientException $e) {
            $this->handleError($e->getResponse());
        }
    }

    /**
     * Throw the error specific to the error code that has been returned.
     *
     * All exceptions are dynamically thrown.  Where an exception doesn't exist for an error code, \Exception is thrown.
     *
     * @param ResponseInterface $response The IPBoard error code.
     *
     * @throws \Exception
     */
    private function handleError($response)
    {
        $error = json_decode($response->getBody(), false);
        $errorCode = $error->errorCode;

        try {
            if (array_key_exists($errorCode, $this->error_exceptions)) {
                throw new $this->error_exceptions[$errorCode];
            }

            throw new $this->error_exceptions[$response->getStatusCode()];
        } catch (Exception $e) {
            throw new \Exception('There was a malformed response from IPBoard.');
        }
    }

}

