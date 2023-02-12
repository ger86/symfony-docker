import { DELETTEBTNPOST } from '../selectors/selectors'
class DelettePost {
  constructor() {
    this.init()
  }

  init() { 
    const { deleteBtnPostTable, utlActionToDelettePost } = DELETTEBTNPOST
    const selectorBtnToDelette = document.querySelector(deleteBtnPostTable)
    
    if (selectorBtnToDelette) {
      selectorBtnToDelette.addEventListener('click', (e) => {
        //  console.error(e.target.parentNode)
        if ('actionTrash__' === e.target.parentNode.classList[0]) {
          const URLToDelette =
          utlActionToDelettePost +
            e.target.parentNode.classList[1]
          let confirmDelettePost = prompt('Please tipe POST to delette')
          if (
            confirmDelettePost &&
            confirmDelettePost.toLowerCase() === 'post'
          ) {
            window.location.href = URLToDelette
          } else {
            console.warn(
              'the post id: ' +
                e.target.parentNode.classList[1] +
                ' not has been deletted',
            )
          }
        }
      })
    }
  }
}

export default DelettePost
