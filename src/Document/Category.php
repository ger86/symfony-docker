<?

namespace App\Document;
 
use App\Document\Languajes;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;
 

/**
 * 
 * @MongoDB\Document(collection="Category")
 */
class Category
{
    /** @MongoDB\Id*/
    private $id;
     
      /**
     * @MongoDB\Field(type="string")
     */
    private $category;

  /** @MongoDB\ReferenceMany(targetDocument=Post::class, mappedBy="languaje") */
  public $post;


    
    public function getId():int{  
        return $this->id;
     }
   public function setCategory($category):void{
        $this->category = $category;
    }
    public function getCategory():string{
       return $this->category;
    } 
    // public function setLanguaje($languaje):void
    // {
    //     $this->languaje = $languaje;
    //  }
    // public function getLanguaje():Languajes
    // {
    //     return $this->languaje;
    //  }
    
   
}