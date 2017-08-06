<?php

namespace AppBundle\Listener;

/**
 * LoggableListener
 *
 * @author Alexandre Tranchant <alexandre.tranchant@gmail.com>
 */
interface LoggableListenerInterface
{
    public function setUsername($username);
}
