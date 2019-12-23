<?php 

namespace App\Repository;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

abstract class QuotesRepository {    

    private $cache;
    private const EXPIRATION_TIME = 100;

    public function __construct(){
        $this->cache = new FilesystemAdapter();
    }

    public function get($author, $limit){        
        $item = $this->cache->getItem('quote_'. $author . '_' . $limit);        

        if (!$item->isHit()){
            $item->set($this->getQuotesFrom($author, $limit));
            $item->expiresAfter(self::EXPIRATION_TIME);
            $this->cache->save($item);
        }
        return $item->get();
    }

    abstract public function getQuotesFrom($author, $limit);
}