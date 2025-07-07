const corregimientos = []
let corregimientoSeleccionado
let barrioSeleccionado

const municipioSelect = document.getElementById('municipio')
const corregimientoSelect = document.getElementById('corregimiento')
const barrioSelect = document.getElementById('barrio')
const puestoSelect = document.getElementById('puesto')
const mesaSelect = document.getElementById('mesa')

const cargarCorregimientos = async (municipio_id) => {
    try {
        const response = await fetch(`/municipios/corregimientos/${municipio_id}`)
            .then(response => response.json())

        return response
    } catch (error) {
        Swal.fire({
            title: "Error",
            text: "Algo falló al cargar el corregimiento, vuelve a intentar",
            icon: "error"
        });
    }
}

const municipioHandle = async (event) => {
    const selectedMunicipio = municipioSelect.value

    corregimientoSelect.options.length = 1
    barrioSelect.options.length = 1
    puestoSelect.options.length = 1
    mesaSelect.options.length = 1

    if (isNaN(parseInt(selectedMunicipio))) return

    if (!corregimientos.some(corregimiento => corregimiento.municipio_id == selectedMunicipio)) {
        corregimientos.push(...await cargarCorregimientos(selectedMunicipio))
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
    console.log(selectedPuesto)

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

const botonesEditar = [...document.querySelectorAll('button.btn-modal-editar')]
const municipiosEditar = [...document.querySelectorAll('select.municipio-editar')]
const corregimientosEditar = [...document.querySelectorAll('select.corregimiento-editar')]
const barriosEditar = [...document.querySelectorAll('select.barrio-editar')]
const puestosEditar = [...document.querySelectorAll('select.puesto-editar')]
const mesasEditar = [...document.querySelectorAll('select.mesa-editar')]


const municipioHandleEditar = async ({ municipio_id, votante_id }) => {

    const corregimientoEditarSelect = document.getElementById(`corregimiento-${votante_id}`)
    corregimientoEditarSelect.options.length = 1

    if (isNaN(parseInt(municipio_id))) return

    if (!corregimientos.some(corregimiento => corregimiento.municipio_id == municipio_id)) {
        corregimientos.push(...await cargarCorregimientos(municipio_id))
    }

    corregimientos.filter(corregimiento => corregimiento.municipio_id == municipio_id).forEach(corregimiento => {
        const corregimientoOption = document.createElement('option')

        corregimientoOption.value = corregimiento.id
        corregimientoOption.textContent = corregimiento.nombre

        if (corregimientoEditarSelect.dataset.votanteCorregimiento == corregimiento.id) {

            corregimientoOption.selected = true

            corregimientoHandleEditar({
                corregimiento,
                votante_id
            })
        }

        corregimientoEditarSelect.appendChild(corregimientoOption)
    })
}

const corregimientoHandleEditar = ({ corregimiento, votante_id }) => {
    const barrioEditarSelect = document.getElementById(`barrio-${votante_id}`)
    barrioEditarSelect.options.length = 1

    if (!corregimiento || !corregimiento.barrios.length) return

    for (const barrio of corregimiento.barrios) {
        const barrioOption = document.createElement('option')
        barrioOption.value = barrio.id
        barrioOption.textContent = barrio.nombre

        if (barrioEditarSelect.dataset.votanteBarrio == barrio.id) {

            barrioOption.selected = true

            barrioHandleEditar({
                barrio,
                votante_id
            })
        }

        barrioEditarSelect.appendChild(barrioOption)
    }
}

const barrioHandleEditar = ({ barrio, votante_id }) => {
    const puestoEditarSelect = document.getElementById(`puesto-${votante_id}`)
    puestoEditarSelect.options.length = 1

    if (!barrio || !barrio.puestos.length) return

    for (const puesto of barrio.puestos) {
        const option = document.createElement('option')

        option.value = puesto.id
        option.textContent = puesto.nombre

        if (puestoEditarSelect.dataset.votantePuesto == puesto.id) {
            option.selected = true

            puestoHandleEditar({
                puesto,
                votante_id
            })
        }

        puestoEditarSelect.appendChild(option)
    }
}

const puestoHandleEditar = ({ puesto, votante_id }) => {
    const mesaEditarSelect = document.getElementById(`mesa-${votante_id}`)
    mesaEditarSelect.options.length = 1

    if (!puesto || !puesto.mesas.length) return

    for (const mesa of puesto.mesas) {
        const option = document.createElement('option')

        option.value = mesa.id
        option.textContent = mesa.descripcion

        if (mesaEditarSelect.dataset.votanteMesa == mesa.id) option.selected = true

        mesaEditarSelect.appendChild(option)
    }
}

for (const botonEditar of botonesEditar) {
    botonEditar.addEventListener('click', () => {

        const votante_id = botonEditar.id.split("-")[3]

        municipioHandleEditar({
            municipio_id: document.getElementById(`municipio-${votante_id}`).value,
            votante_id
        })
    })
}

for (const municipioEditar of municipiosEditar) {
    municipioEditar.addEventListener('input', async (e) => {

        const votante_id = municipioEditar.id.split("-")[1]

        await municipioHandleEditar({
            municipio_id: e.target.value,
            votante_id
        })

        const corregimientoSeleccionado = corregimientos.find(corregimiento => document.getElementById(`corregimiento-${votante_id}`).value == corregimiento.id)

        corregimientoHandleEditar({
            corregimiento: corregimientoSeleccionado,
            votante_id
        })

        const barrio = corregimientoSeleccionado.barrios.find(barrio => document.getElementById(`barrio-${votante_id}`).value == barrio.id)

        barrioHandleEditar({
            votante_id,
            barrio
        })

        const puesto = barrio.puestos.find(puesto => document.getElementById(`puesto-${votante_id}`).value == puesto.id)

        puestoHandleEditar({
            votante_id,
            puesto
        })
    })
}

for (const corregimientoEditar of corregimientosEditar) {
    corregimientoEditar.addEventListener('input', (e) => {
        const votante_id = corregimientoEditar.id.split("-")[1]
        const corregimientoSeleccionado = corregimientos.find(
            corregimiento => corregimiento.id == e.target.value
        )
        corregimientoHandleEditar({
            corregimiento: corregimientoSeleccionado,
            votante_id
        })

        // Actualizar barrio y puesto en cascada
        const barrio = corregimientoSeleccionado?.barrios.find(
            barrio => document.getElementById(`barrio-${votante_id}`).value == barrio.id
        )
        if (barrio) {
            barrioHandleEditar({ votante_id, barrio })
            const puesto = barrio.puestos.find(
                puesto => document.getElementById(`puesto-${votante_id}`).value == puesto.id
            )
            if (puesto) {
                puestoHandleEditar({ votante_id, puesto })
            }
        }
    })
}

for (const barrioEditar of barriosEditar) {
    barrioEditar.addEventListener('input', (e) => {
        const votante_id = barrioEditar.id.split("-")[1]

        const corregimientoSeleccionado = corregimientos.find(
            corregimiento => corregimiento.id == document.getElementById(`corregimiento-${votante_id}`).value
        )

        const barrio = corregimientoSeleccionado?.barrios.find(
            barrio => barrio.id == e.target.value
        )

        if (barrio) {
            barrioHandleEditar({ votante_id, barrio })

            const puesto = barrio.puestos.find(puesto => document.getElementById(`puesto-${votante_id}`).value == puesto.id)

            if (puesto) {
                puestoHandleEditar({ votante_id, puesto })
            }
        }
    })
}

for (const puestoEditar of puestosEditar) {
    puestoEditar.addEventListener('input', (e) => {
        const votante_id = puestoEditar.id.split("-")[1]

        const corregimientoSeleccionado = corregimientos.find(
            corregimiento => corregimiento.id == document.getElementById(`corregimiento-${votante_id}`).value
        )
        const barrio = corregimientoSeleccionado?.barrios.find(
            barrio => barrio.id == document.getElementById(`barrio-${votante_id}`).value
        )
        const puesto = barrio?.puestos.find(
            puesto => puesto.id == e.target.value
        )
        if (puesto) {
            puestoHandleEditar({ votante_id, puesto })
        }
    })
}