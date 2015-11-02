<?php Namespace App\Library;

use Doctrine\CouchDB\CouchDBClient;
use Config;

class CouchDb extends CouchDBClient
{
    
    static public function init()
    {
        $couch = parent::create(
            array(
                'dbname' => Config::get('database.couch.default.database'), 
                'host' =>  Config::get('database.couch.default.host'), 
                'port' => (int)Config::get('database.couch.default.port')
            )
        );
        return $couch;
    }
    
    public function getAllRevisions($id,$info = false)
    {
        $revs = $info?'revs_info':'revs';
        $documentPath = '/' . $this->databaseName . '/' . urlencode($id)."?$revs=true";
        return $this->getHttpClient()->request( 'GET', $documentPath );
    }
    
    public function getDocRevisions($id,$rev)
    {
        $documentPath = '/' . $this->databaseName . '/' . urlencode($id)."?rev=$rev";
        return $this->getHttpClient()->request( 'GET', $documentPath );
    }
}
