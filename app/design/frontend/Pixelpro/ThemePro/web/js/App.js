require(['vue', 'jquery', 'domReady!'], (vue, $)=>{
    const { createApp, ref, onMounted, defineComponent } = Vue

    const componenteFormulario = defineComponent({
        name: 'formulario',
        setup() {
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
        template: "<h1>Bandera: {{ bandera }}</h1>"
    })

    const app = createApp({
        components: {
            'formulario': componenteFormulario
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
