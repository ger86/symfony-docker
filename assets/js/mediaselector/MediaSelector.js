 
import { MEDIASELECTORS } from '../selectors/selectors'
class MediaSelector 
{
     active;
    constructor(){
        this.checkIfImageIsNotEmpty();
        this.init();
        this.active = 'active';
       
    }

    init(){
    const {boxMedia, 
          selectorTriguer, 
          showMedia, 
          closeMedia, 
          dataInput, 
          boxMediaCollection, 
          friendlyUrlSwitch
           } =  MEDIASELECTORS;

        const triguer =  document.getElementsByClassName(selectorTriguer)[0];
        const media =  document.getElementsByClassName(boxMedia)[0];
        const close =  document.getElementsByClassName(closeMedia)[0];
        const show =  document.getElementsByClassName(showMedia)[0];
        const input =  document.getElementsByClassName(dataInput)[0];
        const imageSelector =  document.getElementsByClassName(boxMediaCollection)[0]; 
        const FriendlyInput =  document.getElementsByClassName(friendlyUrlSwitch)[0]; 

        triguer && triguer.addEventListener('click', (e)=>{
            e.preventDefault();
            media.classList.add(this.active);
        })

        close && close.addEventListener('click', async ()=>{ 
            media.classList.remove(this.active);
        })

        

        imageSelector && imageSelector.addEventListener('click', (e) => {
            // console.log("🚀 ~ file: ~ e", show)
            if("IMG" == e.target.nodeName){
                media.classList.remove(this.active);
                input.value = e.target.currentSrc
                show.style.backgroundImage = `url('${e.target.currentSrc}')`;
            }  
        })


        FriendlyInput && FriendlyInput.addEventListener('keyup',(e)=>{ 
            e.target.value = this.switchTextToHeart(e.target.value); 
        })
 
    }

    checkIfImageIsNotEmpty(){
        const input =  document.getElementsByClassName(MEDIASELECTORS.dataInput)[0];
        const show =  document.getElementsByClassName(MEDIASELECTORS.showMedia)[0];
        if(input && '' != input.value){
         show.style.backgroundImage = `url('${input.value}')`;
        }
    }

     switchTextToHeart(string) {  
        let filterResultFrase;
        const heart = "-";
        let regex = /\s/g; 
        filterResultFrase = string.toString().replace(regex, heart); 
        return filterResultFrase;
      }
      
    //   console.log(switchTextToHeart('esta es una frase de epoca mihca'))
    
}

export default MediaSelector;