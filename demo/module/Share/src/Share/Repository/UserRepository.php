<?php
//module/Share/src/Share/Repository/UserRepository.php
namespace Share\Repository;
 
use Doctrine\ORM\EntityRepository;
 
class UserRepository extends EntityRepository
{
    public function getUserLookup()
    {
        $querybuilder = $this->_em
                             ->getRepository($this->getEntityName())
                             ->createQueryBuilder('c');
        return $querybuilder->select('c')
                    ->orderBy('c.last_name', 'ASC')
                    ->getQuery()->getResult();
    }
}