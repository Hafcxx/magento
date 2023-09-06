require(['vue', 'jquery', 'domReady!'], (vue, $)=>{
    const { createApp, ref, onMounted, defineProps, defineComponent } = Vue

     const componenteFormulario = defineComponent({
        name: 'formulario',
        props: {
            propsMostrar: {
                type: Boolean
            }
        },
        setup() {
            const obtenerBandera = async () => {
                await $.ajax({
                    url: 'http://magento.test/tareados/index/Tarea',
                    type: 'GET',
                    dataType: 'json',
                    complete: function (response) {
                        bandera.value = response.responseJSON.bandera
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log('Error happens. Try again.');
                    }
                });
            }
            onMounted(() => {
                obtenerBandera()
            })
        },
        template: `
        <div class="container">
        <div class="card-cartao">
            <div class="column">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="numero">Número de Tarjeta:</label>
                        <input type="text" class="form-control" id="numero" name="numero" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre en la Tarjeta:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="vencimiento">Fecha de Vencimiento:</label>
                            <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="MM/YY" required>
                        </div>
                        <div class="col">
                            <label for="cvv">CVV:</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit-c">Enviar</button>
                </form>
            </div>
            <div class="column">
                <img src="https://www.nerdwallet.com/cdn-cgi/image/width=1800,quality=85/cdn/images/marketplace/credit_cards/c9d8dc74-c50c-11ed-b641-0344f3508f63/bc7017055af8fbe33bffac4c37fd12c998b92f418024ff91aa8dc3056546e815.png" alt="Tarjeta de crédito">
            </div>
        </div>
    </div>
        `
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
                });
            })
        }
    }).mount('#app')
})
