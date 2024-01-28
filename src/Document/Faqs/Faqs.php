<?

namespace App\Document\Faqs;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * 
 * @MongoDB\Document(collection="Faqs")
 */
class Faqs
{
    /** @MongoDB\Id*/
    private $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $question;

    /**
     * @MongoDB\Field(type="string")
     */
    private $response;
 
    public function getId(): string
    {
        return $this->id;
    }

    // * titulo
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }
    public function getQuestion(): string
    {
        return $this->question;
    }  
    // * $response
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }
    public function getResponse(): string
    {
        return $this->response;
    } 
}
