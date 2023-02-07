import { WEBRANGESELECTOR } from '../selectors/selectors'

export default class WebValueRange {
  constructor() {
    this.init()
  }

  init() {   
    const { valueInputSelector, selectorShowText } = WEBRANGESELECTOR
    const valueRange = document.querySelector(valueInputSelector)
    const textValue = document.getElementsByClassName(selectorShowText)[0]
  
    if (valueRange && textValue) {
      textValue.innerText = `Actual value = ${valueRange.value}`

      valueRange.addEventListener('change', (e) => {
        textValue.innerText = `Actual value = ${e.target.value}`
      })
    }
  }
}
