<?php

namespace App\Event;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventManager;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LoguinEvents
{
    const LogueIn = 'LogueIn';
    const loguedOut = 'loguedOut';

    private $_evm;

   

    private $cookieTime;

    private $cookieName;

    public function __construct(EventManager $evm)
    {
        $this->cookieTime = $_ENV['TIME_ACTIVE_COOKIE'];
        $this->cookieName = $_ENV['SECRETNAME_KOOKIE'];
        $evm->addEventListener([self::LogueIn, self::loguedOut], $this);
    }

    public function LogueIn(EventArgs $e): void
    {
       
        $response = new Response();
        $keepLoguedUser = new Cookie($this->cookieName , true, time() + $this->cookieTime);
        $response->headers->setCookie($keepLoguedUser);
        $response->sendHeaders();

    }

    public function loguedOut(EventArgs $e): void
    {
            $response = new Response();
           $response->headers->clearCookie($this->cookieName);
           $response->sendHeaders();
        
    }
}
