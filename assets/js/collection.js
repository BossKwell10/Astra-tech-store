
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".add-item").forEach(button => {
        button.addEventListener("click", function () {
            let targetId = this.getAttribute("data-target");
            let targetList = document.getElementById(targetId);

            if (!targetList) {
                console.error("Target list not found:", targetId);
                return;
            }

            let prototype = targetList.dataset.prototype;
            if (!prototype) {
                console.error("Prototype missing in:", targetId);
                return;
            }

            let index = targetList.querySelectorAll(".input-group").length;
            let newItem = document.createElement("div");
            newItem.classList.add("input-group", "mb-2");
            newItem.innerHTML = prototype.replace(/__name__/g, index);

            // Ajout du bouton de suppression
            let removeButton = document.createElement("button");
            removeButton.type = "button";
            removeButton.classList.add("btn", "btn-danger", "remove-item");
            removeButton.textContent = "X";
            removeButton.addEventListener("click", function () {
                newItem.remove();
            });

            newItem.appendChild(removeButton);
            targetList.appendChild(newItem);
        });
    });
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-item")) {
            event.target.closest(".input-group").remove();
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Ajouter un écouteur d'événements pour les boutons de suppression
    document.querySelectorAll('.delete-item').forEach(function(button) {
        button.addEventListener('click', function(event) {
            var target = event.target.getAttribute('data-target');
            var productElement = document.querySelector(target);
            if (productElement) {
                // Supprimer l'élément du DOM
                productElement.remove();
            }
        });
    });
});