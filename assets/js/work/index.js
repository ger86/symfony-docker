import { MEDIASELECTORS, WORKESELECTOR } from "../selectors/selectors";

class WorkActions {
  constructor() {
    this.init();
    this.PanelMediaActions();
  }

  init() {
    try {
      const { workImageBtnSelector, mediaWindows } = WORKESELECTOR;
      if (document.getElementsByClassName(workImageBtnSelector)[0]) {
        const imageWorkSelector =
          document.getElementsByClassName(workImageBtnSelector)[0];
        imageWorkSelector.addEventListener("click", (e) => {
          e.preventDefault();
          // const { target } = e;
          if (document.getElementsByClassName(mediaWindows)[0]) {
            this.closeMediaPannel(
              document.getElementsByClassName(mediaWindows)[0]
            );
            this.catchImageAndSetOnInput();
          }
        });
      }
    } catch (error) {
      console.error(error);
    }
  }

  closeMediaPannel(boxMedia) {
    boxMedia.classList.toggle("active");
  }

  PanelMediaActions() {
    try {
      const { mediaWindows, closeMediaButton } = WORKESELECTOR;

      if (document.getElementsByClassName(closeMediaButton)[0]) {
        const buttonTriguerCloseMedia =
          document.getElementsByClassName(closeMediaButton)[0];

        buttonTriguerCloseMedia.addEventListener("click", (e) => {
          e.preventDefault();
          this.closeMediaPannel(
            document.getElementsByClassName(mediaWindows)[0]
          );
        });
      }
    } catch (error) {
      console.error(error);
    }
  }

  catchImageAndSetOnInput() {
    try {
      const { boxMediaCollection, mediaWindows, input, showImageBox } =
        WORKESELECTOR;

      if (document.getElementsByClassName(boxMediaCollection)[0]) {
        const imageSelector =
          document.getElementsByClassName(boxMediaCollection)[0];
        imageSelector.addEventListener("click", (e) => {
          const { target } = e;
          if ("IMG" == target.nodeName) {
            if (document.querySelector(input)) {
              document.querySelector(input).value = target.currentSrc;
            }

            if (document.getElementsByClassName(showImageBox)[0]) {
              document.getElementsByClassName(
                showImageBox
              )[0].style.backgroundImage = `url('${target.currentSrc}')`;
            }

            if (document.getElementsByClassName(mediaWindows)[0]) {
              this.closeMediaPannel(
                document.getElementsByClassName(mediaWindows)[0]
              );
              this.catchImageAndSetOnInput();
            }
          }
        });
      } else {
        alert("No existe el selector de imagenes");
      }
    } catch (error) {
      console.error(error);
    }
  }
}

export default WorkActions;
