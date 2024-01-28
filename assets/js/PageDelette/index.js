 
class DelettePage {
  constructor() {
    this.init()
  }

  init() { 
   
    const BtnsToDelette = document.querySelectorAll('.delettePostFromId');
       
     
    if ('object' == typeof BtnsToDelette) {
      BtnsToDelette.forEach((BtnToDelette) => {
        BtnToDelette.addEventListener('click', (e) => {
          e.preventDefault(); 
            const URLToDelette = e.target.href + '&type=delette';
            let confirmDelettePost = prompt('Please tipe PAGE to delette')
            if ( confirmDelettePost && confirmDelettePost.toLowerCase() === 'page' ) {
              window.location.href = URLToDelette
            } else {
              console.warn(
                'the post id: ' +
                e.target.href.split('=')[1] +
                  ' not has been deletted',
              )
            }
          
        })
      })
      


    }}
  }


export default DelettePage
