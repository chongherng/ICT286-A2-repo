var page = ["#home", "#about", "#products", "#help", "#login", "#register", "#profile", "#manage", "#jackets", "#shirts","#skirts","#pants","#undergarments","#cart"];

var curPage = page[0];

$(document).ready(function(){
   var newPage = getPage(window.location.hash);
   render(newPage);

   addActiveClass();
   loadProduct();

   

   $(window).on('hashchange', function(){
       var newPage = getPage(window.location.hash);
       if (
         window.location.hash == "#jackets" ||
         window.location.hash == "#shirts" ||
         window.location.hash == "#skirts" ||
         window.location.hash == "#undergarments" ||
         window.location.hash == "#pants"
       ) {
         renderProductPage(newPage);
       } else {
          $("#jackets").show();
          $("#skirts").hide();
          $("#shirts").hide();
          $("#pants").hide();
          $("#undergarments").hide();
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
      .addEventListener("click", addToCartclicked);
  }
}

function addToCartclicked(e) {
  let cartExist = document.getElementById("cart");
  if(JSON.stringify(cartExist) != "null") {
    let button = e.target;
    let product = button.parentElement.parentElement;
    let title = product.getElementsByClassName("product-title")[0].innerText;
    let price = product.getElementsByClassName("product-price")[0].innerText;
    trimPrice = $.trim(price);
    trimPrice = trimPrice.split(" ");
    price = trimPrice[1];
    let id = product.getElementsByClassName("product-id")[0].innerText;
    let size = product.getElementsByClassName("product-size")[0].value
    addToCart(title,price,id,size);
    updateCartTotal();
  } else{
    alert("Please login to add item to cart");
  }
}

function addToCart(title,price,id,size){
  let cartRow = document.createElement("div");
  let cartItems = document.getElementsByClassName("cart-items")[0];
  let cartItemNames = cartItems.getElementsByClassName("cart-item-title");
  for (i = 0; i < cartItemNames.length; i++) {
    if (cartItemNames[i].innerText == title) {
      alert("This item is already added to the cart");
      return;
    }
  }
  let cartRowContents = `
          <div class="cart-row">
              <div class="cart-item cart-col">
              <input type="text" class="cart-item-id" value="${id}" hidden>
              <span class="cart-item-title">${title}</span>
              </div>
              <span class="cart-size cart-col">${size}</span>
              <input class="cart-size-input" value="${size}" hidden>
              <span class="cart-price cart-col">${price}</span>
              <div class="cart-quantity cart-col">
              <input class="cart-quantity-input" type="number" value="1">
              <button class="remove-btn">REMOVE</button>
              </div>
          </div>`;
  cartRow.innerHTML = cartRowContents;
  cartItems.append(cartRow);
  cartRow
    .getElementsByClassName("remove-btn")[0]
    .addEventListener("click", removeCartItem);
  cartRow
    .getElementsByClassName("cart-quantity-input")[0]
    .addEventListener("change", quantityChanged);
}

function updateCartTotal() {
  let total = 0;
  let cartItemContainer = document.getElementsByClassName("cart-items")[0];
  let cartRows = cartItemContainer.getElementsByClassName("cart-row");
  for (i = 0; i < cartRows.length; i++) {
    let cartRow = cartRows[i];
    let priceElement = cartRow.getElementsByClassName("cart-price")[0];
    let quantityElement = cartRow.getElementsByClassName(
      "cart-quantity-input"
    )[0];
    let price = parseFloat(priceElement.innerText.slice(1));
    let quantity = parseFloat(quantityElement.value);
    total = total + price * quantity;
  }
  document.getElementsByClassName("cart-total-price")[0].innerHTML =
    "$" + total.toFixed(2);
}

function removeCartItem(e) {
  e.target.parentElement.parentElement.remove();
  updateCartTotal();
}

function quantityChanged(e) {
  let input = e.target;
  if (isNaN(input.value) || input.value <= 0) {
    input.value = 1;
  }
  updateCartTotal();
}

function validateForm(e) {
  e.preventDefault();
  let cartItems = document.getElementsByClassName("cart-items")[0];
  let cartRows = cartItems.getElementsByClassName("cart-row");
  if (cartRows.length == 0) {
    alert("Please select at least one item before submitting!");
    return false;
  }
  let data = getData();
  makePurchase(data);
}

function getData(){
  let data = "";
  let cartItems = document.getElementsByClassName("cart-items")[0];
  let cartRows = cartItems.getElementsByClassName("cart-row");
    for (i = 0; i < cartRows.length; i++) {
      data +=
        "&itemID[]=" +
        encodeURI(cartRows[i].getElementsByClassName("cart-item-id")[0].value);
      data +=
        "&itemQty[]=" +
        encodeURI(
          cartRows[i].getElementsByClassName("cart-quantity-input")[0].value);
      data +=
        "&itemSize[]=" +
        encodeURI(
          cartRows[i].getElementsByClassName("cart-size-input")[0].value
        );
    }
    return data;
}

function makePurchase(data) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      processResponse(this.responseText);
    }
  };
  xhr.open("POST", "../Server/purchase.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(data);
}

function processResponse(response) {
  document.getElementById("cart-response-container").innerHTML = response;
}