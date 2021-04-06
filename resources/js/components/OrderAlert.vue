<template>
    <alert v-model="showAlert" placement="top-right" duration="3000" type="success" width="400px" dismissable>
        <span class="icon-ok-circled alert-icon-float-left"></span>
        <strong>Orders</strong>
        <p>You have received new order!</p>
    </alert>
</template>

<script>
    import {alert} from 'vue-strap'

    export default {
        components: {
            alert
        },
        props: ['user_id'],
        data() {
            return {
                showAlert: false
            }
        },
        mounted() {
            Echo.channel('order-channel')
                .listen('OrderStatusChanged', (order) => {
                    if (this.user_id == order.user_id) {
                        this.showAlert = true
                    }
                });
        }
    }
</script>
