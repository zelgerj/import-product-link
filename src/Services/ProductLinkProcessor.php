<?php

/**
 * TechDivision\Import\Product\Link\Services\ProductLinkProcessor
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-link
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Link\Services;

/**
 * A SLSB providing methods to load product data using a PDO connection.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-link
 * @link      http://www.techdivision.com
 */
class ProductLinkProcessor implements ProductLinkProcessorInterface
{

    /**
     * A PDO connection initialized with the values from the Doctrine EntityManager.
     *
     * @var \PDO
     */
    protected $connection;

    /**
     * The repository to load product links.
     *
     * @var \TechDivision\Import\Product\Link\Repositories\\ProductLinkRepository
     */
    protected $productLinkRepository;

    /**
     * The repository to load product link attribute integer attributes.
     *
     * @var \TechDivision\Import\Product\Link\Repositories\\ProductLinkAttributeIntRepository
     */
    protected $productLinkAttributeIntRepository;

    /**
     * The action with the product link CRUD methods.
     *
     * @var \TechDivision\Import\Product\Link\Actions\ProductLinkAction
     */
    protected $productLinkAction;

    /**
     * The action with the product link attribute CRUD methods.
     *
     * @var \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeAction
     */
    protected $productLinkAttributeAction;

    /**
     * The action with the product link attribute decimal CRUD methods.
     *
     * @var \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeDecimalAction
     */
    protected $productLinkAttributeDecimalAction;

    /**
     * The action with the product link attribute integer CRUD methods.
     *
     * @var \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeIntAction
     */
    protected $productLinkAttributeIntAction;

    /**
     * The action with the product link attribute varchar CRUD methods.
     *
     * @var \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeVarcharAction
     */
    protected $productLinkAttributeVarcharAction;

