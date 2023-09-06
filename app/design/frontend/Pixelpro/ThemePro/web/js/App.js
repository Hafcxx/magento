require(['vue', 'jquery', 'domReady!'], (vue, $)=>{
    const { createApp, ref, onMounted, defineProps, defineComponent } = Vue

    const componenteFormulario = defineComponent({
        name: 'formulario',
        props:{
            propsMostrar:{
                type: Boolean
            },
            respuesta: {
                type: String
            }
        },
        setup(props) {
            const bandera = ref(false)
            const obtenerBandera = async() =>{
                await $.ajax({
                    url: 'http://magento.test/tareados/index/Tarea',
                    type: 'GET',
                    dataType: 'json',
                    complete: function(response) {             
                        bandera.value = response.responseJSON.bandera
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log('Error happens. Try again.');
                    }
                });
            }
            onMounted(()=>{
                obtenerBandera()
            })
            return {
                bandera
            }
        },
        template: "h2<h1>Bandera del prop: {{ propsMostrar }}</h1> <p>Recibido del controlador por ajax: {{ bandera }}</p>"
    })

    const componenteProductos = defineComponent({
        name: 'productos',
        setup() {
            const productos = ref([])
            const obtenerProductos = async() =>{
                $.ajax({
                    url: 'https://fakestoreapi.com/products', 
                    type: 'GET',
                    dataType: 'json',
                    complete: function(response) {             
                        productos.value =  response.responseJSON
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log('Error happens. Try again.');
                    }
                })
            }
            onMounted(()=>{
                obtenerProductos()
            })
            return {
                productos
            }
        },
        template: `<div class="col-12 col-md-4 col-lg-3 p-4" v-for="producto in productos" :key="producto.id">
                        <a :href="'detalles?id='+producto.id">
                            <div class="card tarjeta-producto">
                                <img :src="producto.image" alt="imagen de producto" class="card-img-top">
                                <div class="card-body">
                                    <h2 class="card-title text-center">{{producto.title}}></h2>
                                    <h5 class="card-text text-center">{{producto.price}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>`
    })

    const app = createApp({
        components: {
            'formulario': componenteFormulario,
            'productos': componenteProductos
        },
        setup() {
            onMounted(()=>{
                $.ajax({
                    url: 'https://crudcrud.com/api/73032dcc184f49d085b8b639475ec61a/unicorns',
                    type: 'GET',
                    dataType: 'json',
                    complete: function(response) {             
                        console.log('res', response.responseJSON)
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log('Error happens. Try again.');
                    }
                });*/
            })
        }
    }).mount('#app')
})
