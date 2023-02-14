import { DELETTEBTNWORKS } from '../selectors/selectors'
class DeletteWorks {
  constructor() {
    this.init()
  }

  init() {
    const { deleteBtnWorksTable, utlActionToDeletteWorks } = DELETTEBTNWORKS
    const selectorBtnToDelette = document.getElementsByClassName(
      deleteBtnWorksTable,
    )[0]
    if (selectorBtnToDelette) {
      selectorBtnToDelette.addEventListener('click', (e) => {
        if ('WorksDelette__' === e.target.parentNode.parentNode.classList[0]) {
          const URLToDelette =
            utlActionToDeletteWorks +
            e.target.parentNode.parentNode.classList[1]
          let confirmDeletteJobs = prompt('Please tipe WORKS to delette')
          if (
            confirmDeletteJobs &&
            confirmDeletteJobs.toLowerCase() === 'works'
          ) {
            window.location.href = URLToDelette
          } else {
            console.warn(
              'the jobs id: ' +
                e.target.parentNode.parentNode.classList[1] +
                ' not has been deletted',
            )
          }
        }
      })
    }
  }
}

export default DeletteWorks
