import { GALLERYFILTER } from "../selectors/selectors";
class GalleryFilter {
  constructor() {
    this.init();
  }

  init() {

    const { boxgallery, partUrl, trigger } = GALLERYFILTER;

    var triggerBtns = document.getElementsByClassName(trigger)[0];
  
    triggerBtns && triggerBtns.addEventListener('click',(e) => {
          const selector = e.target.id.split('__')[1]
          this.filterGallery( selector ,boxgallery , partUrl) 
      })
    






  }
  
  filterGallery(value,boxgallery , partUrl){
    console.log("🚀 ~ file: ", value)
    
    if (document.getElementsByClassName(boxgallery)[0]) { 
      const optoinsValues =  document.getElementsByClassName(boxgallery)[0];
       
        
         for(var i = 0; i <  optoinsValues.children.length; i++){
            optoinsValues.children[i].style.display = 'block' 
            var find = optoinsValues.children[i].children[0].currentSrc; 
            var splitString = find.split(partUrl);
               if( value != splitString[1].split('/')[0].toLocaleLowerCase() && 'all' != value){//debugger
                optoinsValues.children[i].style.display = 'none' 
               }  
          } // for
      


      
      
    } // if 
  }


}
export default GalleryFilter;


 