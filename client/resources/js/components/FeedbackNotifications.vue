<template>
    <div>
        <li style="margin-right: 20px">
            <div class="dropdown">
                <a
                    class="btn btn-primary dropdown-toggle"
                    href="#"
                    role="button"
                    id="dropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="fa fa-bell nav-icon"></i>
                    <span
                        class="badge badge-warning navbar-badge ml-2"
                        v-if="unreadTotal > 0"
                    >
                        {{ unreadTotal }}
                    </span>
                </a>

                <div
                    class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="dropdownMenuLink"
                >
                    <!-- Show Unread Notification Count  -->
                    <div
                        class="d-flex justify-content-center"
                        v-if="unreadTotal"
                    >
                        <p class="dropdown-item dropdown-header bg-warning">
                            <b>{{ unreadTotal }} Notifiactions</b>
                        </p>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item dropdown-header"
                            href="#"
                            style="color:#007bff"
                            >Mark All as Read</a
                        >
                        <div class="dropdown-divider"></div>
                    </div>
                    <div class="d-flex justify-content-center" v-else>
                        <p class="dropdown-item dropdown-header bg-warning">
                            <b>You don't have any Unread Notifications!</b>
                        </p>
                    </div>

                    <!-- UNREAD NOTIFICATIONS  -->
                    <div
                        v-for="(unReadNotification,
                        index) in allUnreadNotifications"
                        :key="index"
                        v-if="unReadNotification.data.type == 'feedback-sent'"
                    >
                        <a
                            class="dropdown-item bg-light"
                            :href="unReadNotification.data.link"
                            target="_blank"
                        >
                            <i class="fa fa-bell nav-icon"></i> New Feedback
                            Form
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>

                    <a href="#" class="dropdown-item dropdown-footer"
                        >See All Notifications</a
                    >
                </div>
            </div>
        </li>
    </div>
</template>

<script>
export default {
    props: ["unreadNotifications", "unreadNotificationsTotal", "authUserId"],
    data() {
        return {
            userId: this.authUserId,
            allUnreadNotifications: this.unreadNotifications,
            unreadTotal: this.unreadNotificationsTotal
        };
    },
    created() {
        this.listenForChanges();
    },
    methods: {
        listenForChanges() {
            Echo.private("feedback-form-sent").listen("FeedbackFormSent", e => {
                if (this.userId === e.user_id) {
                    this.unreadTotal++;
                }
            });
        }
    }
};
</script>
