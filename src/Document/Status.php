<?

namespace App\Document;
 
use App\Document\Languajes;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;
 

/**
 * 
 * @MongoDB\Document(collection="Status")
 */
class Status
{
    /** @MongoDB\Id*/
    private $id;
     
      /**
     * @MongoDB\Field(type="string")
     */
    private $status;

  /** @MongoDB\ReferenceMany(targetDocument=Blog::class, mappedBy="status") */
  public $post;


    
    public function getId():int{  
        return $this->id;
     }
   public function setStatus($status):void{
        $this->status= $status;
    }
    public function getStatus():string{
       return $this->status;
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