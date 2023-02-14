<?

namespace App\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\UniqueIndex;

 
/**
 * 
 * @MongoDB\Document(collection="Administrator")
 */
class Userone
{
    /** @MongoDB\Id*/
    private $id;
    
    /** @MongoDB\Field(type="string") @UniqueIndex */
    private $email;
     
    /** @MongoDB\Field(type="string") */
    private $mipass;
  
    public function setId($id):void{
         $this->id = $id;
    }
    public function setEmail($email):void
    {
         $this->email = $email;
    }
    public function setMipass($pass):void
    {
        $this->mipass = md5($pass);
    }


     public function getId():int{
        return $this->id;
    }
    public function getEmail():string
    {
       return $this->email;
    }
    public function getMipass():string
    {
       return $this->mipass;
    }
}