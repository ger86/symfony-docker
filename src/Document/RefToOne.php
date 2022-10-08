<?

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use App\Document\Sampledata;

/**
 * 
 * @MongoDB\Document(collection="refOne")
 */
class RefToOne 
{
    /** @MongoDB\Id*/
    private $id;

    /** @MongoDB\ReferenceOne(targetDocument=Sampledata::class, orphanRemoval=true, storeAs="dbRefWithDb") */
    private $insertData;

     /** @MongoDB\Field(type="string") */
     private $undato;

    // public function __construct()
    // {
    //     $this->insertData = new ArrayCollection();
    // } 
   
   public function setInsertdata(Sampledata $data):void{
        $this->insertData = $data; 
    }
    public function setUndato($dato):void{
        $this->undato = $dato; 
    }

}