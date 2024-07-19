<template>
    <transition name="fade">
        <div v-if="visible" class="toast border-2 border-text text-accent text-small text-center bg-red-600">
            {{ message }}
        </div>
    </transition>
</template>

<script>
export default {
    name: 'Toast',
    data() {
        return {
            visible: false,
            message: ''
        };
    },
    methods: {
        show(message, duration = 3000) {
            this.message = message;
            this.visible = true;
            setTimeout(() => {
                this.visible = false;
            }, duration);
        }
    }
};
</script>

<style scoped>
.toast {
    position: fixed;
    bottom: 30px;
    right: 20px;
    padding: 20px 30px;
    border: 1px solid var(--border-color);
    border-radius: 5px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    transition: opacity 0.5s ease-in-out;
    max-width: 350px;
    width: auto;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .toast {
        width: full;
    }
}

/* Custom classes based on provided utility classes */
.bg-accent {
    background-color: var(--accent-color);
}

.border {
    border: 1px solid var(--border-color);
}

.shadow-sm {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.text-small {
    font-size: 0.875rem;
}

.rounded {
    border-radius: 0.375rem;
}
</style>
