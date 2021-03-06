<?php

/*
 * This file is part of the Automate package.
 *
 * (c) Julien Jacottet <jjacottet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Automate;

use Automate\Model\Server;
use phpseclib\Net\SSH2;

class SessionFactory
{
    /**
     * Create SSH session.
     *
     * @param Server $server
     *
     * @return Session
     *
     * @throws \Exception
     */
    public function create(Server $server)
    {
        $ssh = new SSH2($server->getHost(), $server->getPort());

        if (!$ssh->login($server->getUser(), $server->getPassword())) {
            throw new \Exception(sprintf('[%s] Invalid user or password', $server->getName()));
        }

        return new Session($ssh);
    }
}
