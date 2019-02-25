<?php

namespace DS\Broadlink;

use DS\Broadlink\Command\AuthenticateCommand;
use DS\Broadlink\Command\DiscoverCommand;
use DS\Broadlink\Device\AuthenticatedDevice;
use DS\Broadlink\Device\DeviceInterface;

class Broadlink
{
    public static function discover(): array
    {
        $protocol = Protocol::create();
        $discoverCommand = new DiscoverCommand();
        $devices = [];

        foreach($protocol->executeCommand($discoverCommand) as $device){
            $devices[] = $device;
        }

        return $devices;
    }

    public static function authenticate(
        DeviceInterface $device,
        $authenticatedClass = AuthenticatedDevice::class
    ): AuthenticatedDevice
    {
        $protocol = Protocol::create();
        $discoverCommand = new AuthenticateCommand($device,$authenticatedClass);

        return $protocol->executeCommand($discoverCommand)->current();
    }
}