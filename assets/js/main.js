/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import '../css/app.scss';

// start the Stimulus application
// import './bootstrap';

 
 
import Loginscript from "../login";

window.addEventListener("load", () => {
  window.Loginscript = new Loginscript(); 
});
 
    
 
