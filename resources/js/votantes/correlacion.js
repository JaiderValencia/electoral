const corregimientos = []
let corregimientoSeleccionado
let barrioSeleccionado

const municipioSelect = document.getElementById('municipio')
const corregimientoSelect = document.getElementById('corregimiento')
const barrioSelect = document.getElementById('barrio')
const puestoSelect = document.getElementById('puesto')
const mesaSelect = document.getElementById('mesa')

const municipioHandle = async (event) => {
    const selectedMunicipio = municipioSelect.value    

    corregimientoSelect.options.length = 1
    barrioSelect.options.length = 1
    puestoSelect.options.length = 1
    mesaSelect.options.length = 1

    if (isNaN(parseInt(selectedMunicipio))) return

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

        if (typeof oldCorregimiento !== 'undefined' && oldCorregimiento == corregimiento.id) corregimientoOption.selected = true

        corregimientoSelect.appendChild(corregimientoOption)
    })

    corregimientoHandle()
    barrioHandle()
    puestoHandle()
}

const corregimientoHandle = (event) => {
    barrioSelect.options.length = 1
    puestoSelect.options.length = 1
    mesaSelect.options.length = 1
    
    corregimientoSeleccionado = corregimientos.find(e => e.id == corregimientoSelect.value)

    if (!corregimientoSeleccionado || !corregimientoSeleccionado.barrios.length) return

    for (const barrio of corregimientoSeleccionado.barrios) {
        const barrioOption = document.createElement('option')
        barrioOption.value = barrio.id
        barrioOption.textContent = barrio.nombre

        if (typeof oldBarrio !== 'undefined' && oldBarrio == barrio.id) barrioOption.selected = true


        barrioSelect.appendChild(barrioOption)
    }
}

const barrioHandle = (event) => {
    puestoSelect.options.length = 1
    mesaSelect.options.length = 1

    if (!corregimientoSeleccionado || !corregimientoSeleccionado.barrios.length) return

    const selectedBarrio = barrioSelect.value    

    barrioSeleccionado = corregimientoSeleccionado.barrios.find(barrio => barrio.id == selectedBarrio)

    const puestos = barrioSeleccionado.puestos

    if (!puestos || !puestos.length) return

    for (const puesto of puestos) {
        const option = document.createElement('option')

        option.value = puesto.id
        option.textContent = puesto.nombre

        if (typeof oldPuesto !== 'undefined' && oldPuesto == puesto.id) option.selected = true


        puestoSelect.appendChild(option)
    }
}

const puestoHandle = (event) => {
    const selectedPuesto = puestoSelect.value
    mesaSelect.options.length = 1

    if (!barrioSeleccionado || !barrioSeleccionado.puestos.length) return    

    const puesto = barrioSeleccionado.puestos.find(e => e.id == selectedPuesto)

    if (!puesto || !puesto.mesas.length) return

    const mesas = puesto.mesas

    for (const mesa of mesas) {
        const option = document.createElement('option')

        option.value = mesa.id
        option.textContent = mesa.descripcion

        if (typeof oldMesa !== 'undefined' && oldMesa == mesa.id) option.selected = true


        mesaSelect.appendChild(option)
    }
}

municipioSelect.addEventListener('input', municipioHandle)

corregimientoSelect.addEventListener('input', corregimientoHandle)

barrioSelect.addEventListener('input', barrioHandle)

puestoSelect.addEventListener('input', puestoHandle)

//ejecutarlos por si hubo algun error de digitación
municipioHandle()
corregimientoHandle()
barrioHandle()
puestoHandle()