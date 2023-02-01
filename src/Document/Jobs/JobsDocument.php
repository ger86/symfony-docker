<?

namespace App\Document\Jobs;

use App\Document\Languajes;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
 
/**
 * 
 * @MongoDB\Document(collection="Jobs")
 */
class JobsDocument
{

  /** @MongoDB\Id*/
  private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $datename;

    /**
     * @MongoDB\Field(type="string")
     */
    private $title;

    /**
     * @MongoDB\Field(type="string")
     */
    private $description;

    /** @MongoDB\ReferenceOne(targetDocument=Languajes::class, inversedBy="jobstimeline", storeAs="id") */
    private $languaje;

    

    public function getId(): string
    {
        return $this->id;
    }
    public function setDatename(string $datename): void
    { 
        $this->datename = $datename;
    }
    public function getDatename(): string
    {
        return $this->datename;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function getDescription(): string
    {
        return $this->description;
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