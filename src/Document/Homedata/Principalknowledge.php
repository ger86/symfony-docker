<?

namespace App\Document\Homedata;
 
use App\Document\Languajes; 
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;

/**
 * 
 * @MongoDB\Document(collection="Homedata")
 */
class Principalknowledge 
{

  /** @MongoDB\Id*/
  private $id;

/** @MongoDB\ReferenceOne(targetDocument=Languajes::class, inversedBy="principalknowledge", storeAs="id") */
private $languaje;


    /**
     * @MongoDB\Field(type="string")
     */
    private $title;

     /**
     * @MongoDB\Field(type="string")
     */
    private $body;

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
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
    public function getBody(): string
    {
        return $this->body;
    }
    public function setLanguaje($languaje): void
    {
        $this->languaje = $languaje;
    }

    public function getLanguaje(): Languajes
    {
        return $this->languaje;
    } 
}