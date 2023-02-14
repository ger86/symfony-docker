 
import { HIDESTATUSPOST } from '../selectors/selectors'
class PostStatusHidden 
{
     
    constructor(){ 
        this.init(); 
    }

    init(){
    const { extatusWrapper} =  HIDESTATUSPOST;

     if(document.getElementsByClassName(extatusWrapper)[0]){
        const box =  document.getElementsByClassName(extatusWrapper)[0];
        setTimeout(()=>{
            box.classList.add('hiddeStatus');
        },5000)
     }   
 
    }
 
    
}

export default PostStatusHidden;