<?php
/**
 * Data Definitions.
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2016-2019 w-vision AG (https://www.w-vision.ch)
 * @license    https://github.com/w-vision/DataDefinitions/blob/master/gpl-3.0.txt GNU General Public License version 3 (GPLv3)
 */

declare(strict_types=1);

namespace Wvision\Bundle\DataDefinitionsBundle\Model\ExportDefinition\Listing;

use Exception;
use Pimcore;
use Wvision\Bundle\DataDefinitionsBundle\Model\ExportDefinition;
use function count;

class Dao extends Pimcore\Model\Dao\PhpArrayTable
{
    /**
     * Configure
     */
    public function configure()
    {
        parent::configure();
        $this->setFile('exportdefinitions');
    }

    /**
     * Loads a list of Definitions for the specified parameters, returns an array of Definitions elements.
     *
     * @return array
     * @throws Exception
     */
    public function load()
    {
        $routesData = $this->db->fetchAll($this->model->getFilter(), $this->model->getOrder());

        $routes = array();
        foreach ($routesData as $routeData) {
            $routes[] = ExportDefinition::getById($routeData['id']);
        }

        $this->model->setObjects($routes);

        return $routes;
    }

    /**
     * Get total count
     *
     * @return int
     * @throws Exception
     */
    public function getTotalCount()
    {
        $data = $this->db->fetchAll($this->model->getFilter(), $this->model->getOrder());

        return count($data);
    }
}
