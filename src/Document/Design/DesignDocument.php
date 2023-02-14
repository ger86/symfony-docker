<?

namespace App\Document\Design;
 
 
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
 

/**
 * 
 * @MongoDB\Document(collection="Design")
 */
class DesignDocument
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
    private $year;

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
    public function setYear(string $year): void
    {
        $this->year = $year;
    }
    public function getYear(): int
    {
        return $this->year;
    }
    
}