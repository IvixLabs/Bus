<?php
namespace IvixLabs\Bus;

interface BusInterface
{
    /**
     * @param object|null $request
     * @return object|void
     */
    public function execute($request);
}