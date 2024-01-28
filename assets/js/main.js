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
 
import GalleryFilter from "./galleryFilter";
import MediaSelector from "./mediaselector/MediaSelector";
import PostStatusHidden from "./postStatusHidden";
import DeletteJobs from "./jobsDelette";
import WebValueRange from "./WebValueRange";
import GraphicRange from "./GraphicRange";
import DeletteWorks from "./worksDelette";
import DelettePost from "./PostDelette";
import DelettePage from "./PageDelette";
import DeletteFaq from "./DeletteFaq";
 
window.addEventListener("load", () => {
  window.DeletteJobs                    = new DeletteJobs(); 
  window.MediaSelector                  = new MediaSelector();
  window.PostStatusHidden               = new PostStatusHidden();
  window.GalleryFilter                  = new GalleryFilter();
  window.WebValueRange                  = new WebValueRange();
  window.GraphicRange                   = new GraphicRange();
  window.DeletteWorks                   = new DeletteWorks();
  window.DelettePost                    = new DelettePost();
  window.DelettePage                    = new DelettePage();
  window.DeletteFaq                     = new DeletteFaq();
});

    
 
 