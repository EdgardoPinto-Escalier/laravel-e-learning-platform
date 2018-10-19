<!-- Vue Template -->
<template>
    <!-- Stripe Check Out Button -->
    <stripe-checkout button="GET STARTED" buttonClass="btn btn-course btn-lg" :stripe-key="stripe_key" :product="product"></stripe-checkout>
</template>

<script>
    // First we imported StripeCheckout.
    import { StripeCheckout } from 'vue-stripe';
    // We export default components.
    export default {
        components: {
            StripeCheckout
        },
        // Name with the properties.
        name: "stripe-form",
        props: {
            stripe_key: '',
            name: '',
            amount: '',
            description: ''
        },
        // Here we use computed to define dynamic variables that we need in the component.
        computed: {
            product() {
                return {
                    name: this.name,
                    amount: parseFloat(this.amount),
                    description: this.description
                }
            }
        }
    }
</script>
