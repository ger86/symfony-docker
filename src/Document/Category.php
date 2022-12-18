<?

namespace App\Document;
 
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB; 

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
 
    // /** @MongoDB\ReferenceOne(targetDocument=Post::class, inversedBy="categoryes") */
    // public $post;

    //   /** @MongoDB\ReferenceOne(targetDocument=Lang::class, inversedBy="categoryes") */
    //   public $lang;
    public function getId():int{
        return $this->id;
     }
   public function setCategory($category):void{
        $this->category = $category;
    }
    public function getCategory():string{
       return $this->category;
    }
    // public function setPadre($post):void{
    //     $this->post = $post;
    //  }
    // public function getPadre():Post{
    //     return $this->post;
    //  }
    //  public function setLang($lang):void{
    //     $this->lang = $lang;
    //  }
    // public function getLang():Lang{
    //     return $this->lang;
    //  }
   
}