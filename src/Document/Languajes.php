<?

namespace App\Document;
 
use App\Document\Category;
use App\Document\Homedata\Principalknowledge;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB; 

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

     /** @MongoDB\ReferenceMany(targetDocument=Principalknowledge::class, mappedBy="languaje") */
     public $principalknowledge;


    public function getId():string{
        return $this->id;
     }
   public function setLanguaje($languaje):void{
        $this->languaje = $languaje;
    }
    public function getLanguaje():string{
       return $this->languaje;
    }
     public function getKnowledges():Principalknowledge
    {
        return $this->principalknowledge;
     }
  
    // public function getCategorys():PersistentCollection
    // {
    //     return $this->category;
    //  }
     
   
}