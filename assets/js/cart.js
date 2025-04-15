const inputField = document.getElementById("t-text");

if (inputField) {
    const productContainer = document.getElementById("product-container");
    const productItems = productContainer.getElementsByClassName("product-item");
    inputField.addEventListener("input", function () {
        const query = inputField.value.toLowerCase();

        for (let i = 0; i < productItems.length; i++) {
            const productName = productItems[i].getAttribute("data-name");
            if (productName.includes(query)) {
                productItems[i].style.display = ""; // Afficher l'élément
            } else {
                productItems[i].style.display = "none"; // Masquer l'élément
            }
        }
    });
}
