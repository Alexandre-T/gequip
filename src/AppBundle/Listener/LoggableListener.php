<?php

namespace AppBundle\Listener;

use \Gedmo\Loggable\LoggableListener as GedmoLoggableListener;

/**
 * LoggableListener
 *
 * @author Alexandre Tranchant <alexandre.tranchant@gmail.com>
 */
class LoggableListener extends GedmoLoggableListener implements LoggableListenerInterface
{
}