    /**
     * Set's the passed connection.
     *
     * @param \PDO $connection The connection to set
     *
     * @return void
     */
    public function setConnection(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Return's the connection.
     *
     * @return \PDO The connection instance
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Turns off autocommit mode. While autocommit mode is turned off, changes made to the database via the PDO
     * object instance are not committed until you end the transaction by calling ProductProcessor::commit().
     * Calling ProductProcessor::rollBack() will roll back all changes to the database and return the connection
     * to autocommit mode.
     *
     * @return boolean Returns TRUE on success or FALSE on failure
     * @link http://php.net/manual/en/pdo.begintransaction.php
     */
    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    /**
     * Commits a transaction, returning the database connection to autocommit mode until the next call to
     * ProductProcessor::beginTransaction() starts a new transaction.
     *
     * @return boolean Returns TRUE on success or FALSE on failure
     * @link http://php.net/manual/en/pdo.commit.php
     */
    public function commit()
    {
        return $this->connection->commit();
    }

    /**
     * Rolls back the current transaction, as initiated by ProductProcessor::beginTransaction().
     *
     * If the database was set to autocommit mode, this function will restore autocommit mode after it has
     * rolled back the transaction.
     *
     * Some databases, including MySQL, automatically issue an implicit COMMIT when a database definition
     * language (DDL) statement such as DROP TABLE or CREATE TABLE is issued within a transaction. The implicit
     * COMMIT will prevent you from rolling back any other changes within the transaction boundary.
     *
     * @return boolean Returns TRUE on success or FALSE on failure
     * @link http://php.net/manual/en/pdo.rollback.php
     */
    public function rollBack()
    {
        return $this->connection->rollBack();
    }

    /**
     * Set's the repository to load product links.
     *
     * @param \TechDivision\Import\Product\Link\Repositories\ProductLinkRepository $productLinkRepository The repository instance
     *
     * @return void
     */
    public function setProductLinkRepository($productLinkRepository)
    {
        $this->productLinkRepository = $productLinkRepository;
    }

    /**
     * Return's the repository to load product links.
     *
     * @return \TechDivision\Import\Product\Link\Repositories\ProductLinkRepository The repository instance
     */
    public function getProductLinkRepository()
    {
        return $this->productLinkRepository;
    }

    /**
     * Set's the repository to load product link attribute integer attributes.
     *
     * @param \TechDivision\Import\Product\Link\Repositories\ProductLinkAttributeIntRepository $productLinkAttributeIntRepository The repository instance
     *
     * @return void
     */
    public function setProductLinkAttributeIntRepository($productLinkAttributeIntRepository)
    {
        $this->productLinkAttributeIntRepository = $productLinkAttributeIntRepository;
    }

    /**
     * Return's the repository to load product link attribute integer attributes.
     *
     * @return \TechDivision\Import\Product\Link\Repositories\ProductLinkAttributeIntRepository The repository instance
     */
    public function getProductLinkAttributeIntRepository()
    {
        return $this->productLinkAttributeIntRepository;
    }

    /**
     * Set's the action with the product link CRUD methods.
     *
     * @param \TechDivision\Import\Product\Link\Actions\ProductLinkAction $productLinkAction The action with the product link CRUD methods
     *
     * @return void
     */
    public function setProductLinkAction($productLinkAction)
    {
        $this->productLinkAction = $productLinkAction;
    }

    /**
     * Return's the action with the product link CRUD methods.
     *
     * @return \TechDivision\Import\Product\Link\Actions\ProductLinkGalleryAction The action with the product link CRUD methods
     */
    public function getProductLinkAction()
    {
        return $this->productLinkAction;
    }

    /**
     * Set's the action with the product link attribute CRUD methods.
     *
     * @param \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeAction $productLinkAttributeAction The action with the product link attribute CRUD methods
     *
     * @return void
     */
    public function setProductLinkAttributeAction($productLinkAttributeAction)
    {
        $this->productLinkAttributeAction = $productLinkAttributeAction;
    }

    /**
     * Return's the action with the product link attribute CRUD methods.
     *
     * @return \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeAction The action with the product link attribute CRUD methods
     */
    public function getProductLinkAttributeAction()
    {
        return $this->productLinkAttributeAction;
    }

    /**
     * Set's the action with the product link attribute decimal CRUD methods.
     *
     * @param \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeDecimalAction $productLinkAttributeDecimalAction The action with the product link attribute decimal CRUD methods
     *
     * @return void
     */
    public function setProductLinkAttributeDecimalAction($productLinkAttributeDecimalAction)
    {
        $this->productLinkAttributeDecimalAction = $productLinkAttributeDecimalAction;
    }

    /**
     * Return's the action with the product link attribute decimal CRUD methods.
     *
     * @return \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeDecimalAction The action with the product link attribute decimal CRUD methods
     */
    public function getProductLinkAttributeDecimalAction()
    {
        return $this->productLinkAttributeDecimalAction;
    }

    /**
     * Set's the action with the product link attribute integer CRUD methods.
     *
     * @param \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeIntAction $productLinkAttributeIntAction The action with the product link attribute integer CRUD methods
     *
     * @return void
     */
    public function setProductLinkAttributeIntAction($productLinkAttributeIntAction)
    {
        $this->productLinkAttributeIntAction = $productLinkAttributeIntAction;
    }

    /**
     * Return's the action with the product link attribute integer CRUD methods.
     *
     * @return \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeIntAction The action with the product link attribute integer CRUD methods
     */
    public function getProductLinkAttributeIntAction()
    {
        return $this->productLinkAttributeIntAction;
    }

    /**
     * Set's the action with the product link attribute varchar CRUD methods.
     *
     * @param \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeVarcharAction $productLinkAttributeVarcharAction The action with the product link attribute varchar CRUD methods
     *
     * @return void
     */
    public function setProductLinkAttributeVarcharAction($productLinkAttributeVarcharAction)
    {
        $this->productLinkAttributeVarcharAction = $productLinkAttributeVarcharAction;
    }

    /**
     * Return's the action with the product link attribute varchar CRUD methods.
     *
     * @return \TechDivision\Import\Product\Link\Actions\ProductLinkAttributeVarcharAction The action with the product link attribute varchar CRUD methods
     */
    public function getProductLinkAttributeVarcharAction()
    {
        return $this->productLinkAttributeVarcharAction;
    }

    /**
     * Load's the link with the passed product/linked product/link type ID.
     *
     * @param integer $productId       The product ID of the link to load
     * @param integer $linkedProductId The linked product ID of the link to load
     * @param integer $linkTypeId      The link type ID of the product to load
     *
     * @return array The link
     */
    public function loadProductLink($productId, $linkedProductId, $linkTypeId)
    {
        return $this->getProductLinkRepository()->findOneByProductIdAndLinkedProductIdAndLinkTypeId($productId, $linkedProductId, $linkTypeId);
    }

    /**
     * Return's the product link attribute integer value with the passed product link attribute/link ID.
     *
     * @param integer $productLinkAttributeId The product link attribute ID of the attributes
     * @param integer $linkId                 The link ID of the attribute
     *
     * @return array The product link attribute integer value
     */
    public function loadProductLinkAttributeInt($productLinkAttributeId, $linkId)
    {
        return $this->getProductLinkAttributeIntRepository()->findOneByProductLinkAttributeIdAndLinkId($productLinkAttributeId, $linkId);
    }

    /**
     * Persist's the passed product link data and return's the ID.
     *
     * @param array $productLink The product link data to persist
     *
     * @return string The ID of the persisted entity
     */
    public function persistProductLink($productLink)
    {
        return $this->getProductLinkAction()->persist($productLink);
    }

    /**
     * Persist's the passed product link attribute data and return's the ID.
     *
     * @param array $productLinkAttribute The product link attribute data to persist
     *
     * @return string The ID of the persisted entity
     */
    public function persistProductLinkAttribute($productLinkAttribute)
    {
        return $this->getProductLinkAttributeAction()->persist($productLinkAttribute);
    }

    /**
     * Persist's the passed product link attribute decimal data.
     *
     * @param array $productLinkAttributeDecimal The product link attribute decimal data to persist
     *
     * @return void
     */
    public function persistProductLinkAttributeDecimal($productLinkAttributeDecimal)
    {
        $this->getProductLinkAttributeDecimalAction()->persist($productLinkAttributeDecimal);
    }

    /**
     * Persist's the passed product link attribute integer data.
     *
     * @param array $productLinkAttributeInt The product link attribute integer data to persist
     *
     * @return string The ID of the persisted entity
     */
    public function persistProductLinkAttributeInt($productLinkAttributeInt)
    {
        $this->getProductLinkAttributeIntAction()->persist($productLinkAttributeInt);
    }

    /**
     * Persist's the passed product link attribute varchar data.
     *
     * @param array $productLinkAttributeVarchar The product link attribute varchar data to persist
     *
     * @return string The ID of the persisted entity
     */
    public function persistProductLinkAttributeVarchar($productLinkAttributeVarchar)
    {
        $this->getProductLinkAttributeVarcharAction()->persist($productLinkAttributeVarchar);
    }
}
