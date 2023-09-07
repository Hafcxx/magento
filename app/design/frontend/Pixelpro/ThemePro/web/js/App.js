require(['vue', 'jquery', 'domReady!'], (vue, $)=>{
    const { createApp, ref, onMounted, defineProps, defineComponent } = Vue

     const componenteFormulario = defineComponent({
        name: 'formulario',
        props: {
            propsMostrar: {
                type: Boolean
            },
            urlGuardar: {
                type: String
            }
        },
        setup(props) {
            const formulario= ref({
                nombre: '',
                numero: '',
                cvv: null,
                vencimiento: ''
            })
            const mensaje_numero = ref('')
            const mensaje_nombre = ref('')
            const mensaje_cvv = ref('')
            const mensaje_vencimiento = ref('')

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
            const enviarDatos = () => {
                if(!formulario.value.numero){
                    mensaje_numero.value = 'Debe ingresar el número de la tarjeta.'
                    return
                }
                if(formulario.value.numero.length != 19){
                    mensaje_numero.value = 'Debe tener 16 dígitos'
                    return
                }
                if(!formulario.value.nombre){
                    mensaje_nombre.value = 'Debe ingresar el nombre de la tarjeta.'
                    return
                }
                if(!formulario.value.vencimiento || formulario.value.vencimiento.length < 5){
                    mensaje_vencimiento.value = 'Debe ingresar la fecha de vencimiento de la tarjeta.'
                    return
                }
                if(!formulario.value.cvv){
                    mensaje_cvv.value = 'Debe ingresar el cvv de la tarjeta.'
                    return
                }
                if(formulario.value.cvv.length != 3){
                    mensaje_cvv.value = 'Debe tener 3 dígitos'
                    return
                }
                $.ajax({
                    url: props.urlGuardar,
                    data: { 
                        nombre: formulario.value.nombre, 
                        numero: formulario.value.numero.replace(/\s/g, ''), 
                        cvv: formulario.value.cvv,
                        vencimiento: formulario.value.vencimiento
                    },
                    type: 'POST',
                    dataType: 'json',
                    complete: function (response) {
                        if(response.error){
                            formulario.value.nombre = ''
                            formulario.value.numero = ''
                            formulario.value.cvv = null
                            formulario.value.vencimiento = ''
                        }else {
                            console.log('Error : ', response.mensaje);
                        }
                    },
                    error: function (xhr, status, errorThrown) {
                        console.log('Error petición save: ', status, errorThrown);
                    }
                });
            }

            const blurInput = (campo) => {
                if(campo == 'numero'){
                    mensaje_numero.value = ''
                }else if ( campo == 'nombre'){
                    mensaje_nombre.value = ''
                }else if (campo == 'vencimiento'){
                    mensaje_vencimiento.value = ''
                }else {
                    mensaje_cvv.value = null
                }
            }

            const inputNumeroTarjeta = (e) => {
                let el = e.target, newValue = el.value;
                formulario.value.numero = mascaraNumeroTarjeta(newValue, 4, ' ')
            }

            const inputVencimientoTarjeta = (e) => {
                let el = e.target, newValue = el.value;
                formulario.value.vencimiento = mascaraNumeroTarjeta(newValue, 2, '/')
            }

            const mascaraNumeroTarjeta = (value, limit, separator) => {
                let copia = (value + '').split(separator).join('')
                let output = [];
                for (let i = 0; i < copia.length; i++) {
                    if ( i !== 0 && i % limit === 0) {
                        output.push(separator);
                    }
                    
                    output.push(copia[i]);
                }
                
                return output.join("");
            }

            const validarSoloNumeros = (evt) => {
                var theEvent = evt || window.event;
              
                // Handle paste
                if (theEvent.type === 'paste') {
                    key = event.clipboardData.getData('text/plain');
                } else {
                    // Handle key press
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode(key);
                }
                var regex = /[0-9]/;
                if( !regex.test(key) ) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }

            onMounted(() => {
               // obtenerBandera()
            })
            return {
                enviarDatos,
                blurInput,
                validarSoloNumeros,
                inputNumeroTarjeta,
                inputVencimientoTarjeta,
                formulario,
                mensaje_numero,
                mensaje_nombre,
                mensaje_cvv,
                mensaje_vencimiento
            }
        },
        template: `
            <div class="container">
                <div class="card-cartao">
                    <div class="column">
                        <div class="form-group mb-3">
                            <label for="numero">Número de Tarjeta:</label>
                            <input type="text" class="form-control mb-0" :value="formulario.numero" @input="inputNumeroTarjeta" maxlength="19" name="numero" @blur="blurInput('numero')" @keypress="validarSoloNumeros" required>
                            <p v-if="mensaje_numero" style="color:orange;">{{mensaje_numero}}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nombre">Nombre en la Tarjeta:</label>
                            <input type="text" class="form-control mb-0" v-model="formulario.nombre" name="nombre" @blur="blurInput('nombre')" required>
                            <p v-if="mensaje_nombre" style="color:orange;">{{mensaje_nombre}}</p>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="vencimiento">Fecha de Vencimiento:</label>
                                <input type="text" class="form-control mb-0" :value="formulario.vencimiento" @input="inputVencimientoTarjeta" name="vencimiento" maxlength="5" @blur="blurInput('vencimiento')" @keypress="validarSoloNumeros" placeholder="MM/YY" required>
                                <p v-if="mensaje_vencimiento" style="color:orange;">{{mensaje_vencimiento}}</p>
                            </div>
                            <div class="col mb-3">
                                <label for="cvv">CVV:</label>
                                <input type="text" class="form-control mb-0" v-model="formulario.cvv" name="cvv" placeholder="CVV" maxlength="3" @blur="blurInput('cvv')" @keypress="validarSoloNumeros" required>
                                <p v-if="mensaje_cvv" style="color:orange;">{{mensaje_cvv}}</p>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-submit-c" @click="enviarDatos()">Enviar</button>
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
                // $.ajax({
                //     url: 'https://crudcrud.com/api/73032dcc184f49d085b8b639475ec61a/unicorns',
                //     type: 'GET',
                //     dataType: 'json',
                //     complete: function(response) {             
                //         console.log('res', response.responseJSON)
                //     },
                //     error: function (xhr, status, errorThrown) {
                //         console.log('Error happens. Try again.');
                //     }
                // });
            })
        }
    }).mount('#app')
})
