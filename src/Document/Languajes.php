<?

namespace App\Document;
 
use App\Document\Category;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;

/**
 * 
 * @MongoDB\Document(collection="Languajes")
 */
class Languajes
{
    /** @MongoDB\Id*/
    private $id;
     
      /**
     * @MongoDB\Field(type="string")
     */
    private $languaje;
 
   // * for map the variable that contain all categories use mappedBy
    /** @MongoDB\ReferenceMany(targetDocument=Post::class, mappedBy="languaje") */
      public $post;

    
    public function getId():int{
        return $this->id;
     }
   public function setLanguaje($languaje):void{
        $this->languaje = $languaje;
    }
    public function getLanguaje():string{
       return $this->languaje;
    }
  
    // public function getCategorys():PersistentCollection
    // {
    //     return $this->category;
    //  }
     
   
}