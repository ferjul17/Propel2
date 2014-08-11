<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Propel\Tests\Generator\Manager;

use Propel\Generator\Config\GeneratorConfig;
use Propel\Generator\Manager\SqlManager;
use Propel\Tests\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @author Julien Ferrier <ferjul17@gmail.com>
 */
class SqlManagerTest extends TestCase
{

    /**
     * @return SqlManager
     */
    private function createSqlManager($identifierQuoting = true)
    {
        $fixturesDirectory = __DIR__ . '/../../../../Fixtures/sql-manager/';
        $generatorConfig = new GeneratorConfig($fixturesDirectory . '/identifier-quoting-' . ($identifierQuoting ? 'true' : 'false'));

        $connections = $generatorConfig->getBuildConnections();

        $sqlManager = new SqlManager();
        $sqlManager->setGeneratorConfig($generatorConfig);
        $sqlManager->setConnections($connections);
        $sqlManager->setSchemas($this->getSchemas($fixturesDirectory));
        $sqlManager->setWorkingDirectory($fixturesDirectory);

        return $sqlManager;
    }

    /**
     * @param $directory
     * @return array
     */
    private function getSchemas($directory)
    {
        $finder = new Finder();
        $finder
            ->name('*schema.xml')
            ->in($directory);
        $finder->depth(0);

        return iterator_to_array($finder->files());
    }

    public function testSqlManagerBuildSqlIdentifierQuoting()
    {
        $test = function($quote) {
            $sqlManager = $this->createSqlManager($quote);

            $sqlManager->buildSql();
            foreach ($sqlManager->getDatabases() as $database) {
                $platform = $database->getPlatform();
                if ($quote) {
                    $this->assertTrue($platform->getIdentifierQuoting());
                } else {
                    $this->assertFalse($platform->getIdentifierQuoting());
                }
            }
        };

        $test(true);
        $test(false);
    }

}
