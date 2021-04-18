<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-bell"></i>
            <span class="notification-count label label-danger"
                  v-if="notifications.length>0">{{notifications.length}}</span>
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-notifications" role="menu">
            <li v-for="notification in notifications">
                <a :href="notification.url">
                    <div>
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{notification.description}}
                        <span class="pull-right text-muted small"><timeago :datetime="notification.time"
                                                                           :auto-update="60 "></timeago></span>
                    </div>
                </a>
                <div class="divider"></div>
            </li>
            `<a href=""></a>
            <li>
                <div class="text-center see-all-notifications">
                    <a href="notifications.html" v-if="notifications.length>0">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <div v-else>No notifications</div>
                </div>
            </li>

        </ul>
    </li>

</template>

<script>
    import VueTimeago from 'vue-timeago'

    Vue.use(VueTimeago, {
        name: 'Timeago',
        locale: 'en',
        locales: {
            'en-US': require('date-fns/locale/zh_cn'),
            ja: require('date-fns/locale/ja')
        }
    })
    export default {
        components: {
            alert
        },
        props: ['user_id'],
        data() {
            return {
                notifications: []
            }
        },
        mounted() {
            console.log('notification mounted');
            Echo.channel('order-channel')
                .listen('OrderStatusChanged', (order) => {
                    // if (this.user_id == order.user_id) {

                        this.notifications.unshift({
                            description: 'Order ID:' + order.id + "updated",
                            url: '/orders/' + order.id,
                            time: new Date() + ''
                        });
                    // }
                    console.log(this.notifications);
                });
        },
        methods: {
            async create() {
                console.log('helllooooooooo');
                await this.axios.post('http://localhost:8000/api/notifications', this.notifications).then(response => {
                    console.log('well done')
                }).catch(error => {
                    console.log(error);
                })
            }
        }

    }
</script>
