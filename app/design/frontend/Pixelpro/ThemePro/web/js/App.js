require(['vue', 'jquery', 'domReady!'], (vue, $)=>{
    const { createApp, ref, onMounted, defineComponent } = Vue

    const componenteTest1 = defineComponent({
        name: 'test-1',
        setup() {
            onMounted(()=>{
                alert("test 1")
            })
        },
        template: '<h1>hola</h1>'
    })

    const app = createApp({
        components: {
            'test-1': componenteTest1
        },
        setup() {
            const message = ref('Hello vue!')

            onMounted(()=>{
                alert("hola alerta")

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
            return {
                message
            }
        }
    }).mount('#app')
})
