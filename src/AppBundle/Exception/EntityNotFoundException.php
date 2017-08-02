<?php
/**
 * This file is part of the G-Equip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Repository
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */


namespace AppBundle\Exception;

use Throwable;

/**
 * Entity Not Found Exception.
 *
 * When an entity, called as example by ID, is not found,
 * this exception is thrown.
 *
 * @category Exception
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class EntityNotFoundException extends AppException
{
    /**
     * EntityNotFoundException constructor.
     *
     * If message is empty, then its initialized.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $message = "Entity not found.";
        }
        parent::__construct($message, $code, $previous);
    }
}
