import { POSTSELECTVALUES } from "../selectors/selectors";
class ConfigureValueInPostSelect {
  constructor() {
    this.init();
  }

  init() {
    const { options, lang } = POSTSELECTVALUES;

    if (document.getElementById(options)) { 
      const optoinsValues = document.getElementById(options);
      optoinsValues.childNodes.forEach(
        (element) => (element.innerText = element.value)
      );
    }

    if (document.getElementById(lang)) { 
      const optoinsValues = document.getElementById(lang);
      optoinsValues.childNodes.forEach(
        (element) => (element.innerText = element.value)
      );
    }
  }
}
export default ConfigureValueInPostSelect;
