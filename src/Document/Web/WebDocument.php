<?

namespace App\Document\Web;
 
 
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
 

/**
 * 
 * @MongoDB\Document(collection="Web")
 */
class WebDocument
{

  /** @MongoDB\Id*/
  private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $title;

     /**
     * @MongoDB\Field(type="int")
     */
    private $porcent;

    public function getId(): string
    {
        return $this->id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setPorcent(string $porcent): void
    {
        $this->porcent = $porcent;
    }
    public function getPorcent(): int
    {
        return $this->porcent;
    }
    
}