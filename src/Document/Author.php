<?

namespace App\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;

/**
 * 
 * @MongoDB\Document(collection="Author")
 */
class Author
{
    /** @MongoDB\Id*/
    private $id;
    
    /** @MongoDB\Field(type="string") */
    private $nombre;

    /** @MongoDB\ReferenceMany(targetDocument=Books::class, mappedBy="author", cascade={"persist"}) */
    private $books;
 
  
    public function setBooks($parampost):void{
        $this->post = $parampost;
    }

    public function setNombre($parampost):void{
        $this->nombre = $parampost;
    }

     public function getBooks():PersistentCollection {
        return $this->books;
    }
    public function getNombre()
    {
       return $this->nombre;
    }
    public function getId()
    {
       return $this->id;
    }
}