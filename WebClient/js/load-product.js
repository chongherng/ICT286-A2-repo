if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready);
} else {
    ready();
}

function ready() {
    loadProduct();
}

function loadProduct() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        displayProduct(this.response);
        }
    };
    let php = "loadProduct";
    xhr.open("GET", "./load.php", true);
    xhr.send();
}

function displayProduct(response) {
    let dataArr = JSON.parse(response);
}
