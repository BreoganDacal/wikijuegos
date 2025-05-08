document.addEventListener("DOMContentLoaded", loadDogs);

function loadDogs() {
    fetch("https://api.thedogapi.com/v1/breeds?api_key=live_QTxCSnD7fiyrad0kBT4OQy7jZZhhELieKjBNE1vHUekOZRporFrrJP3ijsX8jCq1")
        .then(response => response.json())
        .then(data => {
            window.dogs = data || [];
            displayDogs(window.dogs);
        })
        .catch(error => console.error("Error al cargar razas:", error));
}

function displayDogs(dogs) {
    const dogList = document.getElementById("dog-list");
    dogList.innerHTML = "";

    if (dogs.length === 0) {
        dogList.innerHTML = "<p>No se encontraron razas. Prueba otro filtro o búsqueda.</p>";
        return;
    }

    dogs.forEach(dog => {
        const dogItem = document.createElement("div");
        dogItem.innerHTML = `
            <h2>${dog.name}</h2>
            <img src="https://cdn2.thedogapi.com/images/${dog.reference_image_id}.jpg" alt="${dog.name}" width="200">
            <p>Temperamento: ${dog.temperament}</p>
            <p>Peso: ${dog.weight.metric} kg</p>
        `;
        dogList.appendChild(dogItem);
    });
}

function searchDogs() {
    const query = document.getElementById("search").value.toLowerCase();
    if (!query.trim()) return displayDogs(window.dogs);

    const filteredDogs = window.dogs.filter(dog => dog.name.toLowerCase().includes(query));
    displayDogs(filteredDogs);
}

function filterBySize() {
    const selectedSize = document.getElementById("size").value;
    
    const filteredDogs = window.dogs.filter(dog => {
        const weight = parseInt(dog.weight.metric.split(" - ")[0]);
        if (selectedSize === "small") return weight <= 10;
        if (selectedSize === "medium") return weight > 10 && weight <= 25;
        if (selectedSize === "large") return weight > 25;
        return true;
    });

    displayDogs(filteredDogs);
}
