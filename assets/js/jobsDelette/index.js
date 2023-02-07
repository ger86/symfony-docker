import { DELETTEBTNJOB } from "../selectors/selectors";
class DeletteJobs {
    constructor() {
      this.init();
    }

    init() { 
      
      const {deleteBtnJobs,utlActionToDelette} = DELETTEBTNJOB;
      const selectorBtnToDelette = document.getElementsByClassName(deleteBtnJobs)[0];
       
      selectorBtnToDelette && selectorBtnToDelette.addEventListener('click', (e)=>{ 
        if('JobsDelette__' === e.target.parentNode.classList[0]){
           const URLToDelette = utlActionToDelette+e.target.parentNode.classList[1]
           let confirmDeletteJobs = prompt("Please tipe JOBS to delette");
                if (confirmDeletteJobs.toLowerCase() === "jobs") {
                 window.location.href = URLToDelette;
                } else {
                  console.warn('the jobs id: '+ e.target.parentNode.classList[1] + 'not has been deletted')
                }
        }
    })  
    }

}

export default DeletteJobs;
