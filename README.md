# doctrine-odm-specification-lib
Wrapper around doctrine odm that allows to use ddd specifications.

Inspired by - https://github.com/igdr/doctrine-specification


## Install

```bash
$ composer require vklymniuk/doctrine-odm-specification-lib
```


Edit your doctrine settings
```yaml
doctrine_mongodb:    
    document_managers:
        default:
            auto_mapping: true
            default_document_repository_class: Doctrine\ODM\MongoDB\Specification\DocumentSpecificationRepository
```

Configure your pagination limit

```yaml
parameters:
  api_pagination_limit: "%env(APP__PAGINATION_LIMIT)%"
```

```php
<?php

use Doctrine\ODM\MongoDB\Specification\DocumentSpecificationRepositoryInterface;
use Doctrine\ODM\MongoDB\Specification\Manager\AbstractManager;

/**
 * Class MyDocumentManager
 */
class MyDocumentManager extends AbstractManager
{
    public function save(MyDocument $document): MyDocument
    {
        $this->dm->persist($document);
        $this->dm->flush();

        return $document;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(): string
    {
        return MyDocument::class;
    }

    /**
     * @return DocumentSpecificationRepositoryInterface
     */
    protected function getRepository(): DocumentSpecificationRepositoryInterface
    {
        return $this->dm->getRepository($this->supports());
    }
}

```

```php

<?php

namespace App\Specification;

use Doctrine\ODM\MongoDB\Specification\Specification;

/**
 * Class MyDocumentSpecification
 */
class MyDocumentSpecification extends Specification
{
    /**
     * @param string $id
     *
     * @return MyDocumentSpecification
     */
    public function setId(string $id): self
    {
        $this->andWhere(self::expr()->equals('id', $id));

        return $this;
    }

    /**
     * @param bool $public
     *
     * @return MyDocumentSpecification
     */
    public function onlyPublic(bool $public): self
    {
        $this->andWhere(self::expr()->equals('public', $public));

        return $this;
    }
    
    /**
     * @param string $userId
     *
     * @return MyDocumentSpecification
     */
    public function applyUserId(string $userId): self
    {
        $this->andWhere(self::expr()->equals('userId', $userId));

        return $this;
    }

    /**
     * @param string      $userId
     * @param null|string $profileId
     * @param null|string $map
     *
     * @return $this
     */
    public function someComplexitySearch(
        string $userId,
        ?string $map = null,
        ?string $profileId = null
    ): self {

        $orExpr = [];
        $orExpr[] = self::expr()->equals('userId', $userId);

        if (null !== $profileId) {
            $orExpr[] = self::expr()->in('search.profiles', [$profileId]);
        }

        if (null !== $map) {
            $this->andWhere(self::expr()->equals('search.map', $map));
        }

        $this->andWhere(\call_user_func_array([self::expr(), 'orX'], $orExpr));

        return $this;
    }
}

```

```php
<?php

    $spec = (new MyDocumentSpecification())
        ->someComplexitySearch($userId, $map, $profileId)
        ->limit($paginator->getLimit())
        ->offset($paginator->getOffset());


$this->manager->find($spec); // returns - LazySpecificationCollection
```