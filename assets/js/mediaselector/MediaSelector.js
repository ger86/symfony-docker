 
import { MEDIASELECTORS } from '../selectors/selectors'
class MediaSelector 
{
     active;
    constructor(){
        this.init();
        this.active = 'active';
       
    }

    init(){
    const {boxMedia, selectorTriguer, showMedia, closeMedia, dataInput} =  MEDIASELECTORS;
        const triguer =  document.getElementsByClassName(selectorTriguer)[0];
        const media =  document.getElementsByClassName(boxMedia)[0];
        const close =  document.getElementsByClassName(closeMedia)[0];
        const show =  document.getElementsByClassName(showMedia)[0];
        const input =  document.getElementsByClassName(dataInput)[0];

        triguer.addEventListener('click', ()=>{
            media.classList.add(this.active);
        })

        close.addEventListener('click', async ()=>{ 
            media.classList.remove(this.active);
        })

        input.addEventListener('change', (e) => {
           
            	  show.style.backgroundImage = `url('${e.target.value}')`;
        	 
        })

    }
    
}

export default MediaSelector;