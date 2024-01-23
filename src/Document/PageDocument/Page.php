<?

namespace App\Document\PageDocument;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * 
 * @MongoDB\Document(collection="Page")
 */
class Page
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
    private $body;

    /**
     * @MongoDB\Field(type="string")
     */
    private $imageUrl; 
   
 
    public function getId(): string
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
      // * $imageUrl
      public function setImageUrl(string $imageUrl): void
      {
          $this->imageUrl = $imageUrl;
      }
      public function getImageUrl(): string
      {
          return $this->imageUrl;
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
}
