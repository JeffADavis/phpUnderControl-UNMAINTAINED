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
 * @category  QualityAssurance
 * @package   phpUnderControl
 * @author    Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright 2007-2008 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$
 * @link      http://www.phpundercontrol.org/
 */

if ( strpos( '@php_dir@', '@php_dir' ) === false )
{
    define( 'PHPUC_DATA_DIR',    '@data_dir@/phpUnderControl' );
    define( 'PHPUC_INSTALL_DIR', '@php_dir@/phpUnderControl' );
    define( 'PHPUC_EZC_BASE',    '@php_dir@/ezc/Base/base.php' );
}
else
{
    define( 'PHPUC_INSTALL_DIR', dirname( __FILE__ ) );
    define( 'PHPUC_DATA_DIR',    realpath( PHPUC_INSTALL_DIR . '/..' ) );
    define( 'PHPUC_EZC_BASE',    PHPUC_DATA_DIR . '/lib/ezc/Base/src/base.php' );
}

/**
 * Main installer class.
 *
 * @category  QualityAssurance
 * @package   phpUnderControl
 * @author    Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright 2007-2008 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://www.phpundercontrol.org/
 */
class phpucPhpUnderControl
{
    /**
     * Class to file mapping.
     *
     * @type array<string> 
     * @var array(string=>string) $autoloadFiles
     */
    private static $autoloadFiles = array(
        'phpucAbstractCommand'              =>  'Commands/AbstractCommand.php',
        'phpucExampleCommand'               =>  'Commands/ExampleCommand.php',
        'phpucGraphCommand'                 =>  'Commands/GraphCommand.php',
        'phpucInstallCommand'               =>  'Commands/InstallCommand.php',
        'phpucProjectCommand'               =>  'Commands/ProjectCommand.php',
        'phpucConsoleArgs'                  =>  'Console/ConsoleArgs.php',
        'phpucConsoleExtensionI'            =>  'Console/ConsoleExtensionI.php',
        'phpucConsoleInput'                 =>  'Console/ConsoleInput.php',
        'phpucConsoleInputDefinition'       =>  'Console/ConsoleInputDefinition.php',
        'phpucConsoleOutput'                =>  'Console/ConsoleOutput.php',
        'phpucBuildFile'                    =>  'Data/BuildFile.php',
        'phpucBuildTarget'                  =>  'Data/BuildTarget.php',
        'phpucConfigArtifactsPublisher'     =>  'Data/ConfigArtifactsPublisher.php',
        'phpucConfigFile'                   =>  'Data/ConfigFile.php',
        'phpucConfigProject'                =>  'Data/ConfigProject.php',
        'phpucLogFile'                      =>  'Data/LogFile.php',
        'phpucLogFileIterator'              =>  'Data/LogFileIterator.php',
        'phpucConsoleException'             =>  'Exceptions/ConsoleException.php',
        'phpucErrorException'               =>  'Exceptions/ErrorException.php',
        'phpucExecuteException'             =>  'Exceptions/ExecuteException.php',
        'phpucValidateException'            =>  'Exceptions/ValidateException.php',
        'phpucAbstractInput'                =>  'Graph/Input/AbstractInput.php',
        'phpucBuildBreakdownInput'          =>  'Graph/Input/BuildBreakdownInput.php',
        'phpucBuildBreakdownTimelineInput'  =>  'Graph/Input/BuildBreakdownTimelineInput.php',
        'phpucCodeViolationInput'           =>  'Graph/Input/CodeViolationInput.php',
        'phpucInputI'                       =>  'Graph/Input/InputI.php',
        'phpucInputIterator'                =>  'Graph/Input/InputIterator.php',
        'phpucInputLoader'                  =>  'Graph/Input/InputLoader.php',
        'phpucInputRule'                    =>  'Graph/Input/InputRule.php',
        'phpucTestCodeRatioInput'           =>  'Graph/Input/TestCodeRatioInput.php',
        'phpucUnitCoverageInput'            =>  'Graph/Input/UnitCoverageInput.php',
        'phpucUnitTestInput'                =>  'Graph/Input/UnitTestInput.php',
        'phpucChartFactory'                 =>  'Graph/ChartFactory.php',
        'phpucChartI'                       =>  'Graph/ChartI.php',
        'phpucDotChart'                     =>  'Graph/DotChart.php',
        'phpucGraphPalette'                 =>  'Graph/GraphPalette.php',
        'phpucLineChart'                    =>  'Graph/LineChart.php',
        'phpucPieChart'                     =>  'Graph/PieChart.php',
        'phpucAbstractPearTask'             =>  'Tasks/AbstractPearTask.php',
        'phpucAbstractTask'                 =>  'Tasks/AbstractTask.php',
        'phpucCreateFileTask'               =>  'Tasks/CreateFileTask.php',
        'phpucCruiseControlTask'            =>  'Tasks/CruiseControlTask.php',
        'phpucExampleTask'                  =>  'Tasks/ExampleTask.php',
        'phpucGenerateGraphTask'            =>  'Tasks/GenerateGraphTask.php',
        'phpucModifyFileTask'               =>  'Tasks/ModifyFileTask.php',
        'phpucPhpCodeSnifferTask'           =>  'Tasks/PhpCodeSnifferTask.php',
        'phpucPhpDocumentorTask'            =>  'Tasks/PhpDocumentorTask.php',
        'phpucPhpUnitTask'                  =>  'Tasks/PhpUnitTask.php',
        'phpucProjectTask'                  =>  'Tasks/ProjectTask.php',
        'phpucTaskI'                        =>  'Tasks/TaskI.php',
        'phpucFileUtil'                     =>  'Util/FileUtil.php',
        'phpucPhpUnderControl'              =>  'PhpUnderControl.php',
    );
    
