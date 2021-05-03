const feltolt = (id) => {
    const xhttp = new XMLHttpRequest()
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText)
        }   
    }
    xhttp.open("POST","ujJatek.php?sor="+sor+"&oszlop="+oszlop,true)
    xhttp.send()
    

    adminViewFrissit()
}

const adminViewFrissit = () => {
    window.location.reload()
}