document.addEventListener('DOMContentLoaded', () => {
    const listElement = document.getElementById('list');

    // Replace with your actual API URL
    const apiUrl = 'http://localhost/backend/api.php/criaturas';

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            if (Array.isArray(data)) {
                data.forEach(criatura => {
                    const li = document.createElement('li');
                    li.textContent = `ID: ${criatura.id} - Nombre: ${criatura.nombre || 'N/A'}`;
                    listElement.appendChild(li);
                });
            } else {
                listElement.textContent = 'No se encontraron criaturas.';
            }
        })
        .catch(error => {
            listElement.textContent = 'Error al cargar las criaturas: ' + error.message;
        });
});
