function searchProduct(e){
    e.preventDefault();
    let searchQuery = document.getElementById("searchQuery").value;
    let data =
      "&search=" +
      encodeURI(searchQuery);
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            processSearchResponse(this.response,searchQuery);
        }
    };
    xhr.open("POST", "../Server/query.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(data);

}

function processSearchResponse(response,searchQuery){
    if(response == "No Result Found"){
        alert("No Result Found");
    } else {
      //clear search content
      document.getElementsByClassName("search-details-container")[0].innerHTML = "";

      //create header for result page
      let searchHeader = document.createElement("div");
      searchHeader.className = "product-header";
      let searchDetail = document.createElement("div");
      searchDetail.className = "search-details-content";
      let searchHeading = document.getElementsByClassName("search-details-container")[0];
      let searchHeaderContent = `
                    <h2>Search Result: ${searchQuery}</h2>
                    `;
        searchHeader.innerHTML = searchHeaderContent;
        searchHeading.append(searchHeader);
        searchHeading.append(searchDetail);

        
        //load product onto result page
        displaySearchedProduct(response);

        //direct to search page
        let currentURL = window.location.href;
        let defaultURL = currentURL.split("#")[0];
        searchPage = defaultURL + "#searchResult";
        window.location.href = searchPage;
    }

}


function displaySearchedProduct(response){
    let dataObj = JSON.parse(response);
    var countKey = Object.keys(dataObj).length;

    for (i = 0; i < countKey; i++) {
    let data = dataObj[i];
    let productRow = document.createElement("div");
    productRow.className = "products";
    let products = document.getElementsByClassName("search-details-content")[0];
    console.log(products);
    /* Create product content div */
    let productContent = `
                                    <img class="product-image" src="${data.ImgSrc}">
                                    <div class="product-details">
                                        <div class="product-description">
                                            <span class="product-id" hidden>${data.ID}</span>
                                            <span class="product-title">${data.Name}</span>
                                        </div>
                                        <br/>
                                        <div class="product-description">
                                            <span class="product-price">Price: $${data.Price}</span>
                                        </div>
                                        <br/>
                                        <div class="product-description">
                                            <span class="product-material">Material: ${data.Material}</span>
                                        </div>
                                        <br/>
                                        <div class="product-description">
                                            <span class="product-color">Color: ${data.Color}</span>
                                        </div>
                                        <br/>
                                        <div class="product-description">
                                            <label for="size">Size: </label>
                                            <select name="size" class="product-size">
                                                <option value="XS">XS</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                            </select>
                                        </div>
                                        <div class="add-to-cart-container">
                                            <button class="add-to-cart-button" type="button">ADD TO CART</button>
                                        </div>
                                    </div>`;
    productRow.innerHTML = productContent;
    products.append(productRow);

    productRow
        .getElementsByClassName("add-to-cart-button")[0]
        .addEventListener("click", addToCartclicked);
}

}