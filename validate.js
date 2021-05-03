
function validateMain() {
    activeateButton();
}

function noneTextisEmty() {
    const txtSzerzo = document.getElementById("szerzo").value;
    const txtCim = document.getElementById("cim").value;
    const txtTorzs = document.getElementById("vers_torzs").value;
    let clickable = true; 
    if(txtSzerzo.length != 0 && txtCim.length != 0 && txtTorzs.length != 0){
        console.log("okés");
        clickable = true;
    }else{
        console.log("nem okés");
        clickable = false;
    }
    return clickable;
}

function activeateButton() {
    const subBtn = document.getElementById("subButton");
    if(noneTextisEmty()){
        subBtn.disabled = false;
    }else{
        subBtn.disabled = true;
    }
}