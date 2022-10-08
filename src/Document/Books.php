<?

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use App\Document\Author;
use Doctrine\ODM\MongoDB\PersistentCollection;

/**
 * 
 * @MongoDB\Document(collection="Library")
 */
class Books
{
    /** @MongoDB\Id*/
    private $id;

/** @MongoDB\Field(type="collection") */
   private $categories = [];

   /** 
    * @MongoDB\Field(type="string")
   */
  public $nombre;
   

 /** @MongoDB\ReferenceOne(targetDocument=Author::class, inversedBy="books" ) */
   public $author;


      /** 
    * @MongoDB\Field(type="int")
   */
   public $datePublicacion;
   
   
    public function __construct()
    {
        $this->categories = new ArrayCollection();
    } 
   
   public function setCategories($categ):void{
        $this->categories = $categ; 
    }

    public function setNombre($nombre):void{
        $this->nombre = $nombre; 
    }

    public function setDatePublicacion($datePublicacion):void
    {
        $this->datePublicacion = $datePublicacion; 
    }
    
    public function setAuthor($author):void
    {
        $this->author = $author; 
    }

    public function getAuthor():Author
    {
       return $this->author; 
    }
    public function getCategories():ArrayCollection
    {
       return new ArrayCollection(array($this->categories)); 
    }
    public function getDatePublicacion():int
    {
       return $this->datePublicacion; 
    }
    public function getNombre()
    {
       return $this->nombre; 
    }
}