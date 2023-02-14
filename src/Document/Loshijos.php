<?

namespace App\Document;
 
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB; 

/**
 * 
 * @MongoDB\Document(collection="Hijos")
 */
class Loshijos
{
    /** @MongoDB\Id*/
    private $id;
     
      /**
     * @MongoDB\Field(type="string")
     */
    private $name;
 
    /** @MongoDB\ReferenceOne(targetDocument=Padre::class, inversedBy="hijos") */
    public $padre;
   
   public function setName($name):void{
        $this->name = $name;
    }
    public function getName():string{
       return $this->name;
    }
    public function setPadre($padre):void{
        $this->padre = $padre;
     }
    public function getPadre():Padre{
        return $this->padre;
     }
   
}