if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

function ready() {
  loadProduct();
  let removeCartItemButtons = document.getElementsByClassName("remove-btn");
  for (i = 0; i < removeCartItemButtons.length; i++) {
    let button = removeCartItemButtons[i];
    button.addEventListener("click", removeCartItem);
  }

  let quantityInputs = document.getElementsByClassName("cart-quantity-input");
  for (i = 0; i < quantityInputs.length; i++) {
    let input = quantityInputs[i];
    input.addEventListener("change", quantityChanged);
  }

  let addToCartButtons = document.getElementsByClassName("add-to-cart-btn");
  for (i = 0; i < addToCartButtons.length; i++) {
    let button = addToCartButtons[i];
    button.addEventListener("click", addToCartClicked);
  }

  document.getElementById("form1").addEventListener("submit", validateForm);
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

function addToCartClicked(e) {
  let button = e.target;
  let product = button.parentElement.parentElement;
  let title = product.getElementsByClassName("product-title")[0].innerText;
  let price = product.getElementsByClassName("product-price")[0].innerText;
  let id = product.getElementsByClassName("product-id")[0].innerText;
  addItemToCart(title, price, id);
  updateCartTotal();
}

function addItemToCart(title, price, id) {
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
            <input type="hidden" class="cart-item-id" value="${id}">
            <span class="cart-item-title">${title}</span>
            </div>
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

function validateForm(e) {
  e.preventDefault();
  let userName = document.forms["form1"]["name"].value;
  if (userName == "") {
    alert("Please enter your name!");
    return;
  }
  let cartItems = document.getElementsByClassName("cart-items")[0];
  let cartRows = cartItems.getElementsByClassName("cart-row");
  if (cartRows.length == 0) {
    alert("Please select at least one item before submitting!");
    return;
  }
  let data = getData();
  sendData(data);
}

function getData() {
  let data = "name=" + encodeURI(document.forms["form1"]["name"].value);
  let cartItems = document.getElementsByClassName("cart-items")[0];
  let cartRows = cartItems.getElementsByClassName("cart-row");
  for (i = 0; i < cartRows.length; i++) {
    data +=
      "&itemID[]=" +
      encodeURI(cartRows[i].getElementsByClassName("cart-item-id")[0].value);
    data +=
      "&itemQty[]=" +
      encodeURI(
        cartRows[i].getElementsByClassName("cart-quantity-input")[0].value
      );
  }
  return data;
}

function sendData(data) {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      processResponse(this.responseText);
    }
  };
  xhr.open("POST", "./ex01.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(data);
}

function processResponse(response) {
  document.getElementById("total-container").innerHTML = response;
}

function loadProduct() {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      displayProduct(this.response);
    }
  };
  let php = "loadProduct";
  xhr.open("GET", "./ex01.php?function=" + php, true);
  xhr.send();
}

function displayProduct(response) {
  let dataArr = JSON.parse(response);
  let productTable = document.getElementsByClassName("product-details");
  for (i = 0; i < dataArr.length; i++) {
    let data = dataArr[i];
    productTable[i].getElementsByClassName("product-id")[0].innerText = data.ID;
    productTable[i].getElementsByClassName("product-title")[0].innerText =
      data.Name;
    productTable[i].getElementsByClassName("product-price")[0].innerText =
      data.Price;
  }
}
