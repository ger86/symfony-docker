import { DESIGNRANGESELECTOR } from "../selectors/selectors";

class GraphicRange{

    constructor(){
        this.init();
    }
    init(){
        const {valueInputSelector, valueText}= DESIGNRANGESELECTOR;
        const valueBoxRamge = document.getElementsByClassName(valueText)[0];
        const rangeValue = document.querySelector(valueInputSelector);
        if(valueBoxRamge){
            valueBoxRamge.innerText = `Actual value = ${rangeValue.value}`;
        }
           
        rangeValue && rangeValue.addEventListener('change',(e)=>{
           valueBoxRamge.innerText = `Actual value = ${e.target.value}`;
       })
    }
}

export default GraphicRange;