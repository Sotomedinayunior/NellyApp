<template>
    <div class="Wrapper">
        <div class="row">
            <h1 class="title">Tus Landings</h1>

            <div class="Actions-Sections">
                <input
                    type="search"
                    name=""
                    id=""
                    placeholder="Buscar un landing"
                    v-model="searchText"
                    @input="handleSearch"
                />

                <router-link to="/contructor" class="create-landing-link">
                    + Crear un nuevo landings
                </router-link>
            </div>
        </div>
        <div class="row-two">
            <select
                name="filterSelect"
                id="filterSelect"
                class="custom-select"
                @change="handleFilterChange"
            >
                <option value="ordenAlfabetico" selected
                    >Filtrar por: ORDEN ALFABÉTICO</option
                >
                <option value="az">Filtrar de: A-Z</option>
                <option value="za">Filtar de: Z-A </option>
            </select>
        </div>
        <div v-if="!landings || landings.length === 0" class="no-landings">
            <h1>No hay landings creadas.</h1>
        </div>
        <div class="Container-Card">
            <div
                class="card-land"
                v-for="item in filteredLandings"
                :key="item.id"
            >
                <div class="card-header">
                    <img
                        :src="'http://localhost:8000/' + item.logo"
                        alt="Logo"
                    />
                    <h1>{{ item.nombre }}</h1>
                    <p>{{ item.nombre + ".com" }}</p>
                </div>
                <div class="card-footer">
                    <div column-left>
                        <a :href="item.name + '.com'">
                            <img src="./static/click.png" alt="click" />
                        </a>
                    </div>
                    <div class="column-right">
                        <a href="#" @click="deleteLanding(item.id)">
                            <img src="./static/basura.png" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="searchText && filteredLandings.length === 0"
            class="no-landings"
        >
            <h1>No se encontraron landings.</h1>
        </div>
    </div>
</template>
<script>
import Axios from "axios";
export default {
    data() {
        return {
            landings: null,
            searchText: ""
        };
    },

    computed: {
        filteredLandings() {
            if (!this.searchText) {
                return this.landings;
            }
            return this.landings.filter(landing =>
                landing.nombre
                    .toLowerCase()
                    .includes(this.searchText.toLowerCase())
            );
        }
    },

    methods: {
        GetLandings() {
            Axios.get("http://localhost:8000/landings").then(response => {
                this.landings = response.data;
                // console.log(response.data);
            });
        },
        deleteLanding(id) {
            console.log(("este es el id", id));

            Axios.delete(`http://localhost:8000/landings/${id}`)
                .then(response => {
                    // Manejar la respuesta si
                    this.landings = this.landings.filter(
                        landing => landing.id !== id
                    );
                    localStorage.removeItem("landings_id");

                    // Actualizar la lista de landings si es necesario
                })
                .catch(error => {
                    // Manejar el error si ocurre
                    console.error(error);
                });
        },
        handleFilterChange(event) {
            const selectedOption = event.target.value;
            if (selectedOption === "az") {
                this.filteredLandings.sort((a, b) =>
                    a.nombre.localeCompare(b.nombre)
                );
            } else if (selectedOption === "za") {
                this.filteredLandings.sort((a, b) =>
                    b.nombre.localeCompare(a.nombre)
                );
            }
        },
        handleSearch() {
            // Método de búsqueda actualizado para usar searchText en lugar de searchTerm
            if (!this.searchText) {
                this.GetLandings();
            } else {
                // this.GetLandings(); // No necesitas llamar a GetLandings nuevamente, solo filtra los datos existentes.
            }
        }
    },

    mounted() {
        this.GetLandings();
    }
};
</script>
<style scoped>
.Container-Card {
    display: grid;
    margin: 20px 0px 20px 0;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 10px;
}
.no-landings {
    font-size: 1rem;
    font-weight: 600;
    color: #f16822;
}
.Wrapper {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
}
.card-land {
    width: 100%; /* Ajustar ancho al 100% para ocupar toda la columna */
    max-width: 100%; /* Asegurar que el ancho máximo sea el 100% */
    border-radius: 10px;
    padding: 0px 0px 10px 0;

    box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px,
        rgba(0, 0, 0, 0.05) 0px 5px 10px;
}
.card-footer {
    display: flex;
    justify-content: space-between;
    padding: 0px 9px 5px 9px;
    margin: 10px 0px 0px 0px;
}
.card-header img {
    width: 100%;
    height: 150px;
    border-radius: 10px;
}
.card-header h1 {
    text-align: left;
    font-weight: 800;
    font-size: 2rem;
    color: grey;
    margin: 10px 0px 10px 10px;
}
.card-header p {
    text-align: left;
    font-weight: 600;
    font-size: 0.9rem;

    color: grey;
    margin: 10px 0px 15px 10px;
}
.row {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
}

.row h1 {
    font-weight: 700;
    font-size: clamp(10px, 32px, 20px);
    margin-bottom: 10px; /* Añadido para separar el título del contenido */
}

.Actions-Sections {
    display: flex;
    flex-direction: row;
}

.row input[type="search"] {
    outline: none;
    width: 100%; /* Modificado para que ocupe todo el ancho en pantallas pequeñas */
    padding: 5px;
    margin-bottom: 10px; /* Añadido margen inferior */
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    box-sizing: border-box;
}

.row input[type="search"]::placeholder {
    font-size: 12px;
}

.create-landing-link {
    padding: 10px;
    border-radius: 5px;
    background-color: #f16822;
    color: #fff;
    font-size: 15px;
    border: none;
    cursor: pointer;
    text-decoration: none; /* Quita el subrayado del enlace */
}

.create-landing-link:hover {
    background-color: #ff7f50; /* Cambia el color al pasar el ratón */
}
.row-two {
    display: flex;
    justify-content: end;
    margin: 20px 0 20px 0;
}
.custom-select {
    appearance: none; /* Oculta el estilo predeterminado del select */
    padding: 10px 20px; /* Ajusta el relleno según sea necesario */
    border: 1px solid #f16822; /* Añade un borde */
    border-radius: 5px; /* Agrega bordes redondeados */
    background-color: #fff; /* Fondo blanco */
    color: #f16822; /* Color del texto */

    cursor: pointer; /* Cambia el cursor al pasar por encima */
    border-radius: 20px;
    font-size: clamp(0.8rem, 13px, 18px);
}

.custom-select:focus {
    outline: none; /* Elimina el contorno al enfocar */
    border-color: #f16822; /* Cambia el color del borde al enfocar */
}

/* Media query para pantallas pequeñas */
@media screen and (min-width: 768px) {
    .row {
        flex-direction: row;
        align-items: center; /* Alineación de los elementos en el centro */
    }

    .row input[type="search"] {
        width: auto; /* Revertido al ancho automático */
        margin-right: 10px; /* Separación entre el input y el botón */
        margin-bottom: 0; /* Eliminado el margen inferior */
    }

    .row button {
        width: auto; /* Revertido al ancho automático */
    }
    .Container-Card {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        margin-bottom: 20px;
    }

    .card-land {
        margin-bottom: 50px;
        /* Limitar el ancho máximo de las tarjetas en pantallas pequeñas */
    }
}
</style>
