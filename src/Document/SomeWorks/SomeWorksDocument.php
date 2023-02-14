<?

namespace App\Document\SomeWorks;

use App\Document\Languajes;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
 
/**
 * 
 * @MongoDB\Document(collection="Works")
 */
class SomeWorksDocument
{

  /** @MongoDB\Id*/
  private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $base;

    /**
     * @MongoDB\Field(type="string")
     */
    private $techs;

    /**
     * @MongoDB\Field(type="string")
     */
    private $description;

    /** @MongoDB\ReferenceOne(targetDocument=Languajes::class, inversedBy="someworks", storeAs="id") */
    private $languaje;

    

    public function getId(): string
    {
        return $this->id;
    }
    public function setBase(string $base): void
    { 
        $this->base = $base;
    }
    public function getBase(): string
    {
        return $this->base;
    }

    public function setTechs(string $techs): void
    {
        $this->techs = $techs;
    }
    public function getTechs(): string
    {
        return $this->techs;
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