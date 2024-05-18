<?php

namespace LittleGreenMan\StytchPHP;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Authentication\BasicAuth;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class ClientBuilder
{

    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactoryInterface;
    private StreamFactoryInterface $streamFactoryInterface;

    private array $plugins = [];

    protected string $secret;
    protected string $project;
    protected string $publicToken;
    protected string $authUri = "/authentication";
    protected bool $testMode = false;


    public function __construct(
        string                  $secret,
        string                  $project,
        string                  $publicToken,
        string                  $authUri = "/authentication",
        bool                    $testMode = false,
        ClientInterface         $httpClient = null,
        RequestFactoryInterface $requestFactoryInterface = null,
        StreamFactoryInterface  $streamFactoryInterface = null
    )
    {
        $this->secret = $secret;
        $this->project = $project;
        $this->publicToken = $publicToken;
        $this->authUri = $authUri;
        $this->testMode = $testMode;
        $this->httpClient = $httpClient ?: Psr18ClientDiscovery::find();
        $this->requestFactoryInterface = $requestFactoryInterface ?: Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactoryInterface = $streamFactoryInterface ?: Psr17FactoryDiscovery::findStreamFactory();

        $this->addPlugin(new Plugin\HeaderDefaultsPlugin([
            'User-Agent' => 'little-green-man/stytch-php',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]));

        $this->addPlugin(new Plugin\AuthenticationPlugin(new BasicAuth($project, $secret)));

        $uriFactory = Psr17FactoryDiscovery::findUriFactory();

        $this->addPlugin(new Plugin\BaseUriPlugin($uriFactory->createUri($this->testMode ? 'https://test.stytch.com/v1/' : 'https://api.stytch.com/v1/')));
    }


    public function addPlugin(Plugin $plugin): void
    {
        $this->plugins[] = $plugin;
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        $pluginClient = (new PluginClientFactory())->createClient($this->httpClient, $this->plugins);

        return new HttpMethodsClient(
            $pluginClient,
            $this->requestFactoryInterface,
            $this->streamFactoryInterface
        );
    }

}
