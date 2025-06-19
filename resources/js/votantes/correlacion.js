const corregimientos = []
const barrios = []
const puestos = []
const mesas = []

const municipioSelect = document.getElementById('municipio');
const corregimientoSelect = document.getElementById('corregimiento');
const barrioSelect = document.getElementById('barrio');
const puestoSelect = document.getElementById('puesto');
const mesaSelect = document.getElementById('mesa');

municipioSelect.addEventListener('change', async function () {
    const selectedMunicipio = this.value;

    corregimientoSelect.options.length = 1

    if (!corregimientos.some(corregimiento => corregimiento.municipio_id == selectedMunicipio)) {

        try {
            const response = await fetch(`/municipios/corregimientos/${selectedMunicipio}`)
                .then(response => response.json())

            corregimientos.push(...response)
        } catch (error) {
            alert("Hubo un error al cargar los corregimientos")
        }
    }

    corregimientos.filter(corregimiento => corregimiento.municipio_id == selectedMunicipio).forEach(corregimiento => {
        const opction = document.createElement('option');

        opction.value = corregimiento.id;
        opction.textContent = corregimiento.nombre;
        corregimientoSelect.appendChild(opction);
    });
});