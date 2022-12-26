<?

namespace App\Document\BlogDocument;

use App\Document\Category;
use App\Document\Languajes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\PersistentCollection;


/**
 * 
 * @MongoDB\Document(collection="Blog")
 */
class Blog
{
    /** @MongoDB\Id*/
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $title;

    /**
     * @MongoDB\Field(type="string")
     */
    private $urlFriendly;
    /**
     * @MongoDB\Field(type="string")
     */
    private $body;

    /**
     * @MongoDB\Field(type="ArrayCollection")
     */
    private $keyword; // set like arrayContro..

    /**
     * @MongoDB\Field(type="string")
     */
    private $imageUrl;

    /**
     * @MongoDB\Field(type="bool")
     */
    private $status;

    /**
     * @MongoDB\Field(type="date")
     */
    private $datePublished;


    /** @MongoDB\ReferenceOne(targetDocument=Languajes::class, inversedBy="post", storeAs="id") */
    private $languaje;

    /** @MongoDB\ReferenceOne(targetDocument=Category::class, inversedBy="post", storeAs="id") */
    private $category;

    public function getId(): int
    {
        return $this->id;
    }

    // * titulo
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    // * $urlFriendly
    public function setUrlFriendly(string $urlFriendly): void
    {
        $this->urlFriendly = $urlFriendly;
    }
    public function getUrlFriendly(): string
    {
        return $this->urlFriendly;
    }
    // * $body
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
    public function getBody(): string
    {
        return $this->body;
    }
    // * $keyword
    public function setKeyword(array $keyword): void
    {
        $this->keyword = $keyword;
    }
    public function getKeyword(): array
    {
        return $this->keyword;
    }
    // * $imageUrl
    public function setImageUrl(array $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }
    public function getImageUrl(): array
    {
        return [$this->imageUrl];
    }
    // * $status; 
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
    public function getStatus(): bool
    {
        return $this->status;
    }

    // * $datePublished   
    public function setDatePublished(\DateTime $datePublished): void
    {
        $this->datePublished = $datePublished;
    }
    public function getDatePublished(): \DateTime
    {
        return $this->datePublished;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getLanguaje(): Languajes
    {
        return $this->languaje;
    }
}
