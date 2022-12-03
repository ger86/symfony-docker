<?php

namespace App\Event;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventManager;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LoguinEvents
{
    const LogueIn = 'LogueIn';
    const logueOut = 'logueOut';

    private $_evm;


    public function __construct(EventManager $evm)
    {
        $evm->addEventListener([self::LogueIn, self::logueOut], $this);
    }

    public function LogueIn(EventArgs $e): void
    {
       
        $cookieName = $_ENV['SECRETNAME_KOOKIE'];
        $cookieTime = $_ENV['TIME_ACTIVE_COOKIE'];
        $response = new Response();
        $keepLoguedUser = new Cookie($cookieName , true, time() + $cookieTime);
        $response->headers->setCookie($keepLoguedUser);
        $response->sendHeaders();

    }

    public function logueOut(EventArgs $e): void
    {
        echo 'You was loged out, good bay...';
    }
}
