<?php

/**
 * This file is part of the AppleApnPush package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Apple\ApnPush\Exceptions;

/**
 * Connection not found exception
 */
class ConnectionUndefinedException extends ApnPushException
{
    /**
     * Construct
     */
    public function __construct($message = 'Connection not found.', $code = 0, \Exception $prev = NULL)
    {
        parent::__construct($message, $code, $prev);
    }
}