<?

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB; 
use App\Document\Loshijos;
use Doctrine\ODM\MongoDB\PersistentCollection;

/**
 * 
 * @MongoDB\Document(collection="Padre")
 */
class Padre
{
    /** @MongoDB\Id*/
    private $id;
    

      /**
     * @MongoDB\Field(type="string")
     */
    private $name;

         /**
     * @MongoDB\Field(type="int")
     */
    private $edad;

    /** @MongoDB\ReferenceMany(targetDocument=Loshijos::class, mappedBy="padre") */
    private $hijos;

    public function getId()
    {
       return $this->id;
    }
   
   public function setName($name):void{ 
        $this->name = $name;
    }
    public function getName():string{
       return $this->name;
    }
    public function setEdad($edad):void{
        $this->edad = $edad;
    }
    public function getEdad():int{
       return $this->edad;
    }
    public function getHijos():PersistentCollection{
        return $this->hijos;
     }
}