<?

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Persisters\Collection\OneToManyPersister;

/**
 * 
 * @MongoDB\Document
 */
class Sampledata
{
    /** @MongoDB\Id*/
    private $id;
    

      /**
     * @MongoDB\Field(type="string")
     */
    private $name;

         /**
     * @MongoDB\Field(type="string")
     */
       private $detalle;
   
   public function setName($name):void{
        $this->name = $name;
    }
    public function setDetalle($detalle):void{
        $this->detalle = $detalle;
    }
}