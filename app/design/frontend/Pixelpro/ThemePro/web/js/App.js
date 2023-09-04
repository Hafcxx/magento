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

    const app = createApp({
        components: {
            'formulario': componenteFormulario
        },
        setup() {
            onMounted(()=>{
                /*$.ajax({
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
