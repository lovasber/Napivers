
const  hattercsere = () =>{
    const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
    const fejlec = document.getElementById("fejlec")
    const main = document.getElementById("main")
    if (prefersDarkScheme.matches) {
        //console.log("sötét")
        document.body.style.backgroundColor = "#6d6d6d"
        document.body.style.color = "white"
        fejlec.classList.add('navbar-dark','bg-dark');
        fejlec.classList.remove('navbar-light','bg-light');
    } else {
        //console.log("viálgos")
        document.body.style.backgroundColor = "white"
        document.body.style.color = "#6d6d6d"        
        fejlec.classList.add('navbar-light','bg-light');
        fejlec.classList.remove('navbar-dark','bg-dark');        
    }
}

const kepeltuntet = (windowWidth) => {
    const jobbcont = document.getElementById("grafika1")
    const balcont =  document.getElementById("grafika2")
    if(jobbcont != undefined ||  balcont != undefined) {
        if(windowWidth.matches){
            jobbcont.style.visibility = "hidden"
            balcont.style.visibility = "hidden"
            console.log("bujj")
         }else{
             jobbcont.style.visibility = "visible"
             balcont.style.visibility = "visible"
             console.log("mutass")
         }
    }
    
}

let mywindow = window.matchMedia("(max-width: 777px)")

kepeltuntet(mywindow)
mywindow.addEventListener('change',kepeltuntet)

hattercsere()
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change',hattercsere);