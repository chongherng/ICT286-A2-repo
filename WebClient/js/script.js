var page = ["#home", "#about", "#products", "#help", "#login", "#register", "#profile", "#manage", "#jackets", "#shirts","#skirts","#pants","#undergarments"];

var curPage = page[0];

$(document).ready(function(){
   var newPage = getPage(window.location.hash);
   render(newPage);

   addActiveClass();
   loadProduct();

   $(window).on('hashchange', function(){
       var newPage = getPage(window.location.hash);
       console.log(newPage);
       if (
         window.location.hash == "#jackets" ||
         window.location.hash == "#shirts" ||
         window.location.hash == "#skirts" ||
         window.location.hash == "#undergarments" ||
         window.location.hash == "#pants"
       ) {
         renderProductPage(newPage);
       } else {
         render(newPage);
       }
   });

   //mobile nav bar animation
   $(".toggle").on("click", function(){
    if($(".nav-link").hasClass("toggled")){
      $(".nav-link").removeClass("toggled");
      $(".mobile-only").removeClass("toggled");
    } else{
      $(".nav-link").addClass("toggled");
      $(".mobile-only").addClass("toggled");
    }
   }) 

});

function renderProductPage(newPage){
    if (newPage == curPage) return;
    $("#id1").show();
    $("#jackets").hide();
    $("#skirts").hide();
    $("#shirts").hide();
    $("#pants").hide();
    $("#undergarments").hide();
    $(newPage).show();
}

function render(newPage){
    if (newPage == curPage) return;
    $(curPage).hide();
    $(newPage).show();
    curPage = newPage; 
}

function getPage(hash){
   var i = page.indexOf(hash);
   if (i<0 && hash != "") window.location.hash=page[0]; 
   return i < 1 ? page[0] : page[i];
}

function addActiveClass(){
  var navLinks = document.getElementsByClassName("nav-link");
  for(var i = 0; i < navLinks.length; i++){
    navLinks[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("active");

      if(current.length > 0) {
        current[0].className = current[0].className.replace(" active", "");
      }

      this.className += " active";
    }
    )}
}

function loadProduct() {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      displayProduct(this.response);
    }
  };
  xhr.open("GET", "../Server/load-product.php", true);
  xhr.send();
}

function displayProduct(response) {
  let dataObj = JSON.parse(response);
  var countKey = Object.keys(dataObj).length;
  for (i = 0; i < countKey; i++) {
    let data = dataObj[i];
    let productRow = document.createElement("div");
    productRow.className = "products";
    let products = document.getElementsByClassName("products-details-content");
    /* Create product content div */
    let productContent = `
                                <img class="product-image" src="${data.ImgSrc}">
                                <div class="product-details">
                                    <div class="product-description">
                                        <input type="hidden" class="product-id" value="${data.ProductID}">
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
                                        <span class="product-color">Color:${data.Color}</span>
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
    if (data.Type == "Jacket") {
      products[0].append(productRow);
    }
    if (data.Type == "Shirts") {
      products[1].append(productRow);
    }
    if (data.Type == "Skirts") {
      products[2].append(productRow);
    }
    if (data.Type == "Undergarments") {
      products[3].append(productRow);
    }
    if (data.Type == "Pants") {
      products[4].append(productRow);
    }
    productRow
      .getElementsByClassName("add-to-cart-button")[0]
      .addEventListener("click", addItemToCart);
  }
}

function addItemToCart(e) {
  let button = e.target;
  let product = button.parentElement.parentElement;
  let title = product.getElementsByClassName("product-title")[0].innerText;
  let price = product.getElementsByClassName("product-price")[0].innerText;
  let id = product.getElementsByClassName("product-id")[0].innerText;
  let size = product.getElementsByClassName("product-size")[0].innerText;
  addItemToCart(title, price, id, size);
}
