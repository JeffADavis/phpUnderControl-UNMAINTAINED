<?php
/**
 * This file is part of phpUnderControl.
 * 
 * PHP Version 5.2.4
 *
 * Copyright (c) 2007-2008, Manuel Pichler <mapi@manuel-pichler.de>.
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
 * @category   QualityAssurance
 * @package    Graph
 * @subpackage Input
 * @author     Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright  2007-2008 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://www.phpundercontrol.org/
 */

/**
 * This class implements the graph input for the unit coverage metric view.
 *
 * @category   QualityAssurance
 * @package    Graph
 * @subpackage Input
 * @author     Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright  2007-2008 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpundercontrol.org/
 */
class phpucUnitCoverageInput extends phpucAbstractInput
{
    /**
     * Constructs a new unit coverage input object.
     */
    public function __construct()
    {
        parent::__construct( 
            'Unit coverage', 
            '03-unit-coverage', 
            phpucChartI::TYPE_LINE
        );
        
        $this->yAxisLabel = 'Lines';
        $this->xAxisLabel = 'Build ';
        
        $this->addRule(
            new phpucInputRule(
                'Lines of code',
                '/cruisecontrol/coverage/project/file/metrics/@loc',
                self::MODE_SUM
            )
        );
        $this->addRule(
            new phpucInputRule(
                'Non comment lines',
                '/cruisecontrol/coverage/project/file/metrics/@ncloc',
                self::MODE_SUM
            )
        );
        $this->addRule(
            new phpucInputRule(
                'Executable',
                '/cruisecontrol/coverage/project/file/line',
                self::MODE_COUNT
            )
        );
        $this->addRule(
            new phpucInputRule(
                'Covered',
                '/cruisecontrol/coverage/project/file/line[@count != 0]',
                self::MODE_COUNT
            )
        );
    }
}