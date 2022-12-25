import { POSTSELECTVALUES } from "../selectors/selectors";
class ConfigureValueInPostSelect {
  constructor() {
    this.init();
  }

  init() {
    const { options } = POSTSELECTVALUES;

    if (document.getElementById(options)) { 
      const optoinsValues = document.getElementById(options);
      optoinsValues.childNodes.forEach(
        (element) => (element.innerText = element.value)
      );
    }
  }
}
export default ConfigureValueInPostSelect;
