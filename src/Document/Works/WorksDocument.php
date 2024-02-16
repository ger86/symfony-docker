<?

namespace App\Document\Works;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * 
 * @MongoDB\Document(collection="Works")
 */

 class WorksDocument{

    /** @MongoDB\Id*/
    private $id;

    /** @MongoDB\Field(type="string") */
    private $image;

    /** @MongoDB\Field(type="string") */
    private $title;

    /** @MongoDB\Field(type="string") */
    private $body;

    /** @MongoDB\Field(type="string") */
    private $tools;

    /** @MongoDB\Field(type="string") */
    private $link;

    public function getId(): string
    {
        return $this->id;
    }
    public function setImage(string $image): void
    {
        $this->image = $image;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getTitle(): string{
        return $this->title;
    }
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
    public function getBody(): string{
        return $this->body;
    }
    public function setTools(string $tools): void
    {
        $this->tools = $tools;
    }
    public function getTools(): string{
        return $this->tools;
    }
    public function setLink(string $link): void
    {
        $this->link = $link;
    }
    public function getLink(): string{
        return $this->link;
    }
 }