    /**
     * Autoload function.
     *
     * @param string $className Unresolved class name.
     * 
     * @return void
     */
    public static function autoload( $className )
    {
        if ( isset( self::$autoloadFiles[$className] ) )
        {
            $fileName = sprintf(
                '%s/%s', PHPUC_INSTALL_DIR, self::$autoloadFiles[$className]
            );
        
            include $fileName;
        }
    }
    
    /**
     * Main method for phpUnderControl
     *
     * @return void
     */
    public static function main()
    {
        spl_autoload_register( array( 'phpucPhpUnderControl', 'autoload' ) );
        
        if ( file_exists( PHPUC_EZC_BASE ) )
        {
            include_once PHPUC_EZC_BASE;

            spl_autoload_register( array( 'ezcBase', 'autoload' ) );
        }
        
        $phpUnderControl = new phpucPhpUnderControl();
        $phpUnderControl->run();
    }
    
    /**
     * The used console input object.
     *
     * @type phpucConsoleInput
     * @var phpucConsoleInput $input
     */
    private $input = null;
    
    /**
     * List with all tasks.
     *
     * @type array<phpucTaskI>
     * @var array(phpucTaskI) $tasks
     */
    private $tasks = array();
    
    /**
     * The ctor creates the required console arg instance.
     */
    public function __construct()
    {
        $this->input = new phpucConsoleInput();
    }
    
    /**
     * Performs a single cli request.
     *
     * @return void
     */
    public function run()
    {
        try
        {
            if ( $this->input->parse() )
            {
                phpucConsoleOutput::set( new phpucConsoleOutput() );
                
                $command = phpucAbstractCommand::createCommand( $this->input->args );
        
                $command->validate();
                $command->execute();
            }
            exit( 0 );
        }
        catch ( phpucConsoleException $e )
        {
            echo $e->getMessage() . PHP_EOL;
            exit( 1 );
        }
        catch ( phpucExecuteException $e )
        {
            echo $e->getMessage() . PHP_EOL;
            exit( 2 );
        }
        catch ( phpucValidateException $e )
        {
            echo $e->getMessage() . PHP_EOL;
            exit( 3 );
        }
        catch ( Exception $e )
        {
            echo $e->getMessage() . PHP_EOL;
            exit( 4 );
        }
    }
}