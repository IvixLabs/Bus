<?php
namespace IvixLabs\Bus;


class Bus implements BusInterface
{
    /**
     * @var callable[]
     */
    private $registry = [];

    public function addHandler($requestClass, callable $requestHandler)
    {
        if (isset($this->registry[$requestClass])) {
            throw new \LogicException('Request handler for  ' . $requestClass . ' already registered');
        }

        $this->registry[$requestClass] = $requestHandler;
    }

    /**
     * @inheritdoc
     */
    public function execute($request = null)
    {
        $class = get_class($request);
        if (!isset($this->registry[$class])) {
            throw new \LogicException('Request handler not found for ' . $class);
        }

        $handler = $this->registry[$class];

        return $handler($request);
    }
}