<?php
/**
 * This file is part of phpUnderControl.
 * 
 * PHP Version 5
 *
 * Copyright (c) 2007-2008, Manuel Pichler <mapi@phpundercontrol.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 * 
 * @category  QualityAssurance
 * @package   Commands
 * @author    Manuel Pichler <mapi@phpundercontrol.org>
 * @copyright 2007-2008 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$
 * @link      http://www.phpundercontrol.org/
 */

/**
 * Command implementation for the install mode.
 *
 * @category  QualityAssurance
 * @package   Commands
 * @author    Manuel Pichler <mapi@phpundercontrol.org>
 * @copyright 2007-2008 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://www.phpundercontrol.org/
 */
class phpucInstallCommand extends phpucAbstractCommand
{
    /**
     * List of new files.
     *
     * @type array<string>
     * @var array(string=>string) $installFiles
     */
    private $installFiles = array(
        '/webapps/cruisecontrol/dashboard.jsp',
        '/webapps/cruisecontrol/favicon.ico',
        '/webapps/cruisecontrol/footer.jsp',
        '/webapps/cruisecontrol/header.jsp',
        '/webapps/cruisecontrol/metrics.cewolf.jsp',
        '/webapps/cruisecontrol/phpcs.jsp',
        '/webapps/cruisecontrol/phpunit.jsp',
        '/webapps/cruisecontrol/phpunit-pmd.jsp',
        '/webapps/cruisecontrol/servertime.jsp',
        '/webapps/cruisecontrol/css/php-under-control.css',
        '/webapps/cruisecontrol/css/SyntaxHighlighter.css',
        '/webapps/cruisecontrol/images/php-under-control/dashboard-broken-left.png',
        '/webapps/cruisecontrol/images/php-under-control/dashboard-broken-right.png',
        '/webapps/cruisecontrol/images/php-under-control/dashboard-good-left.png',
        '/webapps/cruisecontrol/images/php-under-control/dashboard-good-right.png',
        '/webapps/cruisecontrol/images/php-under-control/error.png',
        '/webapps/cruisecontrol/images/php-under-control/failed.png',
        '/webapps/cruisecontrol/images/php-under-control/header-center.png',
        '/webapps/cruisecontrol/images/php-under-control/header-left-logo.png',
        '/webapps/cruisecontrol/images/php-under-control/play-broken.png',
        '/webapps/cruisecontrol/images/php-under-control/play-good.png',
        '/webapps/cruisecontrol/images/php-under-control/info.png',
        '/webapps/cruisecontrol/images/php-under-control/skipped.png',
        '/webapps/cruisecontrol/images/php-under-control/success.png',
        '/webapps/cruisecontrol/images/php-under-control/tab-active.png',
        '/webapps/cruisecontrol/images/php-under-control/tab-inactive.png',
        '/webapps/cruisecontrol/images/php-under-control/throbber-broken.gif',
        '/webapps/cruisecontrol/images/php-under-control/throbber-good.gif',
        '/webapps/cruisecontrol/images/php-under-control/warning.png',
        '/webapps/cruisecontrol/js/shBrushPhp.js',
        '/webapps/cruisecontrol/js/shCore.js',
        '/webapps/cruisecontrol/js/effects.js',
        '/webapps/cruisecontrol/js/prototype.js',
        '/webapps/cruisecontrol/js/scriptaculous.js',
        '/webapps/cruisecontrol/xsl/phpcs.xsl',
        '/webapps/cruisecontrol/xsl/phpcs-details.xsl',
        '/webapps/cruisecontrol/xsl/phpdoc.xsl',
        '/webapps/cruisecontrol/xsl/phphelper.xsl',
        '/webapps/cruisecontrol/xsl/phpunit.xsl',
        '/webapps/cruisecontrol/xsl/phpunit-details.xsl',
        '/webapps/cruisecontrol/xsl/phpunit-pmd.xsl',
        '/webapps/cruisecontrol/xsl/phpunit-pmd-details.xsl',
    );
    
    /**
     * List of modified files.
     *
     * @type array<string>
     * @var array(string=>string) $modifiedFiles
     */
    private $modifiedFiles = array(
        '/webapps/cruisecontrol/index.jsp',
        '/webapps/cruisecontrol/main.jsp',
        '/webapps/cruisecontrol/metrics.jsp',
        '/webapps/cruisecontrol/xsl/buildresults.xsl',
        '/webapps/cruisecontrol/xsl/errors.xsl',
        '/webapps/cruisecontrol/xsl/header.xsl',
        '/webapps/cruisecontrol/xsl/modifications.xsl',
    );
    
    /**
     * Creates all command specific {@link phpucTaskI} objects.
     * 
     * @return array(phpucTaskI)
     */
    protected function doCreateTasks()
    {
        $tasks = array();
        
        $tasks[] = new phpucCruiseControlTask( $this->args );
        $tasks[] = new phpucModifyFileTask( $this->args, $this->modifiedFiles );
        $tasks[] = new phpucCreateFileTask( $this->args, $this->installFiles );
        
        return $tasks;
    }
}