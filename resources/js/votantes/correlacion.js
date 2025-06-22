const corregimientos = []
let corregimientoSeleccionado
let barrioSeleccionado

const municipioSelect = document.getElementById('municipio')
const corregimientoSelect = document.getElementById('corregimiento')
const barrioSelect = document.getElementById('barrio')
const puestoSelect = document.getElementById('puesto')
const mesaSelect = document.getElementById('mesa')

corregimientoSelect.disabled = true
barrioSelect.disabled = true
puestoSelect.disabled = true
mesaSelect.disabled = true

const municipioHandle = async (event) => {
    const selectedMunicipio = municipioSelect.value

    corregimientoSelect.disabled = false

    corregimientoSelect.options.length = 1
    barrioSelect.options.length = 1
    puestoSelect.options.length = 1
    mesaSelect.options.length = 1

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
        const corregimientoOption = document.createElement('option')

        corregimientoOption.value = corregimiento.id
        corregimientoOption.textContent = corregimiento.nombre
        corregimientoSelect.appendChild(corregimientoOption)

        for (const barrio of corregimiento.barrios) {
            const barrioOption = document.createElement('option')
            barrioOption.value = barrio.id
            barrioOption.textContent = barrio.nombre

            barrioSelect.appendChild(barrioOption)
        }

        corregimientoHandle()
        barrioHandle()
        puestoHandle()
    })
}

const corregimientoHandle = (event) => {
    barrioSelect.disabled = false
    corregimientoSeleccionado = corregimientos.find(e => e.id == corregimientoSelect.value)
}

const barrioHandle = (event) => {
    puestoSelect.options.length = 1
    mesaSelect.options.length = 1

    if (!corregimientoSeleccionado || !corregimientoSeleccionado.barrios.length) return

    const selectedBarrio = barrioSelect.value

    puestoSelect.disabled = false

    barrioSeleccionado = corregimientoSeleccionado.barrios.find(barrio => barrio.id == selectedBarrio)

    const puestos = barrioSeleccionado.puestos

    if (!puestos || !puestos.length) return

    for (const puesto of puestos) {
        const option = document.createElement('option')

        option.value = puesto.id
        option.textContent = puesto.nombre

        puestoSelect.appendChild(option)
    }
}

const puestoHandle = (event) => {
    const selectedPuesto = puestoSelect.value
    mesaSelect.options.length = 1

    if (!barrioSeleccionado || !barrioSeleccionado.puestos.length) return

    mesaSelect.disabled = false

    const mesas = barrioSeleccionado.puestos.find(e => e.id == selectedPuesto).mesas

    if (!mesas || !mesas.length) return

    for (const mesa of mesas) {
        const option = document.createElement('option')

        option.value = mesa.id
        option.textContent = mesa.descripcion

        mesaSelect.appendChild(option)
    }
}

municipioSelect.addEventListener('change', municipioHandle)

corregimientoSelect.addEventListener('change', corregimientoHandle)

barrioSelect.addEventListener('change', barrioHandle)

puestoSelect.addEventListener('change', puestoHandle)