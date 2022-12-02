<?php

namespace App\Event;

use Doctrine\Common\EventArgs;
use Doctrine\Common\EventManager;

class LoguinEvents
{
    const LogueIn = 'LogueIn';
    const logueOut = 'logueOut';

    private $_evm;

    // public $preFooInvoked = false;
    // public $postFooInvoked = false;

    public function __construct(EventManager $evm)
    {
        $evm->addEventListener([self::LogueIn, self::logueOut], $this);
    }

    public function LogueIn(EventArgs $e): void 
    {
        echo 'wellcome to home sr...';
    }

    public function logueOut(EventArgs $e): void
    {
       echo 'You was loged out, good bay...';
    }
}
 