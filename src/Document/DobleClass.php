<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\DiscriminatorField;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

# Esto podrá crar dos documentos en la coleccion dobleclass al mismo tiempo
 
/**
 * @MongoDB\Document(collection="Dobleclass")
 * @DiscriminatorField("prototype")  
 */
class DobleClass 
{ 
     
    /**
     * @MongoDB\Id
     */
    protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $space;
     /**
     * @MongoDB\Field(type="int")
     */
    protected $price;

     function setSpace($space):void{
        $this->space = $space;
     }
     function getSpace():string{
        return $this->space;
     }

    

     function setPrice($price):void{
        $this->price = $price;
     }
     function getPrice():int{
        return $this->price;
     }
}

/**
 * @MongoDB\Document(collection="Dobleclass")
 * @DiscriminatorField("prototype")  
 */

 class Albun {
      /**
     * @MongoDB\Id
     */
    protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $albun;

    function setAlbun($albun):void{
        $this->albun = $albun;
     }
     function getAlbun():string{
        return $this->albun;
     }
 }