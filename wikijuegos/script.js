document.addEventListener("DOMContentLoaded", loadGames);

function loadGames() {
    fetch("https://api.rawg.io/api/games?key=9148ce6b9c944c7898caf257b4203310")
        .then(response => response.json())
        .then(data => {
            window.games = data.results || [];
            displayGames(window.games);
        })
        .catch(error => console.error("Error al cargar juegos:", error));
}

function displayGames(games) {
    const gameList = document.getElementById("game-list");
    gameList.innerHTML = "";

    if (games.length === 0) {
        gameList.innerHTML = "<p>No se encontraron juegos. Prueba otro filtro o búsqueda.</p>";
        return;
    }

    games.forEach(game => {
        const gameItem = document.createElement("div");
        gameItem.innerHTML = `
            <h2>${game.name}</h2>
            <img src="${game.background_image}" alt="${game.name}" width="200">
            <p>Fecha de lanzamiento: ${game.released}</p>
            <p>Rating: ${game.rating}</p>
        `;
        gameList.appendChild(gameItem);
    });
}

function searchGames() {
    const query = document.getElementById("search").value.toLowerCase();
    const filteredGames = window.games.filter(game => game.name.toLowerCase().includes(query));
    displayGames(filteredGames);
}

function filterByRating() {
    const minRating = parseFloat(document.getElementById("min-rating").value);
    const maxRating = parseFloat(document.getElementById("max-rating").value);
    const filteredGames = window.games.filter(game => game.rating >= minRating && game.rating <= maxRating);
    displayGames(filteredGames);
}

function filterByGenre() {
  const selectedGenre = document.getElementById("genre").value;

  if (!selectedGenre) {
      displayGames(window.games); // Si no se elige un género, mostramos todos los juegos
      return;
  }

  const filteredGames = window.games.filter(game => 
      game.genres.some(genre => genre.slug === selectedGenre)
  );

  displayGames(filteredGames);
}

