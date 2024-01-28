 
class DeletteFaq{
    constructor() {
      this.init()
    }
  
    init() {  

      const BtnsToDelette = document.querySelectorAll('.deletterFaqFromId');
          
      if ('object' == typeof BtnsToDelette) {
        BtnsToDelette.forEach((BtnToDelette) => {
          BtnToDelette.addEventListener('click', (e) => {
            e.preventDefault();  
              const URLToDelette = e.currentTarget.href + '&type=delette';
              let confirmDelettePost = prompt('Please tipe FAQ to delette')
              if ( confirmDelettePost && confirmDelettePost.toLowerCase() === 'faq' ) {
                window.location.href = URLToDelette
              } else {
                console.warn(
                  'the post id: ' +
                  e.currentTarget.href.split('=')[1] +
                    ' not has been deletted',
                )
              }
            
          })
        })
        
  
  
      }}
    }
  
  
  export default DeletteFaq;
